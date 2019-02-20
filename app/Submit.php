<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    protected $fillable = ['name', 'email', 'phone' , 'code' ,'answer_one' , 'answer_two' , 'answer_three' , 'other' ,'response_one' , 'response_two'];
}
