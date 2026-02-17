<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CloverFit') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-950 text-white antialiased overflow-x-hidden">
    <div id="app">
        <nav class="relative z-40 bg-neutral-950 border-b border-white/10 overflow-visible shadow-sm shadow-black/20">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <a class="flex items-center gap-3" href="{{ url('/') }}">
                    <div class="w-10 h-10 bg-red-600 rounded-md flex items-center justify-center text-white font-bold">CF</div>
                    <span class="font-semibold text-lg">{{ config('app.name', 'CloverFit') }}</span>
                </a>

                <div class="flex items-center gap-4">
                    @guest
                        @if (Route::has('login'))
                            <a class="text-sm text-neutral-300 hover:text-red-400" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a class="text-sm px-4 py-2 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500"
                               href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @else
                        <!-- Botón de Dashboard con tamaño consistente -->
                        <a class="text-sm px-4 py-2 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500"
                           href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                        <div class="relative">
                            <details class="group">
                                <summary class="cursor-pointer list-none flex items-center gap-2 text-sm text-neutral-300 hover:text-red-400 whitespace-nowrap px-3 py-2 rounded-md hover:bg-neutral-800/60 transition">
                                    <span class="font-medium">Bienvenido,</span>
                                    <span class="ml-1">{{ Auth::user()->name }}</span>
                                    <span class="transition group-open:rotate-180">▾</span>
                                </summary>

                                <div class="absolute right-0 mt-2 w-56 rounded-md bg-neutral-900 border border-white/10 shadow-lg overflow-hidden z-50 ring-1 ring-white/10">
                                    <a class="block px-4 py-2 text-sm hover:bg-neutral-800" href="{{ route('home') }}">Dashboard — Información</a>
                                </div>
                                <div class="absolute right-0 mt-2 w-48 rounded-md bg-neutral-900 border border-white/10 shadow-lg overflow-hidden">
                                    <a class="block px-4 py-2 text-sm hover:bg-neutral-800" href="{{ route('admin.dashboard') }}">
                                        Panel Admin
                                    </a>
                                    <!-- Botón de Cerrar sesión con tamaño consistente -->
                                    <a class="block px-4 py-2 text-sm hover:bg-neutral-800"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>
                                </div>
                            </details>

                            <!-- Formulario para cerrar sesión -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="max-w-full mx-auto px-0 py-0">
            @yield('content')
        </main>
    </div>
</body>
</html>
