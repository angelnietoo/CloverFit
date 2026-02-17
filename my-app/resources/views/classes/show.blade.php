@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $class->name }}</h1>
        <div>
            <a href="{{ route('classes.edit', $class) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <form action="{{ route('classes.destroy', $class) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro?')">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </form>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            @if ($class->image)
                <img src="{{ asset('storage/' . $class->image) }}" alt="{{ $class->name }}" class="img-fluid rounded">
            @else
                <div class="bg-light rounded p-5 text-center">
                    <i class="fas fa-image fa-3x text-muted"></i>
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información General</h5>
                    <hr>

                    <p><strong>Descripción:</strong> {{ $class->description }}</p>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Entrenador:</strong> {{ $class->trainer->name ?? 'N/A' }}</p>
                            <p><strong>Nivel:</strong> <span class="badge bg-info">{{ $class->level }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Máximo de Miembros:</strong> {{ $class->max_members }}</p>
                            <p><strong>Miembros Inscritos:</strong> 
                                <span class="badge bg-secondary">{{ $class->members->count() }}/{{ $class->max_members }}</span>
                            </p>
                        </div>
                    </div>

                    <p><strong>Estado:</strong> 
                        @if ($class->is_active)
                            <span class="badge bg-success">Activa</span>
                        @else
                            <span class="badge bg-warning">Inactiva</span>
                        @endif
                    </p>

                    <p class="text-muted mb-0">
                        <small>Creado: {{ $class->created_at->format('d/m/Y H:i') }}</small><br>
                        <small>Actualizado: {{ $class->updated_at->format('d/m/Y H:i') }}</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Horarios -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Horarios</h5>
                </div>
                <div class="card-body">
                    @if ($class->schedules->count() > 0)
                        <div class="list-group">
                            @foreach ($class->schedules as $schedule)
                                <div class="list-group-item">
                                    <strong>{{ $schedule->day_of_week }}</strong><br>
                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}<br>
                                    <small class="text-muted">{{ $schedule->location }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No hay horarios disponibles</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Miembros -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Miembros Inscritos ({{ $class->members->count() }})</h5>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    @if ($class->members->count() > 0)
                        <div class="list-group">
                            @foreach ($class->members as $member)
                                <div class="list-group-item">
                                    <strong>{{ $member->name }}</strong><br>
                                    <small class="text-muted">{{ $member->email }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No hay miembros inscritos</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reseñas -->
    @if ($class->reviews->count() > 0)
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Reseñas ({{ $class->reviews->count() }})</h5>
            </div>
            <div class="card-body">
                @foreach ($class->reviews as $review)
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $review->member->name }}</strong>
                            <span class="text-warning">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </span>
                        </div>
                        @if ($review->comment)
                            <p class="mt-2 mb-0">{{ $review->comment }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
