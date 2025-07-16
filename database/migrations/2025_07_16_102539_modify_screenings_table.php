<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('screenings', function (Blueprint $table) {
            // Drop columns
            $table->dropColumn(['lpimt', 'anemia']);
            
            // Add and modify columns
            $table->decimal('weight', 8, 2)->change();
            $table->decimal('height', 8, 2)->change();
            $table->decimal('waist_circumference', 8, 2)->after('height');
            $table->decimal('bmi', 8, 2)->after('waist_circumference');
            $table->decimal('hemoglobin', 8, 2)->after('dental');
            $table->boolean('fitness')->change();
            
            // Rename column
            $table->renameColumn('nutrition_status', 'nutritional_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('screenings', function (Blueprint $table) {
            // Restore columns
            $table->decimal('lpimt', 5, 2);
            $table->string('anemia');
            
            // Reverse modifications
            $table->dropColumn(['waist_circumference', 'bmi', 'hemoglobin']);
            $table->decimal('weight')->change();
            $table->decimal('height')->change();
            $table->string('fitness')->change();
            $table->renameColumn('nutritional_status', 'nutrition_status');
        });
    }
};
