@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Share
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
            <form method="post" action="{{ route('application.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Your Name:</label>
                    <input type="text" class="form-control" name="name"/>
                </div>
                <div class="form-group">
                    <label for="price">Your Email:</label>
                    <input type="text" class="form-control" name="email"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Your Phone:</label>
                    <input type="text" class="form-control" name="phone"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Your Code:</label>
                    <input type="text" class="form-control" name="phone"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Your Answer 1:</label>
                    <input type="text" class="form-control" name="answer_one"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Your Answer 2:</label>
                    <input type="text" class="form-control" name="answer_two"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Your Answer 3:</label>
                    <input type="text" class="form-control" name="answer_three"/>
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