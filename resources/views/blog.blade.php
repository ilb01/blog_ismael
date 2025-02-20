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
            width: 100%;
            max-width: 100%;
            overflow: hidden;
            padding: 20%;
            /* Asegura espacio interno */
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

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#1F2937] via-[#111827] to-[#1F2937] rounded-lg shadow-lg">
    <header class="flex justify-between items-center px-8 py-4 bg-transparent mb-12">
        <!-- Título alineado a la izquierda -->
        <h1 class="text-7xl font-extrabold tracking-wide uppercase text-white drop-shadow-2xl">
            Blog Ismael
        </h1>

        <!-- Navegación alineada a la derecha -->
        <div class="flex items-center space-x-8">
            @if (Route::has('login'))
                <nav class="flex space-x-8">
                    @auth
                        @if (Auth::user()->role !== 'user')
                            <a href="{{ url('/dashboard') }}" class="relative text-white text-xl font-medium glow-text">
                                Dashboard
                            </a>
                        @endif
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

            @auth
                <div class="relative">
                    <button id="userButton"
                        class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <!-- Menú desplegable -->
                    <div id="dropdownMenu"
                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 hidden">
                        <div class="py-1">
                            <a href="/profile"
                                class="block px-4 py-2 text-right text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Profile
                            </a>

                            <form method="POST" action="/logout">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit"
                                    class="block text-right w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </header>

    <div class="mx-4 sm:mx-6 lg:mx-8 my-8">
        <div class="flex justify-between items-center w-full">
            <h1 class="text-4xl font-extrabold text-white mb-8 drop-shadow-2xl">
                Últimos Posts
            </h1>

            <!-- Barra de búsqueda con botón -->
            <form action="{{ route('search') }}" method="GET" class="flex items-center space-x-4 mt-6 w-full max-w-md"
                onsubmit="return checkSearchInput()">
                <div class="relative w-full">
                    <input type="text" name="search" placeholder="Buscar por título..."
                        class="w-full p-3 rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 search-input"
                        id="search-input">
                </div>
                <button type="submit"
                    class="px-6 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500 focus:outline-none transition-all duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        {{-- Lista de POSTS --}}

        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-8 mt-6 px-6">
            @foreach ($posts as $post)
                @if ($post->posted == 'yes')
                    <div
                        class="card p-6 rounded-3xl shadow-2xl bg-white/10 border border-gray-300/30 backdrop-blur-lg text-white hover:shadow-2xl hover:border-gray-400/50">

                        {{-- Título del post --}}
                        <h3 class="text-4xl font-extrabold text-white mb-4">{{ $post->title }}</h3>
                        {{-- Creado por --}}
                        <h6>Creado por:
                            <span
                                class="text-sm text-white mb-2 rounded-xl bg-gray-700 p-2 inline-block font-semibold cursor-default">
                                {{ $post->user->name ?? 'Anónimo' }}
                            </span>
                        </h6>

                        {{-- Categoria del post --}}
                        <h6>Categoria:
                            <span
                                class="text-sm text-white mb-2  rounded-xl  bg-gray-500 p-2 inline-block  font-semibold cursor-default">
                                {{ $post->category ? $post->category->title : 'Sin categoría' }}
                            </span>
                        </h6>

                        {{-- Contenido del post --}}
                        <p class="p-2 text-lg text-gray-200 leading-relaxed">{!! $post->content !!}</p>

                        {{-- Mostrar etiquetas (Tags) --}}
                        @if ($post->tags->count() > 0)
                            <div class="flex flex-wrap gap-mb-4 mt-2">
                                @foreach ($post->tags as $tag)
                                    <span
                                        class="px-4 py-1 rounded-xl bg-gray-500 text-white text-sm font-bold uppercase shadow-md transform transition-all hover:shadow-lg hover:scale-110 hover:bg-gray-600 hover:text-gray-300 cursor-default mr-4 mb-4">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Fecha de publicación --}}
                        <p class="mt-5 text-sm text-gray-300 mb-3">🗓 Publicado el:
                            {{ $post->created_at->format('d M, Y') }}</p>

                        <!-- Botón para mostrar/ocultar comentarios -->
                        @if ($post->comments->count() > 0)
                            <button id="toggle-comments-btn-{{ $post->id }}"
                                onclick="toggleComments({{ $post->id }})"
                                class="mt-4 px-5 py-2.5 rounded-lg bg-gray-700 text-white text-lg font-semibold shadow-lg transition-all hover:bg-gray-600 hover:scale-105">
                                💬 Leer Comentarios
                            </button>
                        @endif

                        <!-- Sección de Comentarios -->
                        <div id="comments-{{ $post->id }}"
                            class="{{ $post->comments->count() > 0 ? 'hidden' : '' }}">
                            <div class="mt-8">
                                @if ($post->comments->count() > 0)
                                    <!-- Solo muestra el título si hay comentarios -->
                                    <h4 class="text-2xl font-bold text-white mb-4">
                                        📝
                                        {{ $post->comments->count() === 1 ? 'Comentario' : 'Comentarios' }} (
                                        {{ $post->comments->count() }} )
                                    </h4>
                                @endif
                                @if ($post->comments->count() > 0)
                                    @foreach ($post->comments as $comment)
                                        <div
                                            class="mb-5 p-4 border-l-4 border-gray-500 bg-gray-800/40 rounded-lg shadow-md">
                                            <p class="text-gray-300 text-sm mb-2"><strong>👤 Usuario:</strong>
                                                {{ $comment->user->name ?? 'Anónimo' }}</p>
                                            <p class="text-gray-200 text-lg italic">"{{ $comment->comment }}"</p>

                                            {{-- @if ($comment->images->count() > 0)
                                                <div class="mt-3 grid grid-cols-2 gap-3">
                                                    @foreach ($comment->images as $image)
                                                        <img src="{{ asset('storage/' . $image->name) }}"
                                                            alt="Imagen del comentario"
                                                            class="rounded-lg shadow-lg transform hover:scale-110 transition-all duration-300 cursor-pointer">
                                                    @endforeach
                                                </div>
                                            @endif --}}

                                            <p class="text-xs text-gray-400 mt-3">🕒
                                                {{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <div
                                        class="mt-6 p-6 bg-gray-800/40 rounded-lg border border-gray-700 shadow-lg text-center">
                                        <p class="text-gray-300">No hay comentarios aún.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Botón para mostrar el formulario de comentarios -->
                        @auth
                            <button id="toggle-form-btn-{{ $post->id }}" onclick="toggleForm({{ $post->id }})"
                                class="mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 ease-in-out transform hover:scale-105">
                                + Añadir Comentario
                            </button>
                        @else
                            <div class="mt-6 p-6 bg-gray-800/40 rounded-lg border border-gray-700 shadow-lg text-center">
                                <p class="text-gray-300 text-lg">
                                    Debes <a href="{{ route('login') }}"
                                        class="text-blue-400 hover:text-blue-300 font-semibold underline">iniciar
                                        sesión</a> para añadir un comentario.
                                </p>
                            </div>
                        @endauth

                        <!-- Formulario de Comentarios (oculto por defecto) -->
                        @auth
                            <div id="comment-form-{{ $post->id }}" class="mt-6 hidden">
                                <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                                    <div class="mb-4">
                                        <textarea name="comment" rows="3"
                                            class="w-full p-3 rounded-lg bg-gray-700/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-600 transition-all duration-300"
                                            placeholder="Escribe tu comentario..." required></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <input type="file" name="images[]" id="images-{{ $post->id }}" multiple
                                            class="w-full p-3 rounded-lg bg-gray-700/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-600 transition-all duration-300">
                                        <div id="image-preview-{{ $post->id }}" class="mt-3 grid grid-cols-3 gap-3">
                                        </div>
                                    </div>

                                    <div class="flex space-x-4">
                                        <button type="submit"
                                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 ease-in-out transform hover:scale-105">
                                            Enviar Comentario
                                        </button>
                                        <button type="button" onclick="toggleForm({{ $post->id }})"
                                            class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-300 ease-in-out transform hover:scale-105">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endauth

                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-14 text-center text-lg text-gray-400">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>

    <script>
        // Función para alternar la visibilidad de los comentarios
        function toggleComments(postId) {
            const commentsSection = document.getElementById(`comments-${postId}`);
            const toggleButton = document.getElementById(`toggle-comments-btn-${postId}`);

            if (commentsSection.classList.contains('hidden')) {
                commentsSection.classList.remove('hidden');
                toggleButton.innerHTML = 'Quitar Comentarios';
            } else {
                commentsSection.classList.add('hidden');
                toggleButton.innerHTML = '💬 Leer Comentarios';
            }
        }

        // Función para alternar la visibilidad del formulario de comentarios (Añadir Comentario)
        function toggleForm(postId) {
            const commentForm = document.getElementById(`comment-form-${postId}`);
            const toggleFormButton = document.getElementById(`toggle-form-btn-${postId}`);

            if (commentForm.classList.contains('hidden')) {
                commentForm.classList.remove('hidden');
                toggleFormButton.classList.add('hidden'); // Oculta el botón "Añadir Comentario"
            } else {
                commentForm.classList.add('hidden');
                toggleFormButton.classList.remove('hidden'); // Muestra el botón "Añadir Comentario"
            }
        }

        function checkSearchInput() {
            const searchInput = document.getElementById('search-input').value.trim();

            // Si no hay texto en el campo de búsqueda, redirigir a la página principal
            if (searchInput === "") {
                window.location.href = "{{ url('/') }}"; // Redirigir a la página principal
                return false;
            }

            return true;
        }

        const userButton = document.getElementById('userButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        userButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

        // Cerrar el menú si se hace clic fuera de él
        window.addEventListener('click', function(event) {
            if (!userButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Previsualización de imágenes seleccionadas
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(event) {
                const postId = this.id.split('-')[1]; // Extrae el ID del post
                const preview = document.getElementById(`image-preview-${postId}`);
                preview.innerHTML = ''; // Limpiar previsualización anterior

                Array.from(event.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('rounded-lg', 'shadow-lg', 'w-full', 'h-24',
                            'object-cover');
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>
</body>

</html>
