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
            <style>
               body, html {
                   height: 100%;
               }
               .image-container {
                   display: flex;
                   justify-content: center;
                   align-items: center;
                   height: 100%;
               }
               .image-container img {
                   max-width: 100%;
                   max-height: 100%;
                   object-fit: contain;
               }
               .links-container {
                   margin-right: 15px;
               }
               .links-container a {
                   font-size: calc(0.875rem + 5pt);
                   margin-right: 20px;
               }
            </style>
        </head>

        <body class="antialiased bg-gray-100 dark:bg-gray-900">

            <div class="fixed top-0 left-0 w-full bg-white dark:bg-gray-800">
             <div class="px-6 py-4 flex items-center justify-between">

                 <div class="text-3xl font-bold text-gray-700 dark:text-white">
                     Laravel Board
                 </div>

                 @if (Route::has('login'))
                     <div class="text-sm space-x-4 links-container">
                         @auth
                             <a href="{{ url('/home') }}" class="text-gray-700 dark:text-gray-500">Home</a>
                             <a href="{{ route('users.show', Auth::user()) }}" class="text-gray-700 dark:text-gray-500">User Info</a>
                             <a href="{{ route('bulletin-boards.index') }}" class="text-gray-700 dark:text-gray-500">Boards</a>
                             <a href="{{ route('logout') }}" class="text-gray-700 dark:text-gray-500" onclick="event.preventDefault(); document.getElementById('logout-form' ).submit();">Log out</a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                 @csrf
                             </form>
                         @else
                             <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-500">Log in</a>

                             @if (Route::has('register'))
                                 <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-500">Register</a>
                             @endif
                             <a href="{{ route('bulletin-boards.index') }}" class="text-gray-700 dark:text-gray-500">Boards</a>
                         @endauth
                     </div>
                 @endif

             </div>
            </div>

            <div class="image-container">
               <img src="/storage/background/welcome.jpeg" alt="welcome image">
            </div>

        </body>
</html>
