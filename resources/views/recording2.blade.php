@extends('layout/user')

@section('title', "Recording")

@section('content')

<div class="modal-content">
  <div class="modal-header d-flex">

    <link href="{{asset('css/videojs/video-js.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/videojs/videojs.record.css')}}" rel="stylesheet">

    <h4>Recording</h4>
  </div>

  <div class="modal-body" style="margin: auto">
        @csrf
        <video id="myVideo"  class="video-js vjs-default-skin" width="400" height="300"></video>
  </div>
  <div class="modal-footer d-flex">
    <div class="mr-auto p-2">
      <span class="record_timer">60 Seconds</span>
    </div>
    <div class="p-2">
      <input type="submit" id="btnStart" class="btn_stop_recording btn btn-danger" style="margin: auto" value="Stop & Proceed to Next"> 
    </div>
  </div>
</div>

@endsection

@section('extra_script')  

    <script src="{{asset('js/content/videojs/video.min.js')}}"></script>
    <script src="{{asset('js/content/videojs/RecordRTC.js')}}"></script>
    <script src="{{asset('js/content/videojs/videojs.record.js')}}"></script>
    <script src="{{asset('js/video_recorder.js')}}"></script>
    <script src="{{asset('js/content/situtation_assesment.js')}}"></script>
    
@endsection