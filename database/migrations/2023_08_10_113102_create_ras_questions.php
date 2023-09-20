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
        Schema::create('ras_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->unsignedBigInteger('subscale')->nullable();
            $table->foreign('subscale')->references('id')->on('ras_question_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ras_questions');
    }
};
