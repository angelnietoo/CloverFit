@extends('layouts.app')

@section('content')
<div class="container mt-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Editar perfil</h1>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-2 py-1" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-2 py-1" required>
            </div>

            <div>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
                <a href="{{ route('home') }}" class="ml-2 text-sm text-gray-600">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
