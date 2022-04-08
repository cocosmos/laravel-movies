<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>{{$title}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css'))}}" />


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased min-h-screen">
        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <h1>Test</h1>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <a href="{{ url('/session') }}" class="text-sm text-gray-100 dark:text-gray-100">Session</a>

                    <a href="{{ url('/room') }}" class="text-sm text-gray-100 dark:text-gray-100">Room</a>
                    <a href="{{ url('/movie') }}" class="text-sm text-gray-100 dark:text-gray-100">Movies</a>
                    <a href="{{ url('/cinema') }}" class="text-sm text-gray-100 dark:text-gray-100">Cinemas</a>
                    <a href="{{ url('/artist') }}" class="text-sm text-gray-100 dark:text-gray-100">Artists</a>
                    @auth
                        <a href="{{ url('/') }}" class="text-sm text-gray-100 dark:text-gray-100 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-100 dark:text-gray-100 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-100 dark:text-gray-100 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            </div>
            <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                {{$slot}}
                </div>

            <script>
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

               document.querySelectorAll(".delete").forEach(item => {
                   item.addEventListener("click", event => {
                       event.preventDefault();

                       fetch(event.target.href, {
                           headers:{
                               'X-Requested-With':'XMLHttpRequest',
                               'X-CSRF-TOKEN' : token
                           },
                           method:'DELETE',

                       })
                   })
               });
            </script>
    </body>
</html>
