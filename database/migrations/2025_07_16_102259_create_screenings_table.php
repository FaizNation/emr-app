<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
           
            // PERTUMBUHAN
            $table->decimal('weight', 8, 2); // BB
            $table->decimal('height', 8, 2); // TB
            $table->decimal('waist_circumference', 8, 2); // Lingkar Perut
            $table->decimal('bmi', 8, 2); // IMT
            $table->string('nutritional_status'); // Status Gizi
            $table->string('blood_pressure'); // Tekanan Darah
           
            // SKRINING INDERA
            $table->string('vision_right');
            $table->string('vision_left');
            $table->string('hearing');
            $table->string('dental');
            $table->decimal('hemoglobin', 8, 2);
            $table->string('disability');
            $table->boolean('fitness');
            $table->string('referral');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};
