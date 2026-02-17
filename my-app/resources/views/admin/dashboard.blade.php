@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <!-- Recuadro de administración con fondo en tonos rojos y negros -->
    <div class="bg-gradient-to-r from-red-800 via-red-900 to-black text-white shadow-lg rounded-xl p-8">
        <h1 class="text-3xl font-extrabold mb-4 text-center tracking-wide">Gestión de Usuarios</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-md">{{ session('success') }}</div>
        @endif

        <!-- Botón para crear un nuevo usuario -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.create_user') }}" class="bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:scale-105 transition duration-300">
                Crear Usuario
            </a>
        </div>

        <!-- Tabla de usuarios -->
        <table class="min-w-full table-auto bg-neutral-900 rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-red-700 text-white">
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Correo Electrónico</th>
                    <th class="px-4 py-2">Rol</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-white">
                @foreach($users as $user)
                    <tr class="border-b border-white/20">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->role }}</td>
                        <td class="px-4 py-2">
                            <!-- Botón de editar -->
                            <a href="{{ route('admin.edit_user', $user->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white py-1 px-3 rounded-lg shadow-md hover:scale-105 transition duration-300">
                                Editar
                            </a>
                            <!-- Botón de eliminar -->
                            <form action="{{ route('admin.destroy_user', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-lg shadow-md hover:scale-105 transition duration-300" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
