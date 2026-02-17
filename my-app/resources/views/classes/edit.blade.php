@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <h1>Editar Clase</h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('classes.update', $class) }}" method="POST" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la Clase *</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                       required value="{{ old('name', $class->name) }}">
                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción *</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" 
                          rows="4" required>{{ old('description', $class->description) }}</textarea>
                @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="trainer_id" class="form-label">Entrenador *</label>
                    <select id="trainer_id" name="trainer_id" class="form-select @error('trainer_id') is-invalid @enderror" required>
                        @foreach ($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ old('trainer_id', $class->trainer_id) == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->name }} ({{ $trainer->specialization }})
                            </option>
                        @endforeach
                    </select>
                    @error('trainer_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="level" class="form-label">Nivel *</label>
                    <select id="level" name="level" class="form-select @error('level') is-invalid @enderror" required>
                        @foreach ($levels as $level)
                            <option value="{{ $level }}" {{ old('level', $class->level) == $level ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                    @error('level') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="max_members" class="form-label">Máximo de Miembros *</label>
                <input type="number" id="max_members" name="max_members" class="form-control @error('max_members') is-invalid @enderror" 
                       min="1" max="100" required value="{{ old('max_members', $class->max_members) }}">
                @error('max_members') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            @if ($class->image)
                <div class="mb-3">
                    <label>Imagen Actual</label>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $class->image) }}" alt="{{ $class->name }}" style="max-width: 200px;">
                    </div>
                </div>
            @endif

            <div class="mb-3">
                <label for="image" class="form-label">Cambiar Imagen</label>
                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" 
                       accept="image/*">
                <small class="form-text text-muted">Máximo 2MB. Formatos: JPEG, PNG, JPG, GIF</small>
                @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input" 
                           value="1" {{ old('is_active', $class->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Clase Activa</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar Clase
            </button>
            <a href="{{ route('classes.show', $class) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
