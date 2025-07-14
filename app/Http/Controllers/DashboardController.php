<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\Screening;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'elementary_schools' => School::where('type', 'SD')->count(),
            'junior_high_schools' => School::where('type', 'SMP')->count(),
            'other_schools' => School::where('type', 'OTHER')->count(),
            'total_students' => Student::count(),
            'total_screenings' => Screening::count(),
        ];

        return view('dashboard.index', compact('stats'));
    }
}
