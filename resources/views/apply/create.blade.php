@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
           Apply as Engineer
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <form method="post" action="{{ route('application.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Your Name:</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}"/>
                </div>
                <div class="form-group">
                    <label for="price">Your Email:</label>
                    <input type="text" class="form-control" name="email"  value="{{old('email')}}" />
                </div>
                <div class="form-group">
                    <label for="quantity">Your Phone:</label>
                    <input type="text" class="form-control" name="phone"  value="{{old('phone')}}"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Your Code:</label>
                    <input type="text" class="form-control" name="code"  value="{{old('code')}}" />
                </div>
                <div class="form-group">
                    <label for="quantity">Your Answer 1:</label>
                    <input type="text" class="form-control" name="answer_one"  value="{{old('answer_one')}}" />
                </div>
                <div class="form-group">
                    <label for="quantity">Your Answer 2:</label>
                    <input type="text" class="form-control" name="answer_two" value="{{old('answer_two')}}" />
                </div>
                <div class="form-group">
                    <label for="quantity">Your Answer 3:</label>
                    <input type="text" class="form-control" name="answer_three" value="{{old('answer_three')}}" />
                </div>
                <div class="form-group">
                    <label for="quantity">Other:</label>
                    <input type="text" class="form-control" name="other"/>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection