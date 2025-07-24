<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    protected $casts = [
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'waist_circumference' => 'decimal:2',
        'bmi' => 'decimal:2',
        'hemoglobin' => 'decimal:2'
    ];

    protected $fillable = [
        'student_id',
        'school_id',
        'weight',
        'height',
        'waist_circumference',
        'bmi',
        'nutritional_status',
        'blood_pressure',
        'vision_right',
        'vision_left',
        'hearing',
        'dental',
        'hemoglobin',
        'disability',
        'fitness',
        'referral'
    ];

    /**
     * Get the student that owns the screening.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the school that owns the screening.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
