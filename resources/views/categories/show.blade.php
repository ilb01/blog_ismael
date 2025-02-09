<x-app-layout>

    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            📂 Detalles de la Categoría
        </h2>

        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <p class="text-lg"><span class="font-semibold">ID:</span> {{ $category->id }}</p>
            <p class="text-lg"><span class="font-semibold">Title:</span> {{ $category->title }}</p>
            <p class="text-lg"><span class="font-semibold">Url Clean:</span> {{ $category->url_clean ?? 'Sin descripción' }}</p>
            <p class="text-lg"><span class="font-semibold">Creado el:</span> {{ $category->created_at->format('d/m/Y H:i') }}</p>
            <p class="text-lg"><span class="font-semibold">Última actualización:</span> {{ $category->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="flex justify-between mt-6 space-x-4">
            <a href="{{ route('categories.index') }}" class="bg-gray-800 hover:bg-gray-600 text-white py-3 px-6 rounded-lg transition-all transform hover:scale-105 shadow-md">
                ⬅️ Volver
            </a>
            <a href="{{ route('categories.edit', $category->id) }}" style="background-color: #34D399; " class="text-white py-3 px-6 rounded-lg transition-all transform hover:scale-105 shadow-md">
                ✏️ Editar
            </a>

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-3 px-6 rounded-lg transition-all transform hover:scale-105 shadow-md">
                    🗑️ Eliminar
                </button>
            </form>
        </div>
    </div>

</x-app-layout>

