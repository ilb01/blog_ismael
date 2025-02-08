<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Ismael</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Fondo animado con degradado en movimiento */
        @keyframes fondoAnimado {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            background: linear-gradient(135deg, #1f2937, #111827, #1e2836, #0f172a);
            background-size: 300% 300%;
            animation: fondoAnimado 10s ease infinite;
            color: white;
        }
    </style>
</head>

<body class="antialiased min-h-screen flex items-center justify-center px-6">

    <div class="w-full max-w-3xl bg-white/10 border border-gray-300/30 backdrop-blur-lg shadow-2xl rounded-xl p-12">

        <!-- Header -->
        <header class="flex flex-col items-center text-center space-y-8">
            <h1 class="text-7xl font-extrabold tracking-wide uppercase text-white drop-shadow-2xl transition duration-300 hover:text-cyan-300">
                Blog Ismael
            </h1>
            <p class="text-3xl font-semibold text-gray-300">2025</p>

            @if (Route::has('login'))
                <nav class="flex space-x-8">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="relative text-white text-xl font-medium hover:text-cyan-300 transition duration-300 ease-in-out">
                            Dashboard
                            <span class="absolute left-0 -bottom-1 w-full h-1 bg-cyan-300 scale-x-0 transition-transform duration-300 hover:scale-x-100"></span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="relative text-white text-xl font-medium hover:text-cyan-300 transition duration-300 ease-in-out">
                            Log in
                            <span class="absolute left-0 -bottom-1 w-full h-1 bg-cyan-300 scale-x-0 transition-transform duration-300 hover:scale-x-100"></span>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="relative text-white text-xl font-medium hover:text-cyan-300 transition duration-300 ease-in-out">
                                Register
                                <span class="absolute left-0 -bottom-1 w-full h-1 bg-cyan-300 scale-x-0 transition-transform duration-300 hover:scale-x-100"></span>
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Footer -->
        <footer class="mt-14 text-center text-lg text-gray-400">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>

</body>

</html>

