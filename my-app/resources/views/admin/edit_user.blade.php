@extends('layouts.app')

@section('content')

  <!-- Título de la página -->
  <div class="container mx-auto mt-8">
    <div class="bg-neutral-900/60 p-8 rounded-xl border border-white/10 shadow-lg">
      <h1 class="text-3xl font-extrabold mb-4 text-center text-white">Editar Usuario</h1>

      <!-- Formulario para editar usuario -->
      <form action="{{ route('admin.update_user', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo de Nombre -->
        <div class="mb-4">
          <label for="name" class="block text-sm font-semibold text-black">Nombre</label>
          <input type="text" name="name" id="name" class="w-full p-2 mt-2 border border-gray-300 rounded text-black" value="{{ old('name', $user->name) }}" required>
          @error('name')
            <span class="text-red-500 text-xs">{{ $message }}</span>
          @enderror
        </div>

        <!-- Campo de Correo Electrónico -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-semibold text-black">Correo Electrónico</label>
          <input type="email" name="email" id="email" class="w-full p-2 mt-2 border border-gray-300 rounded text-black" value="{{ old('email', $user->email) }}" required>
          @error('email')
            <span class="text-red-500 text-xs">{{ $message }}</span>
          @enderror
        </div>

        <!-- Campo de Contraseña (opcional) -->
        <div class="mb-4">
          <label for="password" class="block text-sm font-semibold text-black">Contraseña</label>
          <input type="password" name="password" id="password" class="w-full p-2 mt-2 border border-gray-300 rounded text-black">
          <small class="text-gray-400">Deja vacío si no deseas cambiar la contraseña</small>
          @error('password')
            <span class="text-red-500 text-xs">{{ $message }}</span>
          @enderror
        </div>

        <!-- Campo de Rol -->
        <div class="mb-4">
          <label for="role" class="block text-sm font-semibold text-black">Rol</label>
          <select name="role" id="role" class="w-full p-2 mt-2 border border-gray-300 rounded text-black" required>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuario</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
          </select>
          @error('role')
            <span class="text-red-500 text-xs">{{ $message }}</span>
          @enderror
        </div>

        <!-- Botón de Submit -->
        <div class="mb-4">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Actualizar Usuario</button>
        </div>
      </form>
    </div>
  </div>

@endsection
