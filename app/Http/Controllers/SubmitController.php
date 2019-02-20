<?php

namespace App\Http\Controllers;

use App\Submit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SubmitRequest;

class SubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apply.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param SubmitRequest $request
     * @return $this
     */
    public function store(SubmitRequest $request)
    {
        $validated = $request->validated();
        $ch1 =  $this->getChallengeOneCurl( $request->get('name') , $request->get('email') ,$request->get('phone')  ,$request->get('code') );

        $ch2 = $this->getChallengeTwoCurl();

        $mh = curl_multi_init();

        curl_multi_add_handle($mh,$ch1);
        curl_multi_add_handle($mh,$ch2);

        $active = null;

        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        curl_multi_remove_handle($mh, $ch1);
        curl_multi_remove_handle($mh, $ch2);
        curl_multi_close($mh);

        $response1 = curl_multi_getcontent($ch1);
        $response2 = curl_multi_getcontent($ch2);

        $array1 = json_decode($response1 , true);
        $array2 = json_decode($response2 , true);


        if(
            ( isset($array1['errcode']) && $array1['errcode'] !== 0 )||
            ( isset($array2['errcode']) && $array2['errcode'] !== 0 )
        ){
            return redirect('/application')->with('success', 'Ops, There is error when calling Wemine API, please review your data:( ');
        }


        $submit = new Submit([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'code' => $request->get('code'),
            'answer_one' => $request->get('answer_one'),
            'answer_two' => $request->get('answer_two'),
            'answer_three' => $request->get('answer_three'),
            'other' => $request->get('other'),
            'response_one' => $response1,
            'response_two' => $response2,
        ]);
        $submit->save();


        return redirect('/application')->with('success', 'Your test result has been submitted and successfully called Wemine APIs :) ');
    }

    protected function getChallengeOneCurl($name , $email , $phone , $code){
        $ch1 = curl_init();
        $name = str_rot13($name);
        $email = str_rot13($email);
        $phone = str_rot13($phone);
        $code = str_rot13($code);

        var_dump("{\"anzr\":\"$name\",\"rznvy\":\"$email\",\"cubar\":\"$phone\",\"pbqr\":\"3hDqm9TnOp\"}");
        curl_setopt_array($ch1, array(
            CURLOPT_URL => "http://dev.career.wemine.hk/1/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"anzr\":\"$name\",\"rznvy\":\"$email\",\"cubar\":\"$phone\",\"pbqr\":\"$code\"}",
            CURLOPT_HTTPHEADER => array(
                "Accept-Encoding: application/json",
                "Content-Type: text/plain",
                "Postman-Token: bc24c612-38d2-4f8f-b324-b1219dda3f93",
                "cache-control: no-cache"
            ),
        ));

        return $ch1;
    }

    protected function getChallengeTwoCurl(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://dev.career.wemine.hk/2/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"email\": \"vestige01@gmail.com\",\n    \"part1\": \"SELECT GROUP_CONCAT( str  ORDER BY B.sequence ASC SEPARATOR '' ) AS passcode FROM ( SELECT section, GROUP_CONCAT(FROM_BASE64(part_str) ORDER BY A.sequence ASC SEPARATOR '' ) as str , is_relevant FROM A WHERE A.is_relevant = 1 GROUP BY A.section ) AS D INNER JOIN B ON D.section = B.id\",\n    \"part2\": \"You have succeeded decrypting this. Wemine 2018.\",\n    \"part3\": \"Just use Postman as it does not said I need to wait for the first response then send the second one. I press fast so I can send 2 request within 5 seconds.\",\n    \"other\": \"I devoted myself on Magento 2 full stack development in the nearest past 3 years. I had programmed in Laveral before my Magento 2 career for almost a year. Nonetheless, I have not much experience in Python or Node.js\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Postman-Token: 4a6cb6b5-940f-45c5-acee-a633a3fd2090",
                "cache-control: no-cache"
            ),
        ));

        return $curl;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Submit  $submit
     * @return \Illuminate\Http\Response
     */
    public function show(Submit $submit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Submit  $submit
     * @return \Illuminate\Http\Response
     */
    public function edit(Submit $submit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Submit  $submit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submit $submit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Submit  $submit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submit $submit)
    {
        //
    }
}
