<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeResultExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $employeeAnswers;
    public function __construct($query = null)
    {
        $this->employeeAnswers = $query;
    }

    public function headings(): array
    {
        return [
            'Question',
            'Provided Answer',
            'Correct Answer',
            'Mark',
        ];
    }

    public function map($item) : array
    {
        $correctAns = $item->question->options->where('mark', 1)->first();
        return [
            $item->question->title,
            $item->checked_option? $item->checked_option->title: '',
            $correctAns ? $correctAns->title : '',
            $item->mark
        ];
    }

    public function query()
    {
        return $this->employeeAnswers;
    }
}
