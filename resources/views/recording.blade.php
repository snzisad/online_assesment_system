@extends('layout/user')

@section('title', "Recording")

@section('content')

<div class="modal-content">
  <div class="modal-header d-flex">
    <h4>Recording</h4>
  </div>

  <div class="modal-body" style="margin: auto">
      <video id="my-preview" autoplay width="400" height="300"></video>
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
  {{-- <script src="js/video_recorder.js"></script> --}}
  <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
  <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
  <script src="js/webRTC.js"></script>
@endsection