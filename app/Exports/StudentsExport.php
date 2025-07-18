<?php

namespace App\Exports;

use App\Models\Student;
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

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    protected $rowNumber = 0;

    public function collection()
    {
        return Student::where('school_id', $this->school->id)
            ->orderBy('class')
            ->orderBy('name')
            ->get();
    }

    public function headings(): array
    {

        $this->rowNumber = 0;
        
        return [
            'No',
            'Nama',
            'NIK',
            'Kelas',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Tempat Lahir',
            'Nama Wali',
            'NIK Wali',
            'No HP'
        ];
    }

    public function map($student): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $student->name,
            \PhpOffice\PhpSpreadsheet\Shared\StringHelper::formatNumber($student->nik),
            $student->class,
            $student->gender == 'L' ? 'Laki-laki' : 'Perempuan',
            \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y'),
            $student->birth_place,
            $student->guardian_name,
            $student->guardian_nik,
            $student->phone
        ];
    }

    public function styles(Worksheet $sheet)
    {

        foreach (range('E', 'J') as $column) {
            $sheet->getColumnDimension($column)->setWidth(20);
            $sheet->getStyle($column)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(30); 
        $sheet->getColumnDimension('C')->setWidth(25); 
        $sheet->getColumnDimension('D')->setWidth(10); 
        $sheet->getColumnDimension('H')->setWidth(30); 
        $sheet->getColumnDimension('I')->setWidth(25); 
        $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 
        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 
        $sheet->getStyle('H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 

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

                $sheet->getDelegate()->mergeCells('A1:J1');
                $sheet->getDelegate()->mergeCells('A2:J2');
                $sheet->getDelegate()->mergeCells('A3:J3');

                $sheet->setCellValue('A1', 'DATA SISWA');
                $sheet->setCellValue('A2', strtoupper($this->school->name));
                $sheet->setCellValue('A3', now()->format('d F Y'));

                $headerStyles = [
                    'font' => [
                        'bold' => true,
                        'size' => 14
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ];

                $sheet->getDelegate()->getStyle('A1:A3')->applyFromArray($headerStyles);

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

                $sheet->getDelegate()->getStyle('A4:J4')->applyFromArray($dataHeaderStyles);

                $sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(2)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(3)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(4)->setRowHeight(25);
            }
        ];
    }
}
