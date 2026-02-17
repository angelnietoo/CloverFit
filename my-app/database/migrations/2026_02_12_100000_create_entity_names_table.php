<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('entity_names', function (Blueprint $table) {
        $table->id();
        $table->string('field1'); // Ejemplo de campo
        $table->string('field2'); // Otro campo de ejemplo
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('entity_names');
}

};
