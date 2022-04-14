<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css'))}}"/>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
@include('components.navigation')

<main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-200">
                    <div class="flex justify-between mb-5">
                        <h1 class="font-semibold text-3xl leading-tight">
                            {{ $title }}
                        </h1>
                        {{$link}}
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    document.querySelectorAll(".delete").forEach(item => {
        item.addEventListener("click", event => {
            event.preventDefault();

            fetch(event.target.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                },
                method: 'DELETE',

            })
        })
    });
</script>
</body>
</html>
