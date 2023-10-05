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
        Schema::create('patient_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->enum('passport_SAID', ['passport', 'SA_ID'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('referring_provider', 255)->nullable();
            $table->string('EZMed_number', 255)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('language')->nullable();
            $table->string('next_of_kin')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->integer('country_code', 10)->nullable();
            $table->bigInteger('contact_number')->nullable();
            $table->integer('alternative_country_code', 10)->nullable();
            $table->bigInteger('alternative_contact_number')->nullable();
            $table->integer('home_country_code', 10)->nullable();
            $table->string('home_number', 20)->nullable();
            $table->integer('work_country_code', 10)->nullable();
            $table->string('work_number', 20)->nullable();
            $table->integer('fax_country_code', 10)->nullable();
            $table->string('fax_number', 20)->nullable();
            $table->string('physical_address')->nullable();
            $table->string('complex_name')->nullable();
            $table->integer('unit_no')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('postal_code')->nullable();
            $table->enum('funder_type', ['Medical Scheme', 'Insurer', 'Private'])->nullable();
            $table->string('medical_aid_number', 100)->nullable();
            $table->string('medical_aid_plan', 100)->nullable();
            $table->string('patient_dependant_code', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_details');
    }
};
