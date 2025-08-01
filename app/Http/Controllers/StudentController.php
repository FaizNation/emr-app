<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Exports\StudentsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $schools = School::withCount('students')
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();
            
        return view('students.schools', compact('schools', 'search'));
    }

    /**
     * Display the students of a specific school.
     */
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

    public function schoolStudents(Request $request, School $school)
    {
        $search = $request->input('search');
        $currentAcademicYear = $request->input('academic_year', $this->getCurrentAcademicYear());
        
        // Prepare academic years for dropdown
        $academicYears = [];
        $startYear = 2025; // Tahun pertama sistem digunakan
        $endYear = now()->year + 1; // Satu tahun ke depan
        for ($year = $startYear; $year <= $endYear; $year++) {
            $academicYears[$year] = $year . '/' . ($year + 1);
        }
        
        $students = $school->students()
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('nik', 'like', '%' . $search . '%')
                      ->orWhere('class', 'like', '%' . $search . '%')
                      ->orWhere('guardian_name', 'like', '%' . $search . '%')
                      ->orWhere('guardian_nik', 'like', '%' . $search . '%');
                });
            })
            ->where('academic_year', $currentAcademicYear)
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();
            
    return view('students.index', compact('school', 'students', 'academicYears', 'currentAcademicYear')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(School $school)
    {
        return view('students.create', compact('school'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, School $school)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'nik' => 'required|string|unique:students,nik',
                'birth_place' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'gender' => 'required|in:L,P',
                'address' => 'required|string',
                'class' => 'required|string|max:255',
                'guardian_name' => 'required|string|max:255',
                'guardian_nik' => 'required|string',
                'phone' => 'required|string|max:255',
            ]);

            $validated['school_id'] = $school->id;
            Student::create($validated);

            return redirect()->route('students.school', $school)
                ->with('success', 'Data siswa berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Mohon periksa kembali data yang dimasukkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school, Student $student)
    {
        return view('students.show', compact('school', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school, Student $student)
    {
        return view('students.edit', compact('school', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school, Student $student)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'nik' => 'required|string|unique:students,nik,' . $student->id,
                'birth_place' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'gender' => 'required|in:L,P',
                'address' => 'required|string',
                'class' => 'required|string|max:255',
                'guardian_name' => 'required|string|max:255',
                'guardian_nik' => 'required|string',
                'phone' => 'required|string|max:255',
            ]);

            Log::info('Attempting to update student:', ['student_id' => $student->id, 'data' => $validated]);
            $student->update($validated);
            Log::info('Student updated successfully:', ['student_id' => $student->id]);

            return redirect()->route('students.school', $school)
                ->with('success', 'Data siswa berhasil diperbarui.');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error when updating student:', [
                'student_id' => $student->id,
                'errors' => $e->errors()
            ]);
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Mohon periksa kembali data yang dimasukkan.');
        } catch (\Exception $e) {
            Log::error('Error updating student:', [
                'student_id' => $student->id,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school, Student $student)
    {
        $student->delete();

        return redirect()->route('students.school', $school)
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * Export students data to Excel
     */
    public function exportExcel(Request $request, School $school)
    {
        $academicYear = $request->input('academic_year', $this->getCurrentAcademicYear());
        $filename = 'siswa-' . $school->name . '-TA-' . $academicYear . '-' . ($academicYear + 1) . '.xlsx';
        return Excel::download(new StudentsExport($school, $academicYear), $filename);
    }

    /**
     * Export students data to PDF
     */
    public function exportPdf(Request $request, School $school)
    {
        $academicYear = $request->input('academic_year', $this->getCurrentAcademicYear());
        $students = $school->students()
            ->where('academic_year', $academicYear)
            ->orderBy('class')
            ->orderBy('name')
            ->get();
        $pdf = PDF::loadView('students.pdf', compact('school', 'students', 'academicYear'));
        
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOptions([
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5,
        ]);
        
        return $pdf->download('students-' . $school->name . '.pdf');
    }
}
