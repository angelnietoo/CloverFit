@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="max-w-3xl mx-auto bg-green-100 text-green-800 shadow-xl rounded-xl p-10">
        <h1 class="text-3xl font-extrabold mb-6 text-center">¡Pago realizado correctamente!</h1>

        <p class="text-lg text-center">Gracias por tu pago. Tu suscripción está activa y podrás disfrutar de todos los beneficios de CloverFit.</p>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-500 transition duration-300">Ir al inicio</a>
        </div>
    </div>
</div>

@endsection
