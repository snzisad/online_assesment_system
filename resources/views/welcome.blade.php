@extends('layout/user')

@section('title', "Welcome")

@section('content')


<div class="modal-content">

    <div class="modal-body">
        <div class="form-group content_text_center">
            @if(isset($user->photo))
                <img class="user_picture" src={{route("getEmployeeImage", [$user->photo])}} height="100px" width="100px"/>
            @else
                <img class="user_picture" src="{{asset('images/user.png')}}" height="100px" width="100px"/>
            @endif

            <h4 class="modal-title" style="margin-top: 20px;">Hi {{$user->name}}</h4>
            {{--<p style="margin-top: 10px;">You have been working with us for last {{$user->dojReadable}}.</p>--}}
            <p style="margin-top: 20px;">
                Thanks for showing your interest. <br>
                We would run a online assessment. <br> 
                Enjoy the journey
            </p>
        </div>


        <a href="{{route('instructions')}}" class="btn_lets_start btn btn-block btn-success mt-5">Next</a>
    </div>
</div>

@endsection
