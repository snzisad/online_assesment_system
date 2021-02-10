@extends('layout.admin')
@section('title', 'Situation Assesment Questions')

@section('additional_content')
    <form action="{{route('remove_all_video_question')}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="delete" />
        <input type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger" style="margin-top: 2px;" value="Delete All Questions">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target=".upload-assesment-question-modal"><i class="fa fa-upload"></i> Upload Excel file</a>
    </form>
@endsection

@section('content')

	<table class="table">
      <thead class="thead-light">
        <tr>
            <th scope="col">Case</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

            @foreach($questions as $question)
                <tr style="text-align:center;">
                    <td class="question_case">{{$question->title}}</td>
                    <td class="question_role">{{$question->role}}</td>
                    <td>
                        @if($question->status == 1)
                            <a href="{{route('update_video_question_status', [$question->id, 0])}}" class="btn btn-warning btn-sm" style="margin-top: 2px;">Unpublish</a>
                        @else

                            <form action="{{route('remove_video_question')}}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="id" value="{{$question->id}}" />
                                <a href="{{route('update_video_question_status', [$question->id, 1])}}" class="btn btn-primary btn-sm" style="margin-top: 2px;">Publish</a>
                                <input type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-sm" style="margin-top: 2px;" value="Delete">
                            </form>

                        @endif
                    </td>
                </tr>
            @endforeach

      </tbody>
    </table>

{{-- Edit Modal --}}
<div class="modal fade edit-question-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form method="post" action="{{route('edit_situation_assesment')}}">
            @csrf
            <input type="hidden" id="question_id" name="id">

            <div class="modal-header">
                <h4 class="modal-title">Edit Assesment Question Information</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Case</label><br>
                    <textarea type="text" class="form-control" id="question_case" required autofocus name="case" placeholder="Enter Case"></textarea>
                </div>
                <div class="form-group">
                    <label for="name">Role</label><br>
                    <textarea type="text" class="form-control" id="question_role" required autofocus name="role" placeholder="Enter Role"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>


{{-- Upload MCQ Question Modal --}}
<div class="modal fade upload-assesment-question-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form method="post" action="{{route('set_excel_assesment_questions')}}" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h4 class="modal-title">Upload Assesment Questions</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Select excel sheet</label><br>
                    <input type="file" name="question" required autofocus/>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
        </div>
    </div>
</div>


@section('extra_script')
    <script src="{{asset('js/content/admin/situation_assesment.js')}}"></script>
@endsection


@endsection
