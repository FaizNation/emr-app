<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Exports\ComprehensiveDataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ComprehensiveController extends Controller
{
    protected function getCurrentAcademicYear()
    {
        $now = now();
        $year = $now->year;
        // Jika bulan saat ini adalah Juli atau setelahnya, maka tahun ajaran baru dimulai
        if ($now->month >= 7) {
            return $year;
        }
        // Jika bulan saat ini sebelum Juli, maka masih tahun ajaran sebelumnya
        return $year - 1;
    }

    public function index()
    {
        $schools = School::all();
        $currentAcademicYear = $this->getCurrentAcademicYear();
        $students = Student::with(['school', 'screening'])
            ->where('academic_year', $currentAcademicYear)
            ->paginate(10);
            
        // Hitung rentang tahun untuk dropdown
        $academicYears = [];
        $startYear = 2025; // Tahun pertama sistem digunakan
        $endYear = now()->year + 1; // Satu tahun ke depan
        for ($year = $startYear; $year <= $endYear; $year++) {
            $academicYears[$year] = $year . '/' . ($year + 1);
        }
            
        return view('comprehensive.index', compact('schools', 'students', 'academicYears', 'currentAcademicYear'));
    }

    public function search(Request $request)
    {
        $query = Student::with(['school', 'screening']);
        
        // Filter by academic year
        $academicYear = $request->input('academic_year', now()->year);
        $query->where('academic_year', $academicYear);

        // Apply search
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('school', function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter by school type
        if ($schoolType = $request->input('school_type')) {
            $query->whereHas('school', function($q) use ($schoolType) {
                $q->where('type', $schoolType);
            });
        }

        // Filter by screening status
        if ($screeningStatus = $request->input('screening_status')) {
            if ($screeningStatus == '1') {
                $query->has('screening');
            } else {
                $query->doesntHave('screening');
            }
        }

        // Apply sorting
        if ($sort = $request->input('sort')) {
            switch ($sort) {
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
                default:
                    if (strpos($sort, 'school_id_') === 0) {
                        $schoolId = substr($sort, 10);
                        $query->where('school_id', $schoolId);
                    }
            }
        }

        $students = $query->paginate(10);

        if ($request->ajax()) {
            return view('comprehensive.table', compact('students'))->render();
        }

        $schools = School::all();
        return view('comprehensive.index', compact('schools', 'students'));
    }

    public function exportExcel(Request $request)
    {
        $academicYear = $request->input('academic_year', now()->year);
        $search = $request->input('search');
        $schoolType = $request->input('school_type');
        $screeningStatus = $request->input('screening_status');
        $sort = $request->input('sort');

        $filename = 'data-skrining-tahun-' . $academicYear . '.xlsx';

        return Excel::download(
            new ComprehensiveDataExport($academicYear, $search, $schoolType, $screeningStatus, $sort),
            $filename
        );
    }
}
