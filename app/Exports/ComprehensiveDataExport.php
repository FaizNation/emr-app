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

class ComprehensiveDataExport implements FromCollection, WithHeadings, WithStyles, WithMapping, WithEvents, ShouldAutoSize
{
    protected int $rowNumber = 0;

    public function collection()
    {
        return Student::with(['school', 'screening'])->get();
    }

    public function headings(): array
    {
        $this->rowNumber = 0;

        return [
            'No',
            'Nama Siswa',
            'Nik',
            'Kelas',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Tempat Lahir',
            'Nama Wali',
            'NIK Wali',
            'No HP',
            'Alamat',
            'Sekolah',
            'Jenis Sekolah',
            'Berat Badan (kg)',
            'Tinggi Badan (cm)',
            'Lingkar Perut (cm)',
            'IMT',
            'Status Gizi',
            'Tekanan Darah',
            'Mata Kanan',
            'Mata Kiri',
            'Pendengaran',
            'Gigi',
            'Anemia',
            'Kecacatan',
            'Status Kebugaran',
            'Rujukan',
            'Tanggal Skrining',
            
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
            $student->address,
            $student->school->name,
            $student->school->type,
            $student->screening?->weight ?? '-',
            $student->screening?->height ?? '-',
            $student->screening?->waist_circumference ?? '-',
            $student->screening?->bmi ?? '-',
            $student->screening?->nutritional_status ?? '-',
            $student->screening?->blood_pressure ?? '-',
            $student->screening?->vision_right ?? '-',
            $student->screening?->vision_left ?? '-',
            $student->screening?->hearing ?? '-',
            $student->screening?->dental ?? '-',
            $student->screening?->hemoglobin ?? '-',
            $student->screening?->disability ?? '-',
            $student->screening?->fitness ? 'Bugar' : 'Tidak Bugar',
            $student->screening?->referral ?? '-',
            $student->screening?->created_at->format('d/m/Y') ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {

        foreach (range('E', 'Z') as $column) {
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
        $sheet->getStyle('K')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 
        $sheet->getStyle('L')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); 

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

                $sheet->getDelegate()->mergeCells('A1:AB1');
                $sheet->getDelegate()->mergeCells('A2:AB2');
                $sheet->getDelegate()->mergeCells('A3:AB3');

                $sheet->setCellValue('A1', 'DATA HASIL SKRINING KESEHATAN SISWA');
                $sheet->setCellValue('A3', 'Tanggal Export: ' . now()->locale('id')->isoFormat('DD MMMM YYYY HH:mm:ss'));

                $titleStyles = [
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'name' => 'Arial'
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ];
                
                $subtitleStyles = [
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'name' => 'Arial'
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ];
                
                $dateStyles = [
                    'font' => [
                        'bold' => true,
                        'size' => 11,
                        'name' => 'Arial'
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

                $sheet->getDelegate()->getStyle('A1')->applyFromArray($titleStyles);
                $sheet->getDelegate()->getStyle('A2')->applyFromArray($subtitleStyles);
                $sheet->getDelegate()->getStyle('A3')->applyFromArray($dateStyles);
                $sheet->getDelegate()->getStyle('A4:AB4')->applyFromArray($dataHeaderStyles);

                $sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(2)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(3)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(4)->setRowHeight(25);
            }
        ];
    }
}
