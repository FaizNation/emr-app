<?php

namespace App\Http\Controllers;

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
        $screenings = Screening::with(['student.school'])->paginate(15);
        return view('screenings.index', compact('screenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::with('school')->get();
        return view('screenings.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'lpimt' => 'required|numeric',
            'nutrition_status' => 'required|string|max:255',
            'blood_pressure' => 'required|string|max:255',
            'vision_right' => 'required|string|max:255',
            'vision_left' => 'required|string|max:255',
            'hearing' => 'required|string|max:255',
            'dental' => 'required|string|max:255',
            'anemia' => 'required|string|max:255',
            'disability' => 'required|string|max:255',
            'fitness' => 'required|string|max:255',
            'referral' => 'nullable|string',
        ]);

        Screening::create($validated);

        return redirect()->route('screenings.index')
            ->with('success', 'Data skrining berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Screening $screening)
    {
        $screening->load('student.school');
        return view('screenings.show', compact('screening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Screening $screening)
    {
        $students = Student::with('school')->get();
        return view('screenings.edit', compact('screening', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Screening $screening)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'lpimt' => 'required|numeric',
            'nutrition_status' => 'required|string|max:255',
            'blood_pressure' => 'required|string|max:255',
            'vision_right' => 'required|string|max:255',
            'vision_left' => 'required|string|max:255',
            'hearing' => 'required|string|max:255',
            'dental' => 'required|string|max:255',
            'anemia' => 'required|string|max:255',
            'disability' => 'required|string|max:255',
            'fitness' => 'required|string|max:255',
            'referral' => 'nullable|string',
        ]);

        $screening->update($validated);

        return redirect()->route('screenings.index')
            ->with('success', 'Data skrining berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Screening $screening)
    {
        $screening->delete();

        return redirect()->route('screenings.index')
            ->with('success', 'Data skrining berhasil dihapus.');
    }
}
