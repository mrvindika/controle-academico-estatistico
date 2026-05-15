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
            $table->bigIncrements('id');
            $table->enum('name', ['I trimestre', 'II trimestre', 'III trimestre']);
            $table->date('start_date')->nullable;
            $table->date('end_date')->nullable();
            $table->timestamps();

            //CONSTRAINTS
            $table->foreignId('academic_year_id')
            ->constrained()
            ->onUpdate('cascade')
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
