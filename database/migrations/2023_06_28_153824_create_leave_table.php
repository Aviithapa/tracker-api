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
        Schema::create('leave', function (Blueprint $table) {
            $table->id();
            $table->string('reason')->nullable();
            $table->string('reject_reason')->nullable();
            $table->date('requested_on')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('shift')->nullable();
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
        Schema::dropIfExists('leave');
    }
};
