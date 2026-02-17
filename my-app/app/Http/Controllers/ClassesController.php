<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource with pagination and filtering.
     */
    public function index(Request $request)
    {
        $query = Classes::with('trainer');

        // Filtro por nivel
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filtro por entrenador
        if ($request->filled('trainer_id')) {
            $query->where('trainer_id', $request->trainer_id);
        }

        // Filtro por nombre
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtro por estado
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $classes = $query->paginate(10);
        $trainers = Trainer::where('is_active', true)->get();
        $levels = ['Principiante', 'Intermedio', 'Avanzado'];

        return view('classes.index', compact('classes', 'trainers', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = Trainer::where('is_active', true)->get();
        $levels = ['Principiante', 'Intermedio', 'Avanzado'];

        return view('classes.create', compact('trainers', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'trainer_id' => 'required|exists:trainers,id',
            'level' => 'required|in:Principiante,Intermedio,Avanzado',
            'max_members' => 'required|integer|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // Procesar imagen
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('classes', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        Classes::create($validated);

        return redirect()->route('classes.index')->with('success', 'Clase creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $class)
    {
        $class->load('trainer', 'schedules', 'members', 'reviews');

        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $class)
    {
        $trainers = Trainer::where('is_active', true)->get();
        $levels = ['Principiante', 'Intermedio', 'Avanzado'];

        return view('classes.edit', compact('class', 'trainers', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classes $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'trainer_id' => 'required|exists:trainers,id',
            'level' => 'required|in:Principiante,Intermedio,Avanzado',
            'max_members' => 'required|integer|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // Procesar nueva imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($class->image && Storage::disk('public')->exists($class->image)) {
                Storage::disk('public')->delete($class->image);
            }

            $path = $request->file('image')->store('classes', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $class->update($validated);

        return redirect()->route('classes.show', $class)->with('success', 'Clase actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(Classes $class)
    {
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Clase eliminada exitosamente.');
    }

    /**
     * Restore a soft deleted resource.
     */
    public function restore($id)
    {
        $class = Classes::withTrashed()->findOrFail($id);
        $class->restore();

        return redirect()->route('classes.index')->with('success', 'Clase restaurada exitosamente.');
    }

    /**
     * Permanently delete a resource.
     */
    public function forceDestroy($id)
    {
        $class = Classes::withTrashed()->findOrFail($id);

        // Eliminar imagen
        if ($class->image && Storage::disk('public')->exists($class->image)) {
            Storage::disk('public')->delete($class->image);
        }

        $class->forceDelete();

        return redirect()->route('classes.index')->with('success', 'Clase eliminada permanentemente.');
    }

    /**
     * Show soft deleted classes.
     */
    public function trashed()
    {
        $classes = Classes::onlyTrashed()->paginate(10);

        return view('classes.trashed', compact('classes'));
    }
}
