@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Clases Eliminadas</h1>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($classes->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Entrenador</th>
                        <th>Nivel</th>
                        <th>Eliminado el</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->trainer->name ?? 'N/A' }}</td>
                            <td><span class="badge bg-info">{{ $class->level }}</span></td>
                            <td>{{ $class->deleted_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('classes.restore', $class->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-undo"></i> Restaurar
                                    </button>
                                </form>
                                <form action="{{ route('classes.force-destroy', $class->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Eliminar permanentemente?')">
                                        <i class="fas fa-times"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        {{ $classes->links() }}
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No hay clases eliminadas
        </div>
    @endif
</div>
@endsection
