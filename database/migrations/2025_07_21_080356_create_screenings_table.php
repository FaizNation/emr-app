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
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('waist_circumference', 5, 2)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->string('nutritional_status')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('vision_right')->nullable();
            $table->string('vision_left')->nullable();
            $table->string('hearing')->nullable();
            $table->string('dental')->nullable();
            $table->string('hemoglobin')->nullable();
            $table->string('disability')->nullable();
            $table->boolean('fitness')->default(false);
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
