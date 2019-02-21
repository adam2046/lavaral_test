<!doctype html>
<link href="{{ asset('css/app.min.css') }}" media="all" rel="stylesheet" type="text/css" />

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" media="all" rel="stylesheet" type="text/css" />
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right submits">
                    @if($user = Auth::user())
                       <span>Hi {{ $user->name }}</span>
                    @endif
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                @if($user = Auth::user()  )
                    @if($user->id == 1)
                        <h3> Applicant Submission Records </h3>
                        <table class="submits">
                            <thead>
                            <tr>
                                <td>id</td>
                                <td>name</td>
                                <td>phone</td>
                                <td>code</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($submits as $submit)
                                <tr>
                                    <td>{{ $submit->id }}</td>
                                    <td>{{ $submit->name }}</td>
                                    <td>{{ $submit->phone }}</td>
                                    <td>{{ $submit->code }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p> You are not Admin so you are not permitted to view the submission record.</p>
                        <p> Please logout and submit test to Wemine.</p>
                     @endif
                @else
                    <h2>Welcome to Application System for Full Stack Web Developer in Wemine</h2>
                    <img src=" {{ asset("image/programminglanguages-620x290.jpg") }}" style="width:100%;" alt="image">
                    <p> Please click <a href="{{ route('application.index') }}">here</a> to start submitting the application test to Wemine! </p>
                @endif
            </div>
        </div>
    </body>
</html>
