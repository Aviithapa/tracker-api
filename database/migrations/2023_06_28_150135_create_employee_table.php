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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->default('MALE');
            $table->boolean('marital_status')->default(false);
            $table->date('joined_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->string('citizenship_number')->nullable();
            $table->string('profile_picture')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
