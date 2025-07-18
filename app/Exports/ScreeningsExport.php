<?php

namespace App\Exports;

use App\Models\Screening;
use App\Models\School;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ScreeningsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    public function collection()
    {
        return Screening::where('school_id', $this->school->id)
            ->with('student')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'Kelas',
            'BB',
            'TB',
            'IMT',
            'LP',
            'Status Gizi',
            'Tekanan Darah',
            'Penglihatan Kanan',
            'Penglihatan Kiri',
            'Pendengaran',
            'Gigi',
            'Anemia',
            'Kecacatan',
            'Kebugaran',
            'Rujuk',
            'Tanggal Skrining'
        ];
    }

    public function map($screening): array
    {
        return [
            $screening->id,
            $screening->student->name,
            $screening->student->class,
            $screening->weight,
            $screening->height,
            $screening->bmi,
            $screening->waist_circumference,
            $screening->nutritional_status,
            $screening->blood_pressure,
            $screening->vision_right,
            $screening->vision_left,
            $screening->hearing,
            $screening->dental,
            $screening->hemoglobin,
            $screening->disability,
            $screening->fitness == 1 ? 'Bugar' : 'Tidak Bugar',
            $screening->referral,
            $screening->created_at->format('d/m/Y'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach (range('B', 'R') as $column) {
            $sheet->getColumnDimension($column)->setWidth(20);
            $sheet->getStyle($column)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
        $sheet->getColumnDimension('A')->setWidth(5); 
        $sheet->getColumnDimension('C')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(10);
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('J')->setWidth(18);
        $sheet->getColumnDimension('K')->setWidth(18);
        $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('Q')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;

                $sheet->getDelegate()->insertNewRowBefore(1, 3);

                $sheet->getDelegate()->mergeCells('A1:R1');
                $sheet->getDelegate()->mergeCells('A2:R2');
                $sheet->getDelegate()->mergeCells('A3:R3');

                $sheet->setCellValue('A1', 'DATA HASIL SKRINING KESEHATAN');
                $sheet->setCellValue('A2', strtoupper($this->school->name));
                $sheet->setCellValue('A3', now()->format('d F Y'));

                $titleStyles = [
                    'font' => [
                        'bold' => true,
                        'size' => 14
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ];

                $dataHeaderStyles = [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => '4472C4']
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ];

                $sheet->getDelegate()->getStyle('A1:R3')->applyFromArray($titleStyles);
                $sheet->getDelegate()->getStyle('A4:R4')->applyFromArray($dataHeaderStyles);

                $sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(2)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(3)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(4)->setRowHeight(25);
            }
        ];
    }
}
