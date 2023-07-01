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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->string('in_comment')->nullable();
            $table->string('out_comment')->nullable();
            $table->enum('working_from', ['HOME', "FIELD", 'OFFICE'])->default('OFFICE');
            $table->unsignedBigInteger('employee_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('employee_id')
                ->references('id')
                ->on('employee')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
