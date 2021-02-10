@extends('layout.admin')
@section('title', 'Result')

@section('additional_content')
    <form action="{{route('remove_all_answers')}}" method="post">
        @csrf    
        <input type="hidden" name="_method" value="delete" />
        <input type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger" style="margin-top: 2px;" value="Clear All">   
        
        <a href="{{route('download_zip')}}" class="btn btn-info"><i class="fa fa-file-zip-o"></i> Download ZIP file</a>
        <a href="{{route('download_results')}}" class="btn btn-info"><i class="fa fa-file-excel-o"></i> Download Excel file</a>
    </form>
@endsection

@section('content')

	<table class="table">
      <thead class="thead-light">
        <tr>
            <th scope="col">Picture</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Mark</th>
            <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

            @foreach($answers as $answer)
                @php
                    $employee = $answer->employee
                @endphp
                <tr style="text-align:center;">
                    <td>
                        @if($employee->photo)
                            <img class="user_picture" src={{route("getEmployeeImage", [$employee->photo])}} width="40px" height="40px">
                        @else
                            <img class="user_picture" src={{asset("images/user.png")}} width="40px" height="40px">
                        @endif
                    </td>
                    <td>{{$employee->employee_id}}</td>
                    <td class="employee_name">{{$employee->name}}</td>
                    <td class="employee_mark">{{$answer->mark}}</td>
                    <td>
                        <a href="#" content="{{$answer->employee_id}}" class="btn_view_answers btn btn-primary btn-sm" style="margin-top: 2px;">View Answers</a>
                        <a href="#" content="{{$answer->employee_id}}" class="btn_view_video_answers btn btn-secondary btn-sm" style="margin-top: 2px;">Play Video</a>
                        <a href="{{ route('download_emp_result').'?employee_id='.$employee->id }}" class="btn btn-info btn-sm" style="margin-top: 2px;">Download Answers</a>
                    </td>
                </tr>
            @endforeach

      </tbody>
    </table>


<div class="modal fade answer_section_modal" action="{{route('mcq_answers')}}" tabindex="-1" role="dialog" aria-hidden="true">
    @csrf
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header bg-info">
            <h4 class="modal-title" id="employee_name">MR. XYZ</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body question_section" style="max-height: 400px; overflow-y: auto;"></div>
      </div>
    </div>
  </div>


  <div class="modal fade video_answer_section_modal" id="video_answer_section_modal" action="{{route('video_answers')}}" tabindex="-1" role="dialog" aria-hidden="true">
    @csrf
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header bg-info">
            <h4 class="modal-title" id="employee_name2">MR. XYZ</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body question_section" style="max-height: 400px; overflow-y: auto;"></div>
      </div>
    </div>
  </div>

<div class="modal fade progressbar_modal" id="progressbar_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content " style="text-align: center; background-color: #333f4f">
            <div class="modal-body" style="margin: 100px;">
            <img class="progress_bar" src="{{asset('images/progress_bar.gif')}}" height="25" width="25" style="margin: auto"/>
            </div>
        </div>
    </div>
</div>


@section('extra_script')
    <script src="{{asset('js/content/admin/mcq_answers.js')}}?v=1.1"></script>
    <script src="{{asset('js/content/admin/video_answers.js')}}?v=1.1"></script>
@endsection


@endsection
