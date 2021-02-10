@extends('layout/user')

@section('title', "Login")

@section('content')

<div class="modal-content">

  <form id="login_form" method="post" action="{{route('adminlogin')}}">
    @csrf
    <div class="modal-body">
      <div class="form-group">
        <label for="employee_id"><h4 style="color: saddlebrown;">Employee ID</h4></label><br>
        <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="Enter Employee ID" value="" required autofocus>
      </div>
      <div class="form-group">
        <label for="password"><h4 style="color: saddlebrown;">Password</h4></label><br>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" value="" required autofocus>
      </div>
      @if(!$errors->isEmpty())
        @foreach ($errors->all() as $error)
        <p class="error_messsage" style="display: block;">{{$error}}</p>
        @endforeach
      @endif

      <input type="submit" class="btn btn-block btn-success" value="Login">
    </div>
  </form>
</div>

@endsection
