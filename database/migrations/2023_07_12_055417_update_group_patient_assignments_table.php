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
        Schema::table('group_patient_assignments', function (Blueprint $table) {
            $table->dateTime('AssignmentDate', $precision = 0)->nullable()->after('doctor_id');
            $table->enum('in_out', ['In', 'Out'])->default('in')->after('AssignmentDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_patient_assignments', function (Blueprint $table) {
            //
        });
    }
};
