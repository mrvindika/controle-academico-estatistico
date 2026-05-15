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
        Schema::create('entries', function (Blueprint $table) {
            //CONSTRAINTS
            $table->foreignId('transferred_id')
                ->constrained('transferreds', 'statistic_id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->primary('transferred_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
