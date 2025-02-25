<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Evita el desbordamiento horizontal */
        body {
            overflow-x: hidden;
            
        }

        .container {
            max-width: 100%;
            overflow-x: hidden;
        }

        table {
            width: 100%;
            max-width: 100%;
            table-layout: fixed;

        }
    </style>
</head>

<body class="antialiased w-full overflow-x-hidden">
    <div class="bg-gray-100 dark:bg-gray-900 w-full overflow-x-hidden">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow w-full">
                <div class="mx-auto py-6 px-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="w-full max-w-full min-h-screen">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
