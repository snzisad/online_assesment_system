@extends('layout/user')

@section('title', "Login")

@section('content')

<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title mt-3">Online Assessment</h4>
  </div>

  <form id="login_form" action="{{route('login')}}">
    @csrf
    <div class="modal-body content_text_center">
      {{--<img src="{{asset('images/search_icon.png')}}" height="40px" style="margin: auto;"/>--}}
      <p style="margin-top: 50px;">Tool that helps you to understand the concept and apply coherently.</p>
      {{--<p>Before we begin, could you tell us a little bit about yourself?</p>--}}
      <p style="font-weight: bold; margin-top: 50px;">Employee ID</p>
      <div class="form-group">
        <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="Employee ID" value="" required autofocus>
        <p class="error_messsage" style="display: none;">Invalid Employee ID</p>
      </div>

      <img class="progress_bar2" src="{{asset('images/progress_bar.gif')}}" style="display: none; margin: auto; margin-bottom: 5px;"/>
      <input type="submit" class="btn_submit_login btn btn-success btn-block" value="Submit">
    </div>
  </form>
</div>

@endsection


@section('extra_script')
  <script src="{{asset('js/content/login.js')}}"></script>
@endsection
