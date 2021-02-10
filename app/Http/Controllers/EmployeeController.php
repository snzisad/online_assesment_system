<?php

namespace App\Http\Controllers;
use App\Http\ResponseTrait;
use App\Model\OptionUser;
use App\Model\Question;
use App\Model\VideoQuestion;
use App\Model\VideoAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class EmployeeController extends Controller
{
    use ResponseTrait;

    public function test(){
        return view('recording2');
    }

    public function getUserInfo(){
        $user = Auth::user();

        return view('welcome')->with(['user'=>$user]);
    }


    public function getMCQQuestionsView(){
        // checking if employee has already participated

        $options = OptionUser::where("employee_id", Auth::user()['id'])->get();

        if(sizeof($options)<10){
            OptionUser::where("employee_id", Auth::user()['id'])->delete();
            return view('mcq_question');
        }
        else{
            return redirect("/situation_question");
        }

    }


    public function getMCQQuestions(Request $request){
        // checking if employee has already participated

        $questions = Question::where("status", 1)->inRandomOrder()->limit(10)->get();

        $data = $this->successResponse($questions);
        return response()->json($data);
    }

    public function uploadVideo(Request $request){
        $this->validate($request, [
            "quesion_id" => "required",
            "video" => "required",
        ]);

        $user = Auth::user();

        if($request->hasFile("video")){
            $file = $request->video;
            $fname=$user->employee_id."_".$request->quesion_id.".".$file->extension();
            $file->storeAs('public/videos/', $fname);

            VideoAnswer::create([
                "employee_id" => $user['id'],
                "question_id" => $request->quesion_id,
                "video" => $fname,
            ]);
    
            return response()->json(["status"=>$fname]);
        }

        return response()->json(["status"=>"Fail"]);
    }

    public function setMCQAnswers(Request $request){
        $this->validate($request, [
            "mcq_answers" => "required",
        ]);

        $user_id = Auth::user()['id'];

        foreach($request->mcq_answers as $answer){
            OptionUser::create([
                'employee_id' => $user_id,
                'option_id' => $answer["checked_option_id"],
                'question_id' => $answer["question_id"],
                'mark' => $answer["mark"],
            ]);
        }

        $data = $this->successResponse("Success");
        return response()->json($data);
    }
    
    
    public function getVideoQuestionsView(){
        $answers = VideoAnswer::where("employee_id", Auth::user()['id'])->get();

        if(sizeof($answers)<2){
            VideoAnswer::where("employee_id", Auth::user()['id'])->delete();

            foreach($answers as $answer){
                $ans = Storage::delete('public/videos/'.$answer->video);
            }

            return view('video_question');
        }
        else{
            return redirect("/thank_you");
        }

    }

    public function getSituationAssesmentQuestions(){
        $questions = VideoQuestion::where("status", 1)->inRandomOrder()->limit(2)->get();

        $data = $this->successResponse($questions);
        return response()->json($data);
    }
}
