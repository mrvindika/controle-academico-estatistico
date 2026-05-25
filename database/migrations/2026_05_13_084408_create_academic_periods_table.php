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
        Schema::create('academic_periods', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['I trimestre', 'II trimestre', 'III trimestre']);
            $table->date('start_date')->nullable;
            $table->date('end_date')->nullable();
            $table->timestamps();

            //CONSTRAINTS
            $table->unsignedInteger('academic_year_id')
                ->foreign()
                ->references('id')
                ->on('academic_years')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_periods');
    }
};
