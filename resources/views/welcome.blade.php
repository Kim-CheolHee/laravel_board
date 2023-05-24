<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="bg-gray-100 dark:bg-gray-900 h-screen">

        <header class="w-full bg-white dark:bg-gray-800">
            <div class="ml-4 mr-4 py-4 pt-2 flex items-center justify-between">

                <div class="text-4xl font-bold text-gray-700 dark:text-white">
                    Laravel Board
                </div>

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

        <div class="flex items-center justify-center">
            <img src="/storage/background/welcome.jpeg" class="max-w-full max-h-full object-contain" alt="welcome image">
        </div>

    </body>
</html>
