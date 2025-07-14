<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('school')->paginate(15);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schools = School::all();
        return view('students.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|unique:students,nik',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'address' => 'required|string',
            'class' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'guardian_name' => 'required|string|max:255',
            'guardian_nik' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('school', 'screenings');
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $schools = School::all();
        return view('students.edit', compact('student', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|unique:students,nik,' . $student->id,
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'address' => 'required|string',
            'class' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'guardian_name' => 'required|string|max:255',
            'guardian_nik' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
