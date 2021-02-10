@extends('layout/user')

@section('title', "Upload")

@section('content')

<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title">Do you want to upload your answers?</h4>
  </div>

  <div class="modal-body" style="margin: auto;">
    <p class="error_messsage" style="display: none;">Something wrong. Please try again.</p>
    <div class="">
      <img class="progress_bar" src="{{asset('images/progress_bar_horizontal.gif')}}" style="display: none;"/>
    </div>
    <input type="submit" class="btn_upload_results btn btn-success"  value="Upload"> 
  </div>
  </div>
</div>

@endsection


@section('extra_script')  
  <script src="{{asset('js/content/upload.js')}}"></script>
@endsection