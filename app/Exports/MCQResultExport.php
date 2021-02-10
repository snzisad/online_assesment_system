<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Model\OptionUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class MCQResultExport implements FromCollection
{
    public function collection()
    {
      $data = [];

      DB::beginTransaction();
      
      $answers = OptionUser::selectRaw('sum(mark) as mark, employee_id')
        ->groupBy('employee_id')
        ->with('employee')
        ->get();

        array_push($data, [
          'employee_id' => "ID",
          'name' => "Name",
          'designation' => "Designation",
          'mark' => "Mark",
          'question_1' => "Question 1",
          'answer_1' => "Selected Answer",
          'correct_answer_1' => "Correct Answer",
          'question_2' => "Question 2",
          'answer_2' => "Selected Answer",
          'correct_answer_2' => "Correct Answer",
          'question_3' => "Question 3",
          'answer_3' => "Selected Answer",
          'correct_answer_3' => "Correct Answer",
          'question_4' => "Question 4",
          'answer_4' => "Selected Answer",
          'correct_answer_4' => "Correct Answer",
          'question_5' => "Question 5",
          'answer_5' => "Selected Answer",
          'correct_answer_5' => "Correct Answer",
          'question_6' => "Question 6",
          'answer_6' => "Selected Answer",
          'correct_answer_6' => "Correct Answer",
          'question_7' => "Question 7",
          'answer_7' => "Selected Answer",
          'correct_answer_7' => "Correct Answer",
          'question_8' => "Question 8",
          'answer_8' => "Selected Answer",
          'correct_answer_8' => "Correct Answer",
          'question_9' => "Question 9",
          'answer_9' => "Selected Answer",
          'correct_answer_9' => "Correct Answer",
          'question_10' => "Question 10",
          'answer_10' => "Selected Answer",
          'correct_answer_10' => "Correct Answer",
        ]);

      foreach ($answers as $answer){
        $employee = $answer->employee;
        $employee_id = $employee->id;
        $options = OptionUser::where('employee_id', $employee->id)->with("question", "checked_option")->get();

        $employee_info = [
            'employee_id' => $employee->employee_id,
            'name' => $employee->name,
            'designation' => $employee->designation,
            'mark' => $answer->mark
        ];

        $i = 1;
        foreach ($options as $option){
          $question = $option->question;

          $employee_info['question_'.$i] = $question->title;

          $correct_answer = "";
          if($option->checked_option){
            $employee_info['answer_'.$i] =  $option->checked_option->title;

            if($option->checked_option->mark == 1){
              $correct_answer = $option->checked_option->title;
            }
          }
          else{
            $employee_info['answer_'.$i] =  "";
          }

          if($correct_answer == ""){
            foreach($question->options as $question_option){
              if($question_option->mark == 1){
                $correct_answer = $question_option->title;
                break;
              }
            }
          }
          $employee_info['correct_answer_'.$i] =  $correct_answer;

          $i++;
        }

        array_push($data, $employee_info);
      }

      DB::commit();
      return collect($data);
    }
}
