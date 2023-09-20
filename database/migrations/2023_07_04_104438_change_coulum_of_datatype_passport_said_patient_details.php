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
        Schema::table('patient_details', function (Blueprint $table) {
            Schema::table('patient_details', function (Blueprint $table) {
                $table->dropColumn('passport_SAID');
            });
            Schema::table('patient_details', function (Blueprint $table) {
                $table->enum('passport_SAID', ['passport', 'SA_ID'])->after('language');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_details', function (Blueprint $table) {
            //
        });
    }
};
