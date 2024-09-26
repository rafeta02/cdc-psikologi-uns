<?php

namespace App\Exports;

use App\Models\ResultAssessment;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AssessmentTypeExport implements FromQuery, WithMapping, WithHeadings, WithEvents
{
    protected $startDate;
    protected $endDate;
    protected $type;

    public function __construct($startDate, $endDate, $type)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->type = $type;
    }

    public function query()
    {
        return ResultAssessment::query()
            ->with(['user', 'hollandTest', 'workReadinessTest', 'careerConfidenceTest'])
            ->where('test_name', $this->type)
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    public function headings(): array
    {
        $headings = ['Username', 'Initial', 'Age', 'Gender', 'Field'];

        $questions = Question::where('type', $this->type)->orderBy('number', 'ASC')->get();
        foreach ($questions as $question) {
            $headings[] = strtoupper($question->code);
        }

        return $headings;
    }

    public function map($resultAssessment): array
    {
        $results = [
            $resultAssessment->user->name ?? '',
            $resultAssessment->initial ?? '',
            $resultAssessment->age ?? '',
            $resultAssessment->gender ?? '',
            $resultAssessment->field ?? ''
        ];

        if ($this->type == 'hci') {
            $assesment = $resultAssessment->hollandTest;
        } elseif ($this->type == 'wr') {
            $assesment = $resultAssessment->workReadinessTest;
        } elseif ($this->type == 'cci') {
            $assesment = $resultAssessment->careerConfidenceTest;
        }

        $questions = Question::where('type', $this->type)->orderBy('number', 'ASC')->get();
        foreach ($questions as $question) {
            $results[] = (string) $assesment->{$question->code} ?? 0;
        }

        return $results;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Format header row
                $event->sheet->getStyle('A1:DZ1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
