<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityName extends Model
{
    use SoftDeletes;

    // Definir los campos que serán gestionados (rellenables)
    protected $fillable = ['field1', 'field2', 'image']; // Reemplaza 'field1' y 'field2' por los campos reales

    // Si necesitas definir un nombre de tabla diferente, puedes hacerlo:
    protected $table = 'entity_names';
}
