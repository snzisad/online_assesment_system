<?php

namespace App\Imports;

use App\Model\Question;
use App\Model\Option;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MCQQuestionImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        foreach ($rows as $row)
        {
            if(!isset($row[strtolower('Questions')])){
                continue;
            }

            $question = Question::create([
               'title' => $row[strtolower('Questions')]
            ]);

            for ($i = 1; $i<=5; $i++)
            {
                if (!isset($row['option_' . $i]) || $row['option_' . $i] == ''){
                  break;  
                } 
                else{
                    if (isset($row['option'.$i.'_status']) && $row['option'.$i.'_status'] != ''){
                        $status = strtolower($row['option'.$i.'_status']);
                        
                        $mark = 0;
                        if($status=='right' || $status=='r'){
                            $mark = 1;
                        }
                        
                        Option::create([
                            'question_id' => $question->id,
                            'title' => $row['option_' . $i],
                            'mark' => $mark
                        ]);
                    }
    
                }
            }
        }

        DB::commit();
    }
}
