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
        Schema::table('profiles', function (Blueprint $table) {
            $table->json('experience')->nullable()->change();
            $table->json('projects')->nullable()->change();
            $table->json('education')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->text('experience')->nullable()->change();
            $table->text('projects')->nullable()->change();
            $table->text('education')->nullable()->change();
        });
    }
};
