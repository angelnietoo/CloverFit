@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-gradient-to-r from-red-600 via-red-500 to-red-400 text-white shadow-lg rounded-xl p-8">
        <h1 class="text-3xl font-extrabold mb-4 text-center">Gestión de Usuarios</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-md">{{ session('success') }}</div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.create_user') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Usuario</a>
        </div>

        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Correo Electrónico</th>
                    <th class="px-4 py-2">Rol</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->role }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.edit_user', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">Editar</a>
                            <form action="{{ route('admin.destroy_user', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
