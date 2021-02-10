@extends('layout/user')

@section('title', "Questions")

@section('content')



  <div class="modal-content question_content" style="display: none;">
      @csrf
      <h4 class="modal-header d-flex modal-title">MCQ</h4>

      <div class="modal-body content_text_center">

        <div class="d-flex flex-wrap justify-content-center question_number" style="margin-bottom: 20px;">
          <div class="p-2 selected_question_number">01</div>
          <div class="p-2">02</div>
          <div class="p-2">03</div>
          <div class="p-2">04</div>
          <div class="p-2">05</div>
          <div class="p-2">06</div>
          <div class="p-2">07</div>
          <div class="p-2">08</div>
          <div class="p-2">09</div>
          <div class="p-2">10</div>
        </div>

        <h4 class="question_label">01. What is the first steps in sales?</h4>
        <p class="question_option" style="text-align: left; margin-top: 20px;"></p>


        <h4 class="mcq_question_timer">30 Seconds</h4>
        <img class="progress_bar" src="{{asset('images/progress_bar.gif')}}" style="display: none; margin: auto; margin-bottom: 5px;"/>

        <input type="submit" class="btn_next_question btn btn-block btn-success" value="Next">

      </div>
  </div>


  <div class="modal-content progressbar_content" style="text-align: center;">
    <div class="modal-body" style="margin: 100px;">
      <img class="progress_bar" src="{{asset('images/progress_bar.gif')}}" height="25" width="25" style="margin: auto"/>
    </div>
  </div>

@endsection


@section('extra_script')
  <script src="{{asset('js/content/mcq_questions.js')}}?v=1.2"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
@endsection
