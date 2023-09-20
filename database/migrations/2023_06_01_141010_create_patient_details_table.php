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
            $table->bigInteger('contact_number')->nullable();
            $table->bigInteger('alternative_contact_number')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('complex_name')->nullable();
            $table->integer('unit_no')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('postal_code')->nullable();
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
