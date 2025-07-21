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

    protected $academicYear;
    protected $search;
    protected $schoolType;
    protected $screeningStatus;
    protected $sort;

    public function __construct($academicYear = null, $search = null, $schoolType = null, $screeningStatus = null, $sort = null)
    {
        $this->academicYear = $academicYear ?? now()->year;
        $this->search = $search;
        $this->schoolType = $schoolType;
        $this->screeningStatus = $screeningStatus;
        $this->sort = $sort;
    }

    public function collection()
    {
        $query = Student::with(['school', 'screening'])
            ->where('academic_year', $this->academicYear);

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('school', function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Apply school type filter
        if ($this->schoolType) {
            $query->whereHas('school', function($q) {
                $q->where('type', $this->schoolType);
            });
        }

        // Apply screening status filter
        if ($this->screeningStatus !== null) {
            if ($this->screeningStatus == '1') {
                $query->has('screening');
            } else {
                $query->doesntHave('screening');
            }
        }

        // Apply sorting
        if ($this->sort) {
            if (strpos($this->sort, 'school_id_') === 0) {
                $schoolId = substr($this->sort, 10);
                $query->where('school_id', $schoolId);
            } else {
                switch ($this->sort) {
                    case 'name_asc':
                        $query->orderBy('name', 'asc');
                        break;
                    case 'name_desc':
                        $query->orderBy('name', 'desc');
                        break;
                    case 'school_asc':
                        $query->join('schools', 'students.school_id', '=', 'schools.id')
                            ->orderBy('schools.name', 'asc')
                            ->select('students.*');
                        break;
                    case 'school_desc':
                        $query->join('schools', 'students.school_id', '=', 'schools.id')
                            ->orderBy('schools.name', 'desc')
                            ->select('students.*');
                        break;
                }
            }
        }

        return $query->get();
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

                $sheet->getDelegate()->insertNewRowBefore(1, 4);

                $sheet->getDelegate()->mergeCells('A1:AB1');
                $sheet->getDelegate()->mergeCells('A2:AB2');
                $sheet->getDelegate()->mergeCells('A3:AB3');
                $sheet->getDelegate()->mergeCells('A4:AB4');

                $sheet->setCellValue('A1', 'DATA HASIL SKRINING KESEHATAN SISWA');
                $sheet->setCellValue('A2', 'TAHUN AJARAN ' . $this->academicYear . '/' . ($this->academicYear + 1));
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

                $sheet->getDelegate()->getStyle('A1')->applyFromArray($titleStyles);
                $sheet->getDelegate()->getStyle('A2')->applyFromArray($subtitleStyles);
                $sheet->getDelegate()->getStyle('A3')->applyFromArray($subtitleStyles);
                $sheet->getDelegate()->getStyle('A4')->applyFromArray($dateStyles);

                $sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(2)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(3)->setRowHeight(30);
                $sheet->getDelegate()->getRowDimension(4)->setRowHeight(30);
            }
        ];
    }
}
