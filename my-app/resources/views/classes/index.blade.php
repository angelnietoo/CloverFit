@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Clases</h1>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Clase
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('classes.index') }}" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="level" class="form-select">
                        <option value="">Todos los niveles</option>
                        @foreach ($levels as $level)
                            <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="trainer_id" class="form-select">
                        <option value="">Todos los entrenadores</option>
                        @foreach ($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ request('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-info w-100">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de clases -->
    @if ($classes->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Entrenador</th>
                        <th>Nivel</th>
                        <th>Miembros</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->trainer->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-info">{{ $class->level }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $class->members->count() }}/{{ $class->max_members }}</span>
                            </td>
                            <td>
                                @if ($class->is_active)
                                    <span class="badge bg-success">Activa</span>
                                @else
                                    <span class="badge bg-warning">Inactiva</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('classes.show', $class) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('classes.edit', $class) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('classes.destroy', $class) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Está seguro?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-between align-items-center">
            {{ $classes->links() }}
            <a href="{{ route('classes.trashed') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-trash"></i> Ver Eliminadas
            </a>
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No hay clases disponibles
        </div>
    @endif
</div>
@endsection
