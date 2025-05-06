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
        Schema::create('exercise_routine', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('routine_id');
            $table->unsignedBigInteger('exercise_id');
            $table->integer('weight')->nullable();
            $table->integer('sets')->nullable();
            $table->integer('reps')->nullable();
            $table->timestamps();
        
            $table->foreign('routine_id')->references('routine_id')->on('routines')->onDelete('cascade');
            $table->foreign('exercise_id')->references('exercise_id')->on('exercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_routine');
    }
};
