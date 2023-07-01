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
        Schema::table('leave', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('leaveType_id');
            $table->foreign('leaveType_id')
                ->references('id')
                ->on('leave_type')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave', function (Blueprint $table) {
            //
        });
    }
};
