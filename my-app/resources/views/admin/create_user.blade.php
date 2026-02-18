@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-gradient-to-r from-red-600 via-red-500 to-red-400 text-white shadow-lg rounded-xl p-8">
        <h1 class="text-3xl font-extrabold mb-4 text-center">Crear Usuario</h1>

        <form action="{{ route('admin.store_user') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-black">Nombre</label> <!-- Cambié text-white a text-black -->
                <input type="text" name="name" id="name" class="w-full p-2 mt-2 border border-gray-300 rounded text-black" required> <!-- Cambié text-white a text-black -->
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-black">Correo Electrónico</label> <!-- Cambié text-white a text-black -->
                <input type="email" name="email" id="email" class="w-full p-2 mt-2 border border-gray-300 rounded text-black" required> <!-- Cambié text-white a text-black -->
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-black">Contraseña</label> <!-- Cambié text-white a text-black -->
                <input type="password" name="password" id="password" class="w-full p-2 mt-2 border border-gray-300 rounded text-black" required> <!-- Cambié text-white a text-black -->
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-semibold text-black">Rol</label> <!-- Cambié text-white a text-black -->
                <select name="role" id="role" class="w-full p-2 mt-2 border border-gray-300 rounded text-black" required> <!-- Cambié text-white a text-black -->
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Crear Usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection