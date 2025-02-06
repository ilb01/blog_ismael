<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Ismael</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased min-h-screen flex items-center justify-center px-6"
    style="background: linear-gradient(135deg, #b55400, #ff8c42); color: #ffffff;">

    <div class="w-full max-w-3xl bg-white/10 border border-gray-300/30 backdrop-blur-lg shadow-xl rounded-lg p-12">

        <!-- Header -->
        <header class="flex flex-col items-center text-center space-y-8">
            <h1 class="text-7xl font-extrabold tracking-wide uppercase text-white drop-shadow-lg">Blog Ismael</h1>
            <p class="text-3xl font-semibold text-white">2025</p>

            @if (Route::has('login'))
                <nav class="flex space-x-8">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="relative text-white text-xl font-medium hover:text-yellow-300 transition duration-300 ease-in-out">
                            Dashboard
                            <span
                                class="absolute left-0 -bottom-1 w-full h-1 bg-yellow-300 scale-x-0 transition-transform duration-300 hover:scale-x-100"></span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="relative text-white text-xl font-medium hover:text-yellow-300 transition duration-300 ease-in-out">
                            Log in
                            <span
                                class="absolute left-0 -bottom-1 w-full h-1 bg-yellow-300 scale-x-0 transition-transform duration-300 hover:scale-x-100"></span>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="relative text-white text-xl font-medium hover:text-yellow-300 transition duration-300 ease-in-out">
                                Register
                                <span
                                    class="absolute left-0 -bottom-1 w-full h-1 bg-yellow-300 scale-x-0 transition-transform duration-300 hover:scale-x-100"></span>
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Footer -->
        <footer class="mt-14 text-center text-1xl text-white">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>

</body>

</html>






