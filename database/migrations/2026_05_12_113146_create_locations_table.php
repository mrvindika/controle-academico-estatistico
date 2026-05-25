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
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('town')->default('Cubal');
            $table->string('district')->default('Cubal');
            $table->string('quarter')->nullable();
            $table->string('street')->nullable();
            $table->decimal('distance')->nullable();
            $table->string('coordinates')->nullable();
            
            //CONSTRAINTS
            $table->string('locatable_type');
            $table->unsignedInteger('locatable_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
