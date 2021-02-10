@extends('layout.admin')
@section('title', 'MCQ Questions')

@section('additional_content')
    <form action="{{route('remove_all_mcq_question')}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="delete" />
        <input type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger" style="margin-top: 2px;" value="Delete All Questions">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target=".upload-mcq-question-modal"><i class="fa fa-upload"></i> Upload Excel file</a>
    </form>
@endsection

@section('content')

	<table class="table">
      <thead class="thead-light">
        <tr>
            <th scope="col">Question</th>
            <th scope="col">Options</th>
            <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

            @foreach($questions as $question)
                <tr style="text-align:center;">
                    <td>{{$question->title}}</td>
                    <td>
                        <ol type="A">
                        @foreach($question->options as $option)
                            @if($option->mark == 1)
                                <li style="color: #209e1c">{{$option->title}}</li>
                            @else
                                <li style="color: black">{{$option->title}}</li>
                            @endif
                        @endforeach
                        </ol>
                    </td>
                    <td>
                        @if($question->status == 1)
                            <a href="{{route('update_mcq_question_status', [$question->id, 0])}}" class="btn btn-warning btn-sm" style="margin-top: 2px;">Unpublish</a>
                        {{-- <a href="#" content="{{$question->id}}" class="btn-edit-info btn btn-primary btn-sm" data-toggle="modal" data-target=".edit-question-info-modal" style="margin-top: 2px;">Edit</a> --}}
                        @else

                            <form action="{{route('remove_mcq_question')}}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="id" value="{{$question->id}}" />
                                <a href="{{route('update_mcq_question_status', [$question->id, 1])}}" class="btn btn-primary btn-sm" style="margin-top: 2px;">Publish</a>
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
                <h4 class="modal-title">Edit MCQ Question Information</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Question</label><br>
                    <textarea type="text" class="form-control" id="question_title" required autofocus name="question" placeholder="Enter Question"></textarea>
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
<div class="modal fade upload-mcq-question-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form method="post" action="{{route('set_excel_mcq_questions')}}" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h4 class="modal-title">Upload MCQ Questions</h4>

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
    <script src="{{asset('js/content/admin/mcq_answers.js')}}"></script>
@endsection


@endsection
