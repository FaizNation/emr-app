<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\Screening;
use Illuminate\Http\Request;
use App\Exports\ComprehensiveDataExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ComprehensiveDataController extends Controller
{
    public function index()
    {
        $students = Student::with(['school', 'screening'])
            ->orderBy('name')
            ->paginate(10);
            
        $schools = School::orderBy('type')
            ->orderBy('name')
            ->get();
            
        return view('comprehensive.index', compact('students', 'schools'));
    }

    public function search(Request $request)
    {
        $query = Student::with(['school', 'screening']);

        // Search by name or school
        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhereHas('school', function($sq) use ($searchTerm) {
                      $sq->where('name', 'like', $searchTerm);
                  });
            });
        }

        // Filter by school type
        if ($request->school_type) {
            $query->whereHas('school', function($q) use ($request) {
                $q->where('type', $request->school_type);
            });
        }

        // Filter by screening status
        if ($request->has('screening_status')) {
            if ($request->screening_status === '1') {
                $query->whereHas('screening');
            } elseif ($request->screening_status === '0') {
                $query->whereDoesntHave('screening');
            }
        }

        // Apply sorting
        $sort = $request->get('sort', 'name_asc');
        
        if (strpos($sort, 'school_id_') === 0) {
            // Sort by specific school
            $schoolId = substr($sort, 10); // Remove 'school_id_' prefix
            $query->where('school_id', $schoolId)
                  ->orderBy('name', 'asc');
        } else {
            switch ($sort) {
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'school_asc':
                    $query->join('schools', 'students.school_id', '=', 'schools.id')
                          ->orderBy('schools.type', 'asc')
                          ->orderBy('schools.name', 'asc')
                          ->orderBy('students.name', 'asc')
                          ->select('students.*');
                    break;
                case 'school_desc':
                    $query->join('schools', 'students.school_id', '=', 'schools.id')
                          ->orderBy('schools.type', 'desc')
                          ->orderBy('schools.name', 'desc')
                          ->orderBy('students.name', 'asc')
                          ->select('students.*');
                    break;
                default: // name_asc
                    $query->orderBy('name', 'asc');
                    break;
            }
        }

        $students = $query->paginate(10);
        
        if ($request->ajax()) {
            return view('comprehensive.table', compact('students'))->render();
        }

        return view('comprehensive.index', compact('students'));
    }

    public function exportExcel()
    {
        return Excel::download(new ComprehensiveDataExport, 'data-siswa-lengkap.xlsx');
    }

}
