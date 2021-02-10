<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeResultExport;
use Carbon\Carbon;
use App\Imports\MCQQuestionImport;
use App\Imports\EmployeeListImport;
use App\Imports\AssesmentQuestionImport;
use App\Exports\MCQResultExport;
use App\Exports\AssesmentResultExport;
use App\Model\User;
use App\Model\OptionUser;
use App\Model\Question;
use App\Model\Option;
use App\Model\Admin;
use App\Model\VideoAnswer;
use App\Model\VideoQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function downloadZIP(){
        $zip = new ZipArchive;
        $fileName = Carbon::now()->format('Y-m-d_H-m-s').'.zip';


        DB::beginTransaction();

        if ($zip->open(public_path($fileName), ZipArchive::CREATE) == TRUE){


            $mcq_results = "MCQ_Results.xlsx";
            $assesment_results = "Assesment_Results.xlsx";
            $zip->addFile(Excel::download(new MCQResultExport, $mcq_results)->getFile(), $mcq_results);
            $zip->addFile(Excel::download(new AssesmentResultExport, $assesment_results)->getFile(), $assesment_results);

            $users = VideoAnswer::select('employee_id')->distinct()->get();

            foreach ($users as $user){
                $employee_id =  $user->employee_id;
                $answers = VideoAnswer::where('employee_id', $employee_id)->with(["employee"])->get();

                foreach ($answers as $answer){
                    $file_path = public_path("storage/videos/".$answer->video);
                    $uploadedFile = new File($file_path);

                    $zip->addFile($uploadedFile, "".$answer->employee->employee_id."/".$answer->video);
                }
            }

            $zip->close();
            DB::commit();

            return response()->download(public_path($fileName));

        }
    }


    public function downloadResult(){
        $file_name = Carbon::now()->toDateTimeString().".xlsx";
        return Excel::download(new MCQResultExport, $file_name);
    }

    public function downloadEmployeeResult(Request $request){
        $this->validate($request, [
            "employee_id" => "required",
        ]);

        $employee = User::findOrFail($request->employee_id);
        $employeeOptions = OptionUser::where("employee_id", $request->employee_id)->with("question", "checked_option");
        $file_name = "UserId_{$employee->employee_id}_{$employee->name}".".xlsx";

        return (new EmployeeResultExport($employeeOptions))->download($file_name);
    }


    public function getResult(){
        $answers = OptionUser::selectRaw('sum(mark) as mark, employee_id')
            ->groupBy('employee_id')
            ->with('employee')
            ->get();

        return view("/admin/result")->with(["answers"=>$answers]);
    }

    public function getMCQQuestions(){
        $questions = Question::orderBy("id", "ASC")->get();

        return view("/admin/mcq_questions")->with(["questions"=>$questions]);
    }

    public function updateMCQQuestionStatus($id, $status){
        Question::where("id", $id)->update([
            "status" => $status
        ]);

        return redirect()->back()->with("message", "Status updated successfully");
    }

    public function removeMCQQuestion(Request $request){
        $this->validate($request, [
            "id" => "required"
        ]);

        $question = OptionUser::where("question_id", $request->id)->first();

        if($question){

            return redirect()->back()->withErrors("Error. This question is already answered by some employees.");
        }
        else{
            Question::where("id", $request->id)->delete();
            Option::where("question_id", $request->id)->delete();

            return redirect()->back()->with("message", "Question removed successfully");
        }
    }


    public function removeAllMCQQuestion(Request $request){
        $answers = OptionUser::get();
        
        if(sizeof($answers)>0){
            return redirect()->back()->withErrors("Result is already published. Clear the result first");
        }
        else{
            Question::truncate();
            Option::truncate();
            
            return redirect()->back()->with("message", "All Question removed successfully");
        }
    }


    public function getEmployerList(){
        $admins = Admin::orderBy("id", "DESC")->get();

        return view("/admin/admin_list")->with(["admins"=>$admins]);
    }


    public function addEmployer(Request $request){
        $this->validate($request, [
            "employee_id" => "required",
            "name" => "required",
            "designation" => "required",
            "password" => "required",
            "doj" => "required|date",
            "picture" => "mimes: jpg,png,jpeg",
        ]);
        $request->merge(['password' => Hash::make($request->password)]);
        $user = Admin::create($request->all());

        if($user){

            if($request->picture){
                $file = $request->picture;
                $name = Str::random(10);
                $fname=$user->id."_".$name.".".$file->extension();
                $file->storeAs('public/images/employer', $fname);

                Admin::where('id',$user->id)->update([
                    "photo" => $fname,
                ]);
            }

            return redirect()->back()->with("message", "Employer added successfully");
        }

        return redirect()->back()->withError("Invalid data. Please try again.");

        // dd($request);

    }



    public function editEmployer(Request $request){
        $this->validate($request, [
            "employee_id" => "required",
            "name" => "required",
            "designation" => "required",
            "doj" => "required|date",
            "picture" => "mimes: jpg,png,jpeg",
        ]);

        $user = Admin::where('employee_id', $request->employee_id)->first();


        if($user){

            if($request->picture){
                $file = $request->picture;
                $name = Str::random(10);
                $fname=$user->id."_".$name.".".$file->extension();
                $file->storeAs('public/images/employer', $fname);

                Storage::delete('public/images/employer/'.$user->photo);

                Admin::where('id',$user->id)->update([
                    "name" => $request->name,
                    "designation" => $request->designation,
                    "doj" => $request->doj,
                    "photo" => $fname,
                ]);
            }
            else{
                Admin::where('id',$user->id)->update([
                    "name" => $request->name,
                    "designation" => $request->designation,
                    "doj" => $request->doj,
                ]);
            }

            return redirect()->back()->with("message", "Employer information updated successfully");
        }

        return redirect()->back()->withError("Invalid data. Please try again.");

    }

    public function removeEmployer(Request $request){
        $this->validate($request, [
            "employee_id" => "required"
        ]);

        $user = Admin::where("id", $request->employee_id)->first();

        if($user){
            Admin::where("id", $request->employee_id)->delete();
            Storage::delete('public/images/employer/'.$user->photo);

            return redirect()->back()->with("message", "Employer removed successfully");
        }
        else{
            return redirect()->back()->withError("Invalid data. Please try again.");
        }
    }


    public function resetPassofEmployer(Request $request){
        $this->validate($request, [
            "employee_id" => "required",
            "password" => "required"
        ]);

        $user = Admin::where("employee_id", $request->employee_id)->first();

        if($user){
            Admin::where("id", $user->id)->update([
                "password" => Hash::make($request->password)
            ]);

            return redirect()->back()->with("message", "Employer password changed successfully");
        }
        else{
            return redirect()->back()->withError("Invalid data. Please try again.");
        }
    }

    public function getVideoQuestions(){
        $questions = VideoQuestion::orderBy("id", "DESC")->get();

        return view("/admin/video_questions")->with(["questions"=>$questions]);
    }


    public function editVideoQuestion(Request $request){
        $this->validate($request, [
            "id" => "required",
            "case" => "required",
            "role" => "required",
        ]);

        // dd($request->all());

        $question = VideoQuestion::where('id', $request->id)->first();


        if($question){
            VideoQuestion::where('id',$question->id)->update([
                "title" => $request->case,
                "role" => $request->role,
            ]);

            return redirect()->back()->with("message", "Question updated successfully");
        }

        return redirect()->back()->withError("Invalid data. Please try again.");
    }


    public function updateVideoQuestionStatus($id, $status){
        VideoQuestion::where("id", $id)->update([
            "status" => $status
        ]);

        return redirect()->back()->with("message", "Status updated successfully");
    }


    public function removeVidoeQuestion(Request $request){
        $this->validate($request, [
            "id" => "required"
        ]);

        $question = VideoAnswer::where("question_id", $request->id)->first();

        if($question){

            return redirect()->back()->withErrors("Error. This question is already answered by some employees.");
        }
        else{
            VideoQuestion::where("id", $request->id)->delete();

            return redirect()->back()->with("message", "Question removed successfully");
        }
    }


    public function removeAllVidoeQuestion(Request $request){
        $answers = VideoAnswer::get();

        if(sizeof($answers)>0){
            
            return redirect()->back()->withErrors("Result is already published. Clear the result first");
        }
        else{
            VideoQuestion::truncate();
            
            return redirect()->back()->with("message", "All Question removed successfully");
        }

    }


    public function getEmployeeList(){
        $employees = User::orderBy("id", "DESC")->get();

        return view("/admin/employeelist")->with(["employees"=>$employees]);
    }

    public function getEmployeeMCQAnswer(Request $request){
        $answers = OptionUser::where("employee_id", $request->employee_id)->with("question", "checked_option")->get();

        $data = [
            "status" => true,
            "answers" => $answers
        ];

        $json_string = json_encode($data, JSON_PRETTY_PRINT);
        return $json_string;
    }

    public function getEmployeeVideoAnswer(Request $request){
        $answers = VideoAnswer::where("employee_id", $request->employee_id)->with("question")->get();

        $data = [
            "status" => true,
            "answers" => $answers
        ];


        $json_string = json_encode($data, JSON_PRETTY_PRINT);
        return $json_string;
    }

    public function addEmployee(Request $request){
        $this->validate($request, [
            "employee_id" => "required",
            "name" => "required",
            "designation" => "required",
            "doj" => "required|date",
            "picture" => "mimes: jpg,png,jpeg",
        ]);

        $user = User::create($request->all());

        if($user){

            if($request->picture){
                $file = $request->picture;
                $name = Str::random(10);
                $fname=$user->id."_".$name.".".$file->extension();
                $file->storeAs('public/images/employee', $fname);

                User::where('id',$user->id)->update([
                    "photo" => $fname,
                ]);
            }

            return redirect()->back()->with("message", "Employee added successfully");
        }

        return redirect()->back()->withError("Invalid data. Please try again.");

        // dd($request);

    }


    public function editEmployee(Request $request){
        $this->validate($request, [
            "employee_id" => "required",
            "name" => "required",
            "designation" => "required",
            "doj" => "required|date",
            "picture" => "mimes: jpg,png,jpeg",
        ]);

        $user = User::where('employee_id', $request->employee_id)->first();

        if($user){

            if($request->picture){
                $file = $request->picture;
                $name = Str::random(10);
                $fname=$user->id."_".$name.".".$file->extension();
                $file->storeAs('public/images/employee', $fname);

                Storage::delete('public/images/employee/'.$user->photo);

                User::where('id',$user->id)->update([
                    "name" => $request->name,
                    "designation" => $request->designation,
                    "doj" => $request->doj,
                    "photo" => $fname,
                ]);
            }
            else{
                User::where('id',$user->id)->update([
                    "name" => $request->name,
                    "designation" => $request->designation,
                    "doj" => $request->doj,
                ]);
            }

            return redirect()->back()->with("message", "Employee information updated successfully");
        }

        return redirect()->back()->withError("Invalid data. Please try again.");

        // dd($request);

    }

    public function removeEmployee(Request $request){
        $this->validate($request, [
            "employee_id" => "required"
        ]);

        $user = User::where("id", $request->employee_id)->first();

        if($user){
            User::where("id", $request->employee_id)->delete();
            OptionUser::where("employee_id", $user->id)->delete();
            Storage::delete('public/images/employee/'.$user->photo);

            return redirect()->back()->with("message", "Employee removed successfully");
        }
        else{
            return redirect()->back()->withError("Invalid data. Please try again.");
        }
    }


    public function removeAllEmployee(Request $request){
        $answers = VideoAnswer::get();

        foreach($answers as $answer){
            $ans = Storage::delete('public/videos/'.$answer->video);
        }

        OptionUser::truncate();
        VideoAnswer::truncate();
        User::truncate();

        return redirect()->back()->with("message", "All employee removed successfully");

    }


    public function removeAllAnswers(Request $request){
        $answers = VideoAnswer::get();

        foreach($answers as $answer){
            $ans = Storage::delete('public/videos/'.$answer->video);
        }

        OptionUser::truncate();
        VideoAnswer::truncate();

        return redirect()->back()->with("message", "Results removed successfully");

    }


    public function importMCQQuestion(Request $request)
    {
        $answers = OptionUser::get();
        
        if(sizeof($answers)>0){
            return redirect()->back()->withErrors("Result is already published. Clear the result first");
        }
        else{
            Question::truncate();
            Option::truncate();
            

            $this->validate($request, [
                "question" => "required|mimes:xlsx",
            ]);
    
            Excel::import(new MCQQuestionImport(), $request->question);
            
        
            return redirect()->back()->with("message", "Question uploaded successfully");
        }
    }

    public function importAssesmentQuestion(Request $request)
    {
        $answers = VideoAnswer::get();
        
        if(sizeof($answers)>0){
            return redirect()->back()->withErrors("Result is already published. Clear the result first");
        }
        else{
            VideoAnswer::truncate();
            
            $this->validate($request, [
                "question" => "required|mimes:xlsx",
            ]);
    
            Excel::import(new AssesmentQuestionImport(), $request->question);
            return redirect()->back()->with("message", "Question uploaded successfully");
        }
    }

    public function importEmployeeList(Request $request)
    {
        $this->validate($request, [
            "employees" => "required|mimes:xlsx",
        ]);

        Excel::import(new EmployeeListImport(), $request->employees);
        return redirect()->back()->with("message", "Employee list uploaded successfully");
    }
}
