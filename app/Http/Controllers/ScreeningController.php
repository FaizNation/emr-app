<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\Screening;
use App\Exports\ScreeningsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $schools = School::withCount('students')
            ->withCount('screenings')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('type', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return view('screenings.schools', compact('schools', 'search'));
    }

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

    public function school(Request $request, School $school)
    {
        $currentAcademicYear = $request->input('academic_year', $this->getCurrentAcademicYear());
        
        // Prepare academic years for dropdown
        $academicYears = [];
        $startYear = 2025; // Tahun pertama sistem digunakan
        $endYear = now()->year + 1; // Satu tahun ke depan
        for ($year = $startYear; $year <= $endYear; $year++) {
            $academicYears[$year] = $year . '/' . ($year + 1);
        }

        $screenings = $school->screenings()
            ->with('student')
            ->whereHas('student', function($query) use ($currentAcademicYear) {
                $query->where('academic_year', $currentAcademicYear);
            })
            ->latest()
            ->paginate(10);

        return view('screenings.index', compact('school', 'screenings', 'academicYears', 'currentAcademicYear'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(School $school)
    {
        // Get students who don't have screenings yet
        $students = $school->students()
            ->whereNotExists(function($query) {
                $query->select('student_id')
                    ->from('screenings')
                    ->whereRaw('screenings.student_id = students.id');
            })
            ->orderBy('name')
            ->get();

        return view('screenings.create', compact('school', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, School $school)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'weight' => 'required|numeric|min:0|max:999.99',
            'height' => 'required|numeric|min:0|max:999.99',
            'waist_circumference' => 'required|numeric|min:0|max:999.99',
            'bmi' => 'required|numeric|min:0|max:99.99',
            'nutritional_status' => 'required|string|max:255',
            'blood_pressure' => 'required|string|max:255',
            'vision_right' => 'required|string|max:255',
            'vision_left' => 'required|string|max:255',
            'hearing' => 'required|string|max:255',
            'dental' => 'required|string|max:255',
            'hemoglobin' => 'required|numeric|min:0|max:30',
            'disability' => 'required|string|max:255',
            'fitness' => 'required|string|in:Kurang,Cukup,Baik',
            'referral' => 'nullable|string'
        ]);

        // Add school_id to the data
        $validated['school_id'] = $school->id;

        Screening::create($validated);

        return redirect()
            ->route('screenings.school', $school)
            ->with('success', 'Data skrining berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school, Screening $screening)
    {
        $screening->load('student');
        return view('screenings.show', compact('school', 'screening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school, Screening $screening)
    {
        $screening->load('student');
        return view('screenings.edit', compact('school', 'screening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school, Screening $screening)
    {
        try {
            $validated = $request->validate([
                'weight' => 'required|numeric|min:0|max:999.99',
                'height' => 'required|numeric|min:0|max:999.99',
                'bmi' => 'required|numeric|min:0|max:99.99',
                'waist_circumference' => 'required|numeric|min:0|max:999.99',
                'nutritional_status' => 'required|string|max:255',
                'blood_pressure' => 'required|string|max:255',
                'vision_right' => 'required|string|max:255',
                'vision_left' => 'required|string|max:255',
                'hearing' => 'required|string|max:255',
                'dental' => 'required|string|max:255',
                'hemoglobin' => 'required|numeric|min:0|max:30',
                'disability' => 'required|string|max:255',
                'fitness' => 'required|string|in:Kurang,Cukup,Baik',
                'referral' => 'nullable|string'
            ]);

            Log::info('Validated data:', $validated);
            $screening->update($validated);

            return redirect()
                ->route('screenings.school', $school)
                ->with('success', 'Data skrining berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Mohon periksa kembali data yang dimasukkan.');
        } catch (\Exception $e) {
            Log::error('Error updating screening: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school, Screening $screening)
    {
        $screening->delete();

        return redirect()
            ->route('screenings.school', $school)
            ->with('success', 'Data skrining berhasil dihapus.');
    }

    /**
     * Export screenings data to Excel
     */
    public function exportExcel(Request $request, School $school)
    {
        $academicYear = $request->input('academic_year', $this->getCurrentAcademicYear());
        $filename = 'skrining-' . $school->name . '-TA-' . $academicYear . '-' . ($academicYear + 1) . '.xlsx';
        return Excel::download(new ScreeningsExport($school, $academicYear), $filename);
    }

    /**
     * Export screenings data to PDF
     */
    public function exportPdf(Request $request, School $school)
    {
        $academicYear = $request->input('academic_year', $this->getCurrentAcademicYear());
        $screenings = $school->screenings()
            ->with('student')
            ->whereHas('student', function($query) use ($academicYear) {
                $query->where('academic_year', $academicYear);
            })
            ->get();
        $pdf = PDF::loadView('screenings.pdf', compact('school', 'screenings', 'academicYear'));

        $pdf->setPaper('a4', 'landscape');
        $pdf->setOptions([
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5,
        ]);
        
        return $pdf->download('screenings-' . $school->name . '.pdf');
    }
}
