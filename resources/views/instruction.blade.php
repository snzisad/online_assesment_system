@extends('layout/user')

@section('title', "Instructions ")

@section('content')


    <div class="modal-header">
        <h4 class="modal-title">Online Assessment</h4>
    </div>

    <div class="modal-body" style="color: black; padding: 5px;">
        <div class="content_text_center"><h4 class="btn btn-outline-success disabled" style="margin-bottom: 20px; color: red;">Instructions</h4></div>
        <h4 class="text-center">Test is designed in two parts</h4>
        <ul>
            {{--<li>Test is designed in two parts:</li>--}}
            <ol type="1">
                <li>MCQ (Basic selling skill test)</li>
                <li>Role Play (Situational assessment)</li>
            </ol>
            <li>The exam will have MCQ and role play questions.</li>
            <li>Total time for exam is 30 minutes.</li>
            <li>Negative marking exam: No.</li>
        </ul>

        {{--<p class="content_text_center" style="font-size: 20px; font-style: italic; font-weight: bold; border: 3px solid red;">Best of Luck for your Exam</p>--}}

        <form method="get" action="{{route('get_mcq_question_view')}}">
            <input type="checkbox" id="conditions" value="agree" required>
            <label for="conditions" style="margin-top: -5px;"> I have read and understood the instruction.</label>
            <input type="submit" class="btn_lets_start btn-block btn btn-success" value="I'm ready to begin">

        </form>

    </div>

@endsection
