<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}
    @yield('styles')
</head>
<body>
    <div id="app">
        <header class="w-full bg-white dark:bg-gray-800">
            <div class="ml-4 mr-4 py-4 pt-2 flex items-center justify-between">

                <a href="{{ url('/laravel') }}" class="text-4xl font-bold text-gray-700 dark:text-white">
                    Laravel
                </a>

                @if (Route::has('login'))
                    <nav class="space-x-4">
                        @auth
                            <a href="{{ url('/home') }}" class="text-2xl text-gray-700 dark:text-gray-500">Home</a>
                            <a href="{{ route('users.show', Auth::user()) }}" class="text-2xl text-gray-700 dark:text-gray-500">User Info</a>
                            <a href="{{ route('bulletin-boards.index') }}" class="text-2xl text-gray-700 dark:text-gray-500">Boards</a>
                            <a href="{{ route('logout') }}" class="text-2xl text-gray-700 dark:text-gray-500" onclick="event.preventDefault(); document.getElementById('logout-form' ).submit();">Log out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        @else
                            <a href="{{ url('/home') }}" class="text-2xl text-gray-700 dark:text-gray-500">Home</a>
                            <a href="{{ route('login') }}" class="text-2xl text-gray-700 dark:text-gray-500">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-2xl text-gray-700 dark:text-gray-500">Register</a>
                            @endif
                            <a href="{{ route('bulletin-boards.index') }}" class="text-2xl text-gray-700 dark:text-gray-500">Boards</a>
                        @endauth
                    </nav>
                @endif

            </div>
        </header>

        <main class="py-4">
            @yield('content')
            @stack('scripts')
        </main>

    </div>

    @yield('scripts')

</body>
</html>
