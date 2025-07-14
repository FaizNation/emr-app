<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'weight',
        'height',
        'lpimt',
        'nutrition_status',
        'blood_pressure',
        'vision_right',
        'vision_left',
        'hearing',
        'dental',
        'anemia',
        'disability',
        'fitness',
        'referral'
    ];

    protected $casts = [
        'weight' => 'float',
        'height' => 'float',
        'lpimt' => 'float'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
