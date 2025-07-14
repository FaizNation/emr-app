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
            $table->decimal('weight', 5, 2); // in kg
            $table->decimal('height', 5, 2); // in cm
            $table->decimal('lpimt', 5, 2); // calculated from weight and height
            $table->string('nutrition_status');
            $table->string('blood_pressure');
            $table->string('vision_right');
            $table->string('vision_left');
            $table->string('hearing');
            $table->string('dental');
            $table->string('anemia');
            $table->string('disability');
            $table->string('fitness');
            $table->text('referral')->nullable();
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
