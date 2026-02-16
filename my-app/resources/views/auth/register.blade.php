@extends('layouts.app')

@section('content')
<div class="fixed inset-0 -z-20 bg-neutral-950">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(239,68,68,0.18),transparent_55%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,rgba(255,255,255,0.06),transparent_60%)]"></div>
</div>

<div class="relative h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="relative rounded-2xl border border-white/10 bg-neutral-900/70 backdrop-blur-xl shadow-2xl p-6 sm:p-8 overflow-hidden">
            
            {{-- brillo superior --}}
            <div class="pointer-events-none absolute -top-24 left-1/2 h-48 w-[32rem] -translate-x-1/2 rounded-full bg-red-500/20 blur-3xl"></div>
            
            <div class="relative mb-6">
                <h1 class="text-2xl font-extrabold tracking-tight text-white">Regístrate</h1>
                <p class="mt-1 text-sm text-neutral-300">Crea tu cuenta y empieza en CloverFit.</p>
            </div>

            {{-- Mensaje general de error --}}
            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-red-500/25 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                    Revisa los campos: hay datos incorrectos.
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="relative space-y-4">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-neutral-200">
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
                        class="mt-1 w-full rounded-lg bg-neutral-950/60 border border-white/10 px-3 py-2 text-white placeholder-neutral-500
                               focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500
                               @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

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
                        placeholder="tucorreo@email.com"
                        class="mt-1 w-full rounded-lg bg-neutral-950/60 border border-white/10 px-3 py-2 text-white placeholder-neutral-500
                               focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500
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
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="mt-1 w-full rounded-lg bg-neutral-950/60 border border-white/10 px-3 py-2 text-white placeholder-neutral-500
                               focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500
                               @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-neutral-200">
                        {{ __('Confirm Password') }}
                    </label>
                    <input
                        id="password-confirm"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="mt-1 w-full rounded-lg bg-neutral-950/60 border border-white/10 px-3 py-2 text-white placeholder-neutral-500
                               focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full mt-4 inline-flex items-center justify-center rounded-xl px-4 py-2.5 font-semibold text-white transition
                           bg-gradient-to-r from-red-600 to-red-500
                           hover:from-red-500 hover:to-red-400
                           shadow-lg shadow-red-500/10
                           active:translate-y-[1px] active:shadow-red-500/5"
                >
                    {{ __('Register') }}
                </button>

                <p class="text-center text-sm text-neutral-300">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="text-red-400 hover:text-red-300 font-semibold">
                        Inicia sesión
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
