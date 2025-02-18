<div>
    <!-- Filtros -->
    <div class="mb-8 p-6 bg-gray-800 rounded-lg shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Filtro por título -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-300">Buscar por título</label>
                <input type="text" wire:model="search" id="search" placeholder="Título..."
                    class="mt-1 p-2 w-full rounded-md bg-gray-700 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Filtro por categoría -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-300">Categoría</label>
                <select wire:model="category_id" id="category_id"
                    class="mt-1 p-2 w-full rounded-md bg-gray-700 text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todas</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por tag -->
            <div>
                <label for="tag_id" class="block text-sm font-medium text-gray-300">Tag</label>
                <select wire:model="tag_id" id="tag_id"
                    class="mt-1 p-2 w-full rounded-md bg-gray-700 text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todos</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por estado (publicado o no) -->
            <div>
                <label for="posted" class="block text-sm font-medium text-gray-300">Estado</label>
                <select wire:model="posted" id="posted"
                    class="mt-1 p-2 w-full rounded-md bg-gray-700 text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="yes">Publicado</option>
                    <option value="not">No publicado</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Lista de posts -->
    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-8 mt-6 px-6">
        @foreach ($posts as $post)
            <div class="card p-6 rounded-3xl shadow-2xl bg-white/10 border border-gray-300/30 backdrop-blur-lg text-white hover:shadow-2xl hover:border-gray-400/50">
                <!-- Contenido del post -->
                <h3 class="text-4xl font-extrabold text-white mb-4">{{ $post->title }}</h3>
                <h6>Creado por:
                    <span class="text-sm text-white mb-2 rounded-xl bg-gray-700 p-2 inline-block font-semibold cursor-default">
                        {{ $post->user->name ?? 'Anónimo' }}
                    </span>
                </h6>
                <h6>Categoria:
                    <span class="text-sm text-white mb-2 rounded-xl bg-gray-500 p-2 inline-block font-semibold cursor-default">
                        {{ $post->category ? $post->category->title : 'Sin categoría' }}
                    </span>
                </h6>
                <p class="p-2 text-lg text-gray-200 leading-relaxed">{!! $post->content !!}</p>

                <!-- Mostrar etiquetas (Tags) -->
                @if ($post->tags->count() > 0)
                    <div class="flex flex-wrap gap-mb-4 mt-2">
                        @foreach ($post->tags as $tag)
                            <span class="px-4 py-1 rounded-xl bg-gray-500 text-white text-sm font-bold uppercase shadow-md transform transition-all hover:shadow-lg hover:scale-110 hover:bg-gray-600 hover:text-gray-300 cursor-default mr-4 mb-4">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Fecha de publicación -->
                <p class="mt-5 text-sm text-gray-300 mb-3">🗓 Publicado el: {{ $post->created_at->format('d M, Y') }}</p>

                <!-- Botón para mostrar/ocultar comentarios -->
                @if ($post->comments->count() > 0)
                    <button id="toggle-comments-btn-{{ $post->id }}" onclick="toggleComments({{ $post->id }})"
                        class="mt-4 px-5 py-2.5 rounded-lg bg-gray-700 text-white text-lg font-semibold shadow-lg transition-all hover:bg-gray-600 hover:scale-105">
                        💬 Leer Comentarios
                    </button>
                @endif

                <!-- Sección de Comentarios -->
                <div id="comments-{{ $post->id }}" class="{{ $post->comments->count() > 0 ? 'hidden' : '' }}">
                    <div class="mt-8">
                        @if ($post->comments->count() > 0)
                            <h4 class="text-2xl font-bold text-white mb-4">
                                📝 {{ $post->comments->count() === 1 ? 'Comentario' : 'Comentarios' }} ({{ $post->comments->count() }})
                            </h4>
                            @foreach ($post->comments as $comment)
                                <div class="mb-5 p-4 border-l-4 border-gray-500 bg-gray-800/40 rounded-lg shadow-md">
                                    <p class="text-gray-300 text-sm mb-2"><strong>👤 Usuario:</strong> {{ $comment->user->name ?? 'Anónimo' }}</p>
                                    <p class="text-gray-200 text-lg italic">"{{ $comment->comment }}"</p>
                                    @if ($comment->images->count() > 0)
                                        <div class="mt-3 grid grid-cols-2 gap-3">
                                            @foreach ($comment->images as $image)
                                                <img src="{{ asset('storage/' . $image->name) }}" alt="Imagen del comentario"
                                                    class="rounded-lg shadow-lg transform hover:scale-110 transition-all duration-300 cursor-pointer">
                                            @endforeach
                                        </div>
                                    @endif
                                    <p class="text-xs text-gray-400 mt-3">🕒 {{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="mt-6 p-6 bg-gray-800/40 rounded-lg border border-gray-700 shadow-lg text-center">
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
                            Debes <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-semibold underline">iniciar sesión</a> para añadir un comentario.
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
                                <input type="file" name="images[]" multiple id="image-input"
                                    class="w-full p-3 rounded-lg bg-gray-700/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-600 transition-all duration-300">
                                <div id="image-preview" class="mt-3 grid grid-cols-3 gap-3"></div>
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
        @endforeach
    </div>
</div>
