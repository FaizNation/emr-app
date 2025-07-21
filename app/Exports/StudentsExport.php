<?php

namespace App\Exports;

use App\Models\School;
use App\Models\Student;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents, ShouldAutoSize
{
    protected $school;
    protected $academicYear;
    protected $rowNumber = 0;

    public function __construct(School $school, $academicYear)
    {
        $this->school = $school;
        $this->academicYear = $academicYear;
    }

    public function collection()
    {
        return Student::where('school_id', $this->school->id)
            ->where('academic_year', $this->academicYear)
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
            'No HP',
            'Alamat'
        ];
    }

    public function map($student): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $student->name,
            " " . $student->nik,
            $student->class,
            $student->gender == 'L' ? 'Laki-laki' : 'Perempuan',
            \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y'),
            $student->birth_place,
            $student->guardian_name,
            " " . $student->guardian_nik,
            $student->phone,
            $student->address
        ];
    }

    public function styles(Worksheet $sheet)
    {

        foreach (range('E', 'K') as $column) {
            $sheet->getColumnDimension($column)->setWidth(20);
            $sheet->getStyle($column)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(30); 
        $sheet->getColumnDimension('C')->setWidth(25); 
        $sheet->getColumnDimension('D')->setWidth(10); 
        $sheet->getColumnDimension('H')->setWidth(30); 
        $sheet->getColumnDimension('I')->setWidth(25); 
        $sheet->getColumnDimension('k')->setWidth(30); 
        $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 
        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 
        $sheet->getStyle('H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 
        $sheet->getStyle('K')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 

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

                $sheet->getDelegate()->mergeCells('A1:K1');
                $sheet->getDelegate()->mergeCells('A2:K2');
                $sheet->getDelegate()->mergeCells('A3:K3');

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

                $sheet->getDelegate()->getStyle('A4:K4')->applyFromArray($dataHeaderStyles);

                $sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(2)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(3)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(4)->setRowHeight(25);
            }
        ];
    }
}
