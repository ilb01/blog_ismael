<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Ismael</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-white text-black">

    <div class="min-h-screen flex flex-col items-center justify-center px-6">
        <div class="w-full max-w-3xl bg-white shadow-lg rounded-lg p-12">

            <!-- Header -->
            <header class="flex flex-col items-center text-center space-y-8">
                <h1 class="text-8xl font-bold tracking-wide uppercase">Blog Ismael</h1>

                @if (Route::has('login'))
                    <nav class="flex space-x-8">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="text-black hover:text-[#FF2D20] transition duration-300 ease-in-out transform hover:scale-110">
                               Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="text-black hover:text-[#FF2D20] transition duration-300 ease-in-out transform hover:scale-110">
                               Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="text-black hover:text-[#FF2D20] transition duration-300 ease-in-out transform hover:scale-110">
                                   Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <!-- Footer -->
            <footer class="mt-10 text-center text-lg text-gray-600">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>

        </div>
    </div>

</body>

</html>
