<?php

namespace App\Imports;

use App\Model\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeeListImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {

        DB::beginTransaction();

        foreach ($rows as $row)
        {
            $doj = Date::excelToDateTimeObject($row['doj']);
            User::create([
               'employee_id' => $row['id'],
               'name' => $row['name'],
               'designation' => $row['designation'],
               'doj' => $doj->format('Y-m-d'),
            ]);
        }

        DB::commit();
    }
}
