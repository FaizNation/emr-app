<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'nik',
        'name',
        'gender',
        'birth_date',
        'birth_place',
        'class',
        'phone',
        'address',
        'guardian_name',
        'guardian_nik',
        'academic_year'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    /**
     * Get the school that owns the student.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the screenings for the student.
     */
    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }

    /**
     * Get the latest screening for the student.
     */
    public function screening()
    {
        return $this->hasOne(Screening::class)->latestOfMany();
    }
}
