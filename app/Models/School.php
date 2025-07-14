<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get the screenings for the school.
     */
    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}
