@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="max-w-4xl mx-auto bg-gradient-to-r from-red-600 via-red-500 to-red-400 text-white shadow-xl rounded-3xl p-10">
        <h1 class="text-4xl font-extrabold mb-6 text-center tracking-wide">Bienvenido, {{ $user->name }}</h1>

        @if(session('success'))
            <div class="mb-6 p-5 bg-green-100 text-green-800 rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-5 bg-red-100 text-red-800 rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Perfil Section -->
            <div class="bg-white p-8 rounded-2xl shadow-2xl hover:shadow-xl transition-all duration-300">
                <h2 class="text-2xl font-semibold mb-4 text-red-500 tracking-wide">Perfil</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-2 border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-400" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-2 border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-400" required>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full px-6 py-3 bg-red-600 text-white font-semibold rounded-md hover:bg-red-500 transform hover:scale-105 transition duration-300">
                            Guardar perfil
                        </button>
                    </div>
                </form>
                <div class="mt-6 text-sm text-gray-600">
                    <div><strong>Verificado:</strong> {{ $user->email_verified_at ? 'Sí' : 'No' }}</div>
                    <div><strong>Creado:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <!-- Suscripciones Section -->
            <div class="bg-white p-8 rounded-2xl shadow-2xl hover:shadow-xl transition-all duration-300">
                <h2 class="text-2xl font-semibold mb-4 text-red-500 tracking-wide">Suscripciones</h2>
                <div class="bg-gray-50 p-8 rounded-2xl shadow-md transform hover:scale-105 transition duration-300">
                    <p class="mb-6">Estado: <strong class="text-red-600">No hay suscripción activa</strong></p>
                    <p class="mb-6 text-sm text-gray-600">Puedes seleccionar una suscripción y gestionarla desde la página de suscripciones.</p>
                    <a href="{{ route('suscripcion.seleccionar') }}" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-500 transform hover:scale-105 transition duration-300">
                        Gestionar suscripción
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
