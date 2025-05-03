<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id('exercise_id'); 
            $table->string('name', 50);
            $table->unsignedBigInteger('equipment_type_id')->nullable();
            $table->text('instructions')->nullable();
            $table->text('image_url')->nullable();

            $table->foreign('equipment_type_id')->references('equipment_type_id')->on('equipment_types')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
