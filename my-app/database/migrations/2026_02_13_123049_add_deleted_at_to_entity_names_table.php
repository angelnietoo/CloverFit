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
        // Agregar la columna deleted_at para SoftDeletes
        Schema::table('entity_names', function (Blueprint $table) {
            $table->softDeletes();  // Esto agregará la columna 'deleted_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la columna deleted_at en caso de revertir la migración
        Schema::table('entity_names', function (Blueprint $table) {
            $table->dropSoftDeletes();  // Elimina la columna 'deleted_at'
        });
    }
};
