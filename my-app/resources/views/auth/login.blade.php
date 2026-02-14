@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Campo de correo -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo de contraseña -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Recordarme -->
            <div class="mb-4 flex items-center">
                <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-sm text-gray-700">{{ __('Remember Me') }}</label>
            </div>

            <!-- Botón de Login -->
            <div class="flex items-center justify-between">
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
