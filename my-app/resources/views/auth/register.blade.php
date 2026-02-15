@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="bg-gray-900/70 backdrop-blur border border-gray-800 rounded-2xl shadow-2xl p-6 sm:p-8">
            <div class="mb-6">
                <h1 class="text-2xl font-extrabold text-white">{{ __('Register') }}</h1>
                <p class="mt-1 text-sm text-gray-300">Crea tu cuenta y empieza en CloverFit.</p>
            </div>

            {{-- Mensaje general de error --}}
            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                    Revisa los campos: hay datos incorrectos.
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-200">
                        {{ __('Name') }}
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autocomplete="name"
                        autofocus
                        placeholder="Tu nombre"
                        class="mt-1 w-full rounded-lg bg-gray-950 border border-gray-800 px-3 py-2 text-white placeholder-gray-500
                               focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400
                               @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-200">
                        {{ __('Email Address') }}
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="tucorreo@email.com"
                        class="mt-1 w-full rounded-lg bg-gray-950 border border-gray-800 px-3 py-2 text-white placeholder-gray-500
                               focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400
                               @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-200">
                        {{ __('Password') }}
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="mt-1 w-full rounded-lg bg-gray-950 border border-gray-800 px-3 py-2 text-white placeholder-gray-500
                               focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400
                               @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-gray-200">
                        {{ __('Confirm Password') }}
                    </label>
                    <input
                        id="password-confirm"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="mt-1 w-full rounded-lg bg-gray-950 border border-gray-800 px-3 py-2 text-white placeholder-gray-500
                               focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full mt-2 inline-flex items-center justify-center rounded-lg bg-yellow-500 px-4 py-2.5
                           font-semibold text-black hover:bg-yellow-400 transition shadow-lg shadow-yellow-500/10"
                >
                    {{ __('Register') }}
                </button>

                <p class="text-center text-sm text-gray-300">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold">
                        Inicia sesión
                    </a>
                </p>
            </form>
        </div>

        <p class="mt-4 text-center text-xs text-gray-500">
            © {{ date('Y') }} CloverFit
        </p>
    </div>
</div>
@endsection
