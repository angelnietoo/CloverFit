@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] relative flex items-center justify-center px-4 py-12">

    {{-- Fondo pro (gradiente + glow) --}}
    <div class="absolute inset-0 -z-10 bg-neutral-950">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(239,68,68,0.18),transparent_55%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,rgba(255,255,255,0.06),transparent_60%)]"></div>
    </div>

    <div class="w-full max-w-md">
        <div class="relative rounded-2xl border border-white/10 bg-neutral-900/70 backdrop-blur-xl shadow-2xl p-6 sm:p-8 overflow-hidden">

            {{-- brillo superior --}}
            <div class="pointer-events-none absolute -top-24 left-1/2 h-48 w-[32rem] -translate-x-1/2 rounded-full bg-red-500/20 blur-3xl"></div>

            <div class="mb-6">
                <h1 class="text-2xl font-extrabold tracking-tight text-white">
                    {{ __('Login') }}
                </h1>
                <p class="mt-1 text-sm text-neutral-300">
                    Accede a tu cuenta para entrar al panel.
                </p>
            </div>

            {{-- Mensaje general de error (si falla login) --}}
            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-red-500/25 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                    <span class="font-semibold">Ups:</span> revisa los campos, hay datos incorrectos.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-200">
                        {{ __('Email Address') }}
                    </label>

                    <div class="mt-1">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            placeholder="tucorreo@email.com"
                            class="w-full rounded-xl bg-neutral-950/70 border border-white/10 px-3.5 py-2.5 text-white placeholder-neutral-500
                                   shadow-[inset_0_1px_0_rgba(255,255,255,0.04)]
                                   transition
                                   focus:outline-none focus:ring-2 focus:ring-red-500/60 focus:border-red-500/40
                                   @error('email') border-red-500/60 focus:ring-red-500/60 focus:border-red-500/60 @enderror"
                        >
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-200">
                        {{ __('Password') }}
                    </label>

                    <div class="mt-1">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full rounded-xl bg-neutral-950/70 border border-white/10 px-3.5 py-2.5 text-white placeholder-neutral-500
                                   shadow-[inset_0_1px_0_rgba(255,255,255,0.04)]
                                   transition
                                   focus:outline-none focus:ring-2 focus:ring-red-500/60 focus:border-red-500/40
                                   @error('password') border-red-500/60 focus:ring-red-500/60 focus:border-red-500/60 @enderror"
                        >
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="flex items-center justify-between pt-1">
                    <label class="inline-flex items-center gap-2 text-sm text-neutral-300 select-none">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-white/15 bg-neutral-950 text-red-500
                                   focus:ring-2 focus:ring-red-500/60 focus:ring-offset-0"
                        >
                        {{ __('Remember Me') }}
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-red-400 hover:text-red-300 font-medium transition">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="w-full mt-2 inline-flex items-center justify-center rounded-xl px-4 py-2.5
                           font-semibold text-white transition
                           bg-gradient-to-r from-red-600 to-red-500
                           hover:from-red-500 hover:to-red-400
                           shadow-lg shadow-red-500/10
                           active:translate-y-[1px] active:shadow-red-500/5"
                >
                    {{ __('Login') }}
                </button>

                <p class="text-center text-sm text-neutral-300">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}"
                       class="text-red-400 hover:text-red-300 font-semibold transition">
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
