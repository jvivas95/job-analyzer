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
        // Create the job_offers table
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->text('description');
            $table->string('url')->nullable();
            $table->tinyInteger('fit_score')->nullable();
            $table->json('analysis_result')->nullable();
            $table->json('adapted_cv_data')->nullable();
            $table->longText('cover_letter')->nullable();
            $table->string('cv_pdf_path')->nullable();
            $table->string('cover_letter_pdf_path')->nullable();
            $table->enum('status', ['pending', 'processing', 'processed', 'failed', 'discarded'])->index()->default('pending');
            $table->text('failure_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the job_offers table if it exists
        Schema::dropIfExists('job_offers');
    }
};
