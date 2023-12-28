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
            $table->unsignedBigInteger('fiscal_year_id')->nullable();
            $table->foreign('fiscal_year_id')
                ->references('id')
                ->on('fiscal_year')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_type', function (Blueprint $table) {
            $table->dropForeign(['fiscal_year_id']);
            $table->dropColumn('fiscal_year_id');
        });
    }
};
