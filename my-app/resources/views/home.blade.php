@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="max-w-3xl mx-auto bg-gradient-to-r from-red-600 via-red-500 to-red-400 text-white shadow-lg rounded-xl p-8">
        <div class="text-center">
            <h1 class="text-3xl font-extrabold mb-6">¡Bienvenido al Dashboard!</h1>
            
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-xl shadow-xl">
                <p class="text-lg font-semibold text-gray-800">¡Has iniciado sesión con éxito!</p>
                <p class="mt-4 text-sm text-gray-600">Desde aquí puedes gestionar tu perfil, suscripciones y mucho más.</p>
            </div>
        </div>
    </div>
</div>

@endsection
