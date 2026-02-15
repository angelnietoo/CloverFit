@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="bg-neutral-900/70 backdrop-blur border border-white/10 rounded-2xl shadow-2xl p-6 sm:p-8">
            <div class="mb-6">
                <h1 class="text-2xl font-extrabold text-white">{{ __('Login') }}</h1>
                <p class="mt-1 text-sm text-neutral-300">Accede a tu cuenta para entrar al panel.</p>
            </div>

            {{-- Mensaje general de error (si falla login) --}}
            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                    Revisa los campos: hay datos incorrectos.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-200">
                        {{ __('Email Address') }}
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="tucorreo@email.com"
                        class="mt-1 w-full rounded-lg bg-neutral-950 border border-white/10 px-3 py-2 text-white placeholder-neutral-500
                               focus:outline-none focus:ring-2 focus:ring-red-500/70 focus:border-red-500/60
                               @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-200">
                        {{ __('Password') }}
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="mt-1 w-full rounded-lg bg-neutral-950 border border-white/10 px-3 py-2 text-white placeholder-neutral-500
                               focus:outline-none focus:ring-2 focus:ring-red-500/70 focus:border-red-500/60
                               @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-sm text-neutral-300 select-none">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-white/10 bg-neutral-950 text-red-500 focus:ring-red-500/70"
                        >
                        {{ __('Remember Me') }}
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-red-400 hover:text-red-300 font-medium">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="w-full mt-2 inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2.5
                           font-semibold text-white hover:bg-red-500 transition shadow-lg shadow-red-500/10"
                >
                    {{ __('Login') }}
                </button>

                <p class="text-center text-sm text-neutral-300">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="text-red-400 hover:text-red-300 font-semibold">
                        Regístrate
                    </a>
                </p>
            </form>
        </div>

        <p class="mt-4 text-center text-xs text-neutral-500">
            © {{ date('Y') }} CloverFit
        </p>
    </div>
</div>
@endsection
