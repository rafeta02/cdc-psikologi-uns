<?php

namespace App\Exports;

use App\Models\ResultAssessment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AssessmentExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    public function collection()
    {
        return ResultAssessment::with(['user', 'hollandTest', 'workReadinessTest', 'careerConfidenceTest'])->get();
    }

    public function headings(): array
    {
        return [
            'Username', 'Initial', 'Age', 'Gender', 'Field',
            // HollandTest
            'Holland R1', 'Holland R2', 'Holland R3', 'Holland R4', 'Holland R5', 'Holland R6', 'Holland R7', 'Holland R8',
            'Holland I1', 'Holland I2', 'Holland I3', 'Holland I4', 'Holland I5', 'Holland I6', 'Holland I7', 'Holland I8',
            'Holland A1', 'Holland A2', 'Holland A3', 'Holland A4', 'Holland A5', 'Holland A6', 'Holland A7', 'Holland A8',
            'Holland S1', 'Holland S2', 'Holland S3', 'Holland S4', 'Holland S5', 'Holland S6', 'Holland S7', 'Holland S8',
            'Holland E1', 'Holland E2', 'Holland E3', 'Holland E4', 'Holland E5', 'Holland E6', 'Holland E7', 'Holland E8',
            'Holland C1', 'Holland C2', 'Holland C3', 'Holland C4', 'Holland C5', 'Holland C6', 'Holland C7', 'Holland C8',
            // WorkReadinessTest
            'CBS 1', 'CBS 2', 'CBS 3', 'CBS 4', 'CBS 5', 'CBS 6', 'CBS 7', 'CBS 8', 'CBS 9', 'CBS 10',
            'CMS 1', 'CMS 2', 'CMS 3', 'CMS 4',
            'CS 1', 'CS 2', 'CS 3', 'CS 4', 'CS 5', 'CS 6', 'CS 7', 'CS 8', 'CS 9',
            'FS 1', 'FS 2', 'FS 3',
            'ICS 1', 'ICS 2', 'ICS 3', 'ICS 4', 'ICS 5',
            'ITS 1', 'ITS 2', 'ITS 3',
            'LS 1', 'LS 2', 'LS 3', 'LS 4', 'LS 5',
            'SMS 1', 'SMS 3', 'SMS 4', 'SMS 5', 'SMS 7', 'SMS 9',
            'STS 1', 'STS 2', 'STS 3', 'STS 4',
            'TPS 2', 'TPS 4', 'TPS 5', 'TPS 6',
            // CareerConfidenceTest
            'Career R1', 'Career R2', 'Career R3', 'Career R4',
            'Career I1', 'Career I2', 'Career I3', 'Career I4',
            'Career A1', 'Career A2', 'Career A3', 'Career A4',
            'Career S1', 'Career S2', 'Career S3', 'Career S4',
            'Career E1', 'Career E2', 'Career E3', 'Career E4',
            'Career C1', 'Career C2', 'Career C3', 'Career C4',
        ];
    }

    public function map($resultAssessment): array
    {
        return [
            $resultAssessment->user->name ?? '',
            $resultAssessment->initial ?? '',
            $resultAssessment->age ?? '',
            $resultAssessment->gender ?? '',
            $resultAssessment->field ?? '',
            // HollandTest data
            (string) ($resultAssessment->hollandTest->r_1 ?? 0),
            (string) ($resultAssessment->hollandTest->r_2 ?? 0),
            (string) ($resultAssessment->hollandTest->r_3 ?? 0),
            (string) ($resultAssessment->hollandTest->r_4 ?? 0),
            (string) ($resultAssessment->hollandTest->r_5 ?? 0),
            (string) ($resultAssessment->hollandTest->r_6 ?? 0),
            (string) ($resultAssessment->hollandTest->r_7 ?? 0),
            (string) ($resultAssessment->hollandTest->r_8 ?? 0),
            (string) ($resultAssessment->hollandTest->i_1 ?? 0),
            (string) ($resultAssessment->hollandTest->i_2 ?? 0),
            (string) ($resultAssessment->hollandTest->i_3 ?? 0),
            (string) ($resultAssessment->hollandTest->i_4 ?? 0),
            (string) ($resultAssessment->hollandTest->i_5 ?? 0),
            (string) ($resultAssessment->hollandTest->i_6 ?? 0),
            (string) ($resultAssessment->hollandTest->i_7 ?? 0),
            (string) ($resultAssessment->hollandTest->i_8 ?? 0),
            (string) ($resultAssessment->hollandTest->a_1 ?? 0),
            (string) ($resultAssessment->hollandTest->a_2 ?? 0),
            (string) ($resultAssessment->hollandTest->a_3 ?? 0),
            (string) ($resultAssessment->hollandTest->a_4 ?? 0),
            (string) ($resultAssessment->hollandTest->a_5 ?? 0),
            (string) ($resultAssessment->hollandTest->a_6 ?? 0),
            (string) ($resultAssessment->hollandTest->a_7 ?? 0),
            (string) ($resultAssessment->hollandTest->a_8 ?? 0),
            (string) ($resultAssessment->hollandTest->s_1 ?? 0),
            (string) ($resultAssessment->hollandTest->s_2 ?? 0),
            (string) ($resultAssessment->hollandTest->s_3 ?? 0),
            (string) ($resultAssessment->hollandTest->s_4 ?? 0),
            (string) ($resultAssessment->hollandTest->s_5 ?? 0),
            (string) ($resultAssessment->hollandTest->s_6 ?? 0),
            (string) ($resultAssessment->hollandTest->s_7 ?? 0),
            (string) ($resultAssessment->hollandTest->s_8 ?? 0),
            (string) ($resultAssessment->hollandTest->e_1 ?? 0),
            (string) ($resultAssessment->hollandTest->e_2 ?? 0),
            (string) ($resultAssessment->hollandTest->e_3 ?? 0),
            (string) ($resultAssessment->hollandTest->e_4 ?? 0),
            (string) ($resultAssessment->hollandTest->e_5 ?? 0),
            (string) ($resultAssessment->hollandTest->e_6 ?? 0),
            (string) ($resultAssessment->hollandTest->e_7 ?? 0),
            (string) ($resultAssessment->hollandTest->e_8 ?? 0),
            (string) ($resultAssessment->hollandTest->c_1 ?? 0),
            (string) ($resultAssessment->hollandTest->c_2 ?? 0),
            (string) ($resultAssessment->hollandTest->c_3 ?? 0),
            (string) ($resultAssessment->hollandTest->c_4 ?? 0),
            (string) ($resultAssessment->hollandTest->c_5 ?? 0),
            (string) ($resultAssessment->hollandTest->c_6 ?? 0),
            (string) ($resultAssessment->hollandTest->c_7 ?? 0),
            (string) ($resultAssessment->hollandTest->c_8 ?? 0),
            // WorkReadinessTest data
            (string) ($resultAssessment->workReadinessTest->cbs_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_4 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_5 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_6 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_7 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_8 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_9 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cbs_10 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cms_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cms_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cms_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cms_4 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_4 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_5 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_6 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_7 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_8 ?? 0),
            (string) ($resultAssessment->workReadinessTest->cs_9 ?? 0),
            (string) ($resultAssessment->workReadinessTest->fs_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->fs_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->fs_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ics_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ics_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ics_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ics_4 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ics_5 ?? 0),
            (string) ($resultAssessment->workReadinessTest->its_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->its_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->its_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ls_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ls_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ls_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ls_4 ?? 0),
            (string) ($resultAssessment->workReadinessTest->ls_5 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sms_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sms_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sms_4 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sms_5 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sms_7 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sms_9 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sts_1 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sts_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sts_3 ?? 0),
            (string) ($resultAssessment->workReadinessTest->sts_4 ?? 0),
            (string) ($resultAssessment->workReadinessTest->tps_2 ?? 0),
            (string) ($resultAssessment->workReadinessTest->tps_4 ?? 0),
            (string) ($resultAssessment->workReadinessTest->tps_5 ?? 0),
            (string) ($resultAssessment->workReadinessTest->tps_6 ?? 0),
            // CareerConfidenceTest data
            (string) ($resultAssessment->careerConfidenceTest->r_1 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->r_2 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->r_3 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->r_4 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->i_1 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->i_2 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->i_3 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->i_4 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->a_1 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->a_2 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->a_3 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->a_4 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->s_1 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->s_2 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->s_3 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->s_4 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->e_1 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->e_2 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->e_3 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->e_4 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->c_1 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->c_2 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->c_3 ?? 0),
            (string) ($resultAssessment->careerConfidenceTest->c_4 ?? 0),
        ];
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
