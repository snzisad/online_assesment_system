@extends('layout/user')

@section('title', "Situation Assesment")

@section('content')

  <link href="{{asset('css/videojs/video-js.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/videojs/videojs.record.css')}}" rel="stylesheet">

  <div class="modal-content question_content" style="display: none;">
    @csrf
    <h4 class="modal-header d-flex modal-title">Role Play</h4>

    <div class="modal-body content_text_center">
      <div class="d-flex flex-wrap justify-content-center question_number" style="margin-bottom: 20px;">
        <div class="p-2 selected_question_number" style="min-width: 150px;">01</div>
        <div class="p-2" style="min-width: 150px;">02</div>
      </div>
      <h5 class="btn btn-outline-success disabled" style="margin-bottom: 20px;">Situation <span class="question_no">1</span></h5>
      <p><span style="color: red; font-weight: bold;">Case:</span> <span class="situation_text"> are showing a specific product to a customer, at that time, another customer arrives who has already purchased that product and faced a lot of problems.</span></p>
      <div class="role_play">
        <h5 style="color: lightgoldenrodyellow;">Role Play</h5>
        <span class="role_text" style="color: lightgoldenrodyellow">How can you handle this unsatisfied customer with successful sale made to the customer who arrived?</span>
      </div>

      <h4 class="preparation_timer">60 Seconds</h4>
      <input type="submit" class="btn_start_recording btn btn-block btn-success" value="Start">
    </div>
  </div>


  <div class="modal-content recording_section"  style="display: none;">
    <h4 class="modal-header d-flex modal-title">Recording</h4>

    <div class="modal-body" style="margin: auto">
      @csrf
      <video id="myVideo"  class="video-js vjs-default-skin"></video>

        <h4 class="record_timer"  style="text-align: center; margin-top: 20px;">120 Seconds</h4>
        <input type="submit" id="btnStart" class="btn_stop_recording btn-block btn btn-danger" style="margin: auto;" value="Stop & Proceed to Next">
    </div>
  </div>


  <div class="modal-content progressbar_content" style="text-align: center;">
    <div class="modal-body" style="margin: 100px;">
      <img class="progress_bar" src="{{asset('images/progress_bar.gif')}}?v=1" height="25" width="25" style="margin: auto"/>
    </div>
  </div>

  <div class="modal-content upload_section" style="display: none;">
  <div class="modal-header">
    <h4 class="modal-title upload">Uploading data...</h4>
  </div>

  <div class="modal-body" style="margin: auto;">
    <div class="">
      <img class="progress_bar" src="{{asset('images/progress_bar_horizontal.gif')}}?v=1"/>
    </div>
  </div>
  </div>
</div>


@endsection


@section('extra_script')
  <script src="{{asset('js/content/videojs/video.min.js')}}"></script>
  <script src="{{asset('js/content/videojs/RecordRTC.js')}}"></script>
  <script src="{{asset('js/content/videojs/videojs.record.js')}}"></script>
  {{-- <script src="{{asset('js/video_recorder.js')}}?v=1"></script> --}}
  <script src="{{asset('js/content/situtation_assesment.js')}}?v=1.21"></script>
@endsection
