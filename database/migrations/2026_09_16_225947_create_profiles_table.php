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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->text('full_name')->nullable();
            $table->text('title')->nullable();
            $table->text('location')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->text('secondary_url')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('experience_text')->nullable();
            $table->longText('projects_text')->nullable();
            $table->json('skills')->nullable();
            $table->text('education_text')->nullable();
            $table->text('soft_skills')->nullable();
            $table->text('languages')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
