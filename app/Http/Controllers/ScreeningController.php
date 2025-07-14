<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\Screening;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::withCount('students')
            ->withCount('screenings')
            ->orderBy('name')
            ->get();
        return view('screenings.schools', compact('schools'));
    }

    public function school(School $school)
    {
        $screenings = $school->screenings()
            ->with('student')
            ->latest()
            ->paginate(10);

        return view('screenings.index', compact('school', 'screenings'));
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
            'lpimt' => 'required|numeric|min:0|max:999.99',
            'nutrition_status' => 'required|string',
            'blood_pressure' => 'required|string',
            'vision_right' => 'required|string',
            'vision_left' => 'required|string',
            'hearing' => 'required|string',
            'dental' => 'required|string',
            'anemia' => 'required|string',
            'disability' => 'required|string',
            'fitness' => 'required|string',
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
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0|max:999.99',
            'height' => 'required|numeric|min:0|max:999.99',
            'lpimt' => 'required|numeric|min:0|max:999.99',
            'nutrition_status' => 'required|string',
            'blood_pressure' => 'required|string',
            'vision_right' => 'required|string',
            'vision_left' => 'required|string',
            'hearing' => 'required|string',
            'dental' => 'required|string',
            'anemia' => 'required|string',
            'disability' => 'required|string',
            'fitness' => 'required|string',
            'referral' => 'nullable|string'
        ]);

        $screening->update($validated);

        return redirect()
            ->route('screenings.school', $school)
            ->with('success', 'Data skrining berhasil diperbarui.');
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
}
