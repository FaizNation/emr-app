<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'birth_date',
        'birth_place',
        'gender',
        'address',
        'class',
        'school_id',
        'guardian_name',
        'guardian_nik',
        'phone'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}
