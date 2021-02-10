<?php

namespace App\Imports;

use App\Model\VideoQuestion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssesmentQuestionImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        foreach ($rows as $row)
        {
            VideoQuestion::create([
               'title' => $row['case'],
               'role' => $row['role']
            ]);

        }

        DB::commit();
    }
}
