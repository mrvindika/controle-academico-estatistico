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
        Schema::create('filled_rooms', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('built')->default(0);
            $table->tinyInteger('outdoor')->default(0);
        
            //CONSTRAINTS
            $table->foreignId('academic_period_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filled_rooms');
    }
};
