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
        Schema::create('fiscal_year', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_year_english')->unique();
            $table->date('end_year_english')->unique();
            $table->date('start_year_nepali')->unique();
            $table->date('end_year_nepali')->unique();
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->unique('status', 'unique_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscal_year');
    }
};
