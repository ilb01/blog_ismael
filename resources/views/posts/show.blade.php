<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 style="font-size: 1.5rem; font-weight: bold;" class="text-gray-800 mb-6 flex items-center">
            📂 Detalles del Post
        </h1>

        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <p class="text-lg">
                <span class="font-semibold">ID:</span> {{ $post->id }}
            </p>
            <p class="text-lg">
                <span class="font-semibold">Title:</span> {{ $post->title }}
            </p>
            <p class="text-lg">
                <span class="font-semibold">Url Clean:</span> {{ $post->url_clean }}
            </p>
            <p class="text-lg">
                <span class="font-semibold">Content:</span>
                {!! $post->content ?? 'Sin contenido' !!}
            </p>
            <p class="text-lg">
                <span class="font-semibold">Posted:</span> {{ $post->posted }}
            </p>
            <p class="text-lg">
                <span class="font-semibold">Tags:</span>
                @foreach ($post->tags as $tag)
                    <span class="bg-gray-500 text-white px-2 py-1 rounded-full text-sm">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </p>
            <p class="text-lg">
                <span class="font-semibold">Category:</span>
                {{ $post->category->title }} ({{ $post->category_id }})
            </p>
            <p class="text-lg">
                <span class="font-semibold">User (ID):</span> {{$post->user->name}}  ({{ $post->user_id }})
            </p>
            <p class="text-lg">
                <span class="font-semibold">Creado el:</span>
                {{ $post->created_at->format('d/m/Y H:i') }}
            </p>
            <p class="text-lg">
                <span class="font-semibold">Última actualización:</span>
                {{ $post->updated_at->format('d/m/Y H:i') }}
            </p>
        </div>
        <div style="display: flex; justify-content: center; margin-top: 24px; gap: 16px;">
            <!-- Botón de Volver (Back) -->
            <a href="{{ route('posts.index') }}"
                style="text-align: center; background-color: #2d3748; color: white; padding: 12px 24px; border-radius: 8px; font-weight: 600;
                transition: all 0.4s ease; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
                onmouseover="this.style.backgroundColor='#4a5568'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.2)';"
                onmouseout="this.style.backgroundColor='#2d3748'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.1)';">
                ⬅️ Volver
            </a>

            <!-- Botón de Editar (Edit) -->
            <a href="{{ route('posts.edit', $post->id) }}"
                style="text-align: center; background-color: #16A34A; color: white; padding: 12px 24px; border-radius: 8px; font-weight: 600;
                transition: all 0.4s ease; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
                onmouseover="this.style.backgroundColor='#15803D'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.2)';"
                onmouseout="this.style.backgroundColor='#16A34A'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.1)';">
                ✏️ Editar
            </a>

            <!-- Botón de Eliminar (Delete) -->
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                onsubmit="return confirm('¿Estás seguro de eliminar este post?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    style="text-align: center; background-color: #e53e3e; color: white; padding: 12px 24px; border-radius: 8px; font-weight: 600;
                    transition: all 0.4s ease; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
                    onmouseover="this.style.backgroundColor='#c53030'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.2)';"
                    onmouseout="this.style.backgroundColor='#e53e3e'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.1)';">
                    🗑️ Eliminar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
