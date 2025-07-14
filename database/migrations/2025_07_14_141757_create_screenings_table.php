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
            $table->float('weight')->comment('BB - Berat Badan');
            $table->float('height')->comment('TB - Tinggi Badan');
            $table->float('lpimt')->comment('LPIMT');
            $table->string('nutrition_status')->comment('Status Gizi');
            $table->string('blood_pressure')->comment('Tekanan Darah');
            $table->string('vision_right')->comment('Penglihatan Mata Kanan');
            $table->string('vision_left')->comment('Penglihatan Mata Kiri');
            $table->string('hearing')->comment('Pendengaran');
            $table->string('dental')->comment('Skrining Gigi');
            $table->string('anemia')->comment('Skrining Anemia');
            $table->string('disability')->comment('Kecacatan');
            $table->string('fitness')->comment('Kebugaran');
            $table->text('referral')->nullable()->comment('Rujuk');
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
