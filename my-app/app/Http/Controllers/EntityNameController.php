<?php

namespace App\Http\Controllers;

use App\Models\EntityName;
use Illuminate\Http\Request;

class EntityNameController extends Controller
{
    // Mostrar todas las entidades, excluyendo las eliminadas
    public function index() {
        // Obtener todas las entidades no eliminadas
        $entities = EntityName::all(); // O puedes usar ->whereNull('deleted_at') si prefieres
        return view('entities.index', compact('entities')); // Pasa las entidades a la vista
    }

    // Almacenar una nueva entidad
    public function store(Request $request) {
        // Validar y crear la entidad
        $request->validate([
            'field1' => 'required',
            'field2' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validar imagen
        ]);

        try {
            // Guardar la imagen
            $path = $request->file('image')->store('images', 'public'); // Guarda la imagen en la carpeta 'images'

            // Crear la entidad con los datos del formulario
            $entity = new EntityName();
            $entity->field1 = $request->field1;
            $entity->field2 = $request->field2;
            $entity->image = $path; // Guarda la ruta de la imagen
            $entity->save(); // Guarda la entidad en la base de datos

            return redirect()->route('entities.index')->with('success', 'Entidad creada con éxito.');
        } catch (\Exception $e) {
            // En caso de error, muestra un mensaje
            return back()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
        }
    }

    // Eliminar una entidad (SoftDelete)
    public function destroy($id) {
        $entity = EntityName::findOrFail($id); // Encuentra la entidad por ID
        $entity->delete(); // Realiza el SoftDelete
        return redirect()->route('entities.index')->with('success', 'Entidad eliminada.');
    }

    // Restaurar una entidad eliminada
    public function restore($id) {
        $entity = EntityName::withTrashed()->findOrFail($id); // Encuentra la entidad eliminada
        $entity->restore(); // Restaura la entidad eliminada

        return redirect()->route('entities.index')->with('success', 'Entidad restaurada con éxito.');
    }

    // Mostrar solo las entidades eliminadas (SoftDeletes)
    public function trashed() {
        $deletedEntities = EntityName::onlyTrashed()->get(); // Obtiene solo las entidades eliminadas
        return view('entities.trashed', compact('deletedEntities')); // Muestra las entidades eliminadas
    }
}
