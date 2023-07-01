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
        Schema::create('attendance_detail_data', function (Blueprint $table) {
            $table->id();
            $table->string('wifi_ssid')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('battery_percentage')->nullable();
            $table->unsignedBigInteger('attendance_id');
            $table->foreign('attendance_id')
                ->references('id')
                ->on('attendance')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_detail_data');
    }
};
