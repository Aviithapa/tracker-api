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
        Schema::table('leave_type', function (Blueprint $table) {
            //
            $table->softDeletes();
            $table->integer('alloted_days');
            $table->integer('max_carryover')->nullable();
            $table->integer('useUntil')->nullable();
            $table->integer('encashmentLimit')->nullable();
            $table->enum('carryovertype', ['CARRYOVER', 'ENCASH'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_type', function (Blueprint $table) {
            //
        });
    }
};
