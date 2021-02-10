<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Model\VideoAnswer;
use App\Model\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssesmentResultExport implements FromCollection
{
    public function collection()
    {
      $data = [];
      DB::beginTransaction();
      
      $users = VideoAnswer::select('employee_id')->distinct()->get();

      array_push($data, [
        'employee_id' => "ID",
        'name' => "Name",
        'designation' => "Designation",
        'case_1' => "Case 1",
        'role_1' => "Role 1",
        'video_1' => "Video 1",
        'case_2' => "Case 2",
        'role_2' => "Role 2",
        'video_2' => "Video 2",
      ]);

      foreach ($users as $user){
        $answers = VideoAnswer::where('employee_id', $user->employee_id)->with(["question"])->get();
        $user_info = User::where('id', $user->employee_id)->first();

        $employee_info = [
            'employee_id' => $user_info->employee_id,
            'name' => $user_info->name,
            'designation' => $user_info->designation,
        ];

        $i = 1;
        foreach ($answers as $answer){
              $question = $answer->question;
              $employee_info['case_'.$i] = $question->title;
              $employee_info['role_'.$i] = $question->role;
              $employee_info['video_'.$i] = "".$user_info->employee_id."/".$answer->video;

              $i++;
        }
        array_push($data, $employee_info);
      }

      DB::commit();
      return collect($data);
    }
}
