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
<body class="bg-gray-900 text-white antialiased">
    <div id="app">
        <nav class="bg-gray-900 border-b border-gray-700">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <a class="flex items-center gap-3" href="{{ url('/') }}">
                    <div class="w-10 h-10 bg-yellow-500 rounded-md flex items-center justify-center text-black font-bold">CF</div>
                    <span class="font-semibold text-lg">{{ config('app.name', 'CloverFit') }}</span>
                </a>

                <div class="flex items-center gap-4">
                    @guest
                        @if (Route::has('login'))
                            <a class="text-sm text-gray-200 hover:text-yellow-400" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a class="text-sm px-4 py-2 rounded-md bg-yellow-500 text-black font-semibold hover:bg-yellow-400"
                               href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @else
                        <div class="relative">
                            <details class="group">
                                <summary class="cursor-pointer list-none flex items-center gap-2 text-sm text-gray-200 hover:text-yellow-400">
                                    <span>{{ Auth::user()->name }}</span>
                                    <span class="transition group-open:rotate-180">▾</span>
                                </summary>

                                <div class="absolute right-0 mt-2 w-48 rounded-md bg-gray-800 border border-gray-700 shadow-lg overflow-hidden">
                                    <a class="block px-4 py-2 text-sm hover:bg-gray-700"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </details>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="max-w-6xl mx-auto px-6 py-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
