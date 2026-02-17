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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(); // "Clase", "Entrenamiento Personal", "Evento"
            $table->text('description')->nullable();
            $table->dateTime('activity_date')->nullable();
            $table->string('status')->default('scheduled'); // "scheduled", "completed", "cancelled"
            $table->integer('duration_minutes')->nullable(); // Duración en minutos
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
