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
        Schema::create('doctor_referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('referring_doctor_id')->nullable();
            $table->foreign('referring_doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('referrer_by')->nullable();
            $table->foreign('referrer_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('referral_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor__referrals');
    }
};
