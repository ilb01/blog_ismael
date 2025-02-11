<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Ismael</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Fondo animado con degradado en movimiento */
        @keyframes fondoAnimado {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        body {
            background: linear-gradient(135deg, #0f172a, #1e293b, #334155, #475569);
            background-size: 300% 300%;
            animation: fondoAnimado 12s ease infinite;
            color: white;
        }

        /* Animación fadeInUp */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.8s ease-in-out;
            box-shadow: 0 0 15px rgba(103, 121, 123, 0.5);
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 0 25px rgba(105, 116, 117, 0.8);
        }

        /* Estilo base para los enlaces */
        .glow-text {
            position: relative;
            text-decoration: none;
            transition: text-shadow 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        /* Efecto Hover */
        .glow-text:hover {
            text-shadow: 0 0 25px rgba(105, 116, 117, 0.8);
            transform: scale(1.02);
        }

        .glow-button {
            background-color: #67797B;
            /* Color de fondo inicial */
            color: white;
            border: 2px solid transparent;
            border-radius: 0.5rem;
            /* Bordes redondeados */
            transition: all 0.3s ease;
            /* Transición suave para todo */
        }

        .glow-button:hover {
            color: white;
            background-color: #525d5f;
            /* Fondo más oscuro al pasar el ratón */
            border: 2px solid transparent;
            box-shadow: 0 0 25px rgba(105, 116, 117, 0.8), 0 0 35px rgba(105, 116, 117, 0.6);
            /* Sombra más intensa */
            transform: scale(1.05);
            /* Aumentar ligeramente el tamaño */
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#1F2937] via-[#111827] to-[#1F2937] rounded-lg shadow-lg">

    <header class="flex flex-col items-center text-center space-y-8 mt-12">
        <h1 class="text-7xl font-extrabold tracking-wide uppercase text-white drop-shadow-2xl">
            Blog Ismael
        </h1>

        @if (Route::has('login'))
            <nav class="flex space-x-8 mt-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="relative text-white text-xl font-medium glow-text">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="relative text-white text-xl font-medium glow-text">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="relative text-white text-xl font-medium glow-text">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div class="mx-4 sm:mx-6 lg:mx-8 my-8">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-extrabold text-white mb-8 drop-shadow-2xl">
                Últimos Posts
            </h1>

            <!-- Barra de búsqueda con botón -->
            <form action="{{ route('search') }}" method="GET" class="w-full max-w-md flex items-center space-x-4 mt-6">
                <div class="relative w-full">
                    <input type="text" name="search" placeholder="Buscar por título..."
                        class="w-full p-3 rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 search-input">
                </div>
                <button type="submit"
                    class="px-6 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none transition-all duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6 px-6">
            @foreach ($posts as $post)
                <div
                    class="card p-6 rounded-2xl shadow-lg bg-white/10 border border-gray-300/30 backdrop-blur-lg text-white transition-all hover:scale-105 transform hover:shadow-2xl">
                    <h3 class="text-3xl font-bold text-white mb-4">{{ $post->title }}</h3>
                    <p class="mt-2 text-lg text-gray-200 mb-4">{!! $post->content !!}</p>
                    <p class="mt-4 text-sm text-gray-300 mb-6">Publicado el: {{ $post->created_at->format('d M, Y') }}
                    </p>
                    <a href="{{ route('posts.show', $post->id) }}"
                        class="inline-block mt-4 px-4 py-2 rounded-lg glow-button transition-all hover:bg-gray-600">
                        Leer más
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-14 text-center text-lg text-gray-400">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</body>

</html>
