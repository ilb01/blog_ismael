<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 style="font-size: 1.5rem; font-weight: bold;" class="text-gray-800 mb-6 flex items-center">
            📂 Detalles de la Categoría
        </h1>

        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <p class="text-lg"><span class="font-semibold">ID:</span> {{ $category->id }}</p>
            <p class="text-lg"><span class="font-semibold">Title:</span> {{ $category->title }}</p>
            <p class="text-lg"><span class="font-semibold">Url Clean:</span>
                {{ $category->url_clean}}</p>
            <p class="text-lg"><span class="font-semibold">Creado el:</span>
                {{ $category->created_at->format('d/m/Y H:i') }}</p>
            <p class="text-lg"><span class="font-semibold">Última actualización:</span>
                {{ $category->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 24px; gap: 16px;">
            <!-- Volver -->
            <a href="{{ route('categories.index') }}"
                style="text-align: center; background-color: #2d3748; color: white; padding: 12px 24px; border-radius: 8px; font-weight: 600;
                transition: all 0.4s ease; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
                onmouseover="this.style.backgroundColor='#4a5568'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.2)';"
                onmouseout="this.style.backgroundColor='#2d3748'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.1)';">
                ⬅️ Volver
            </a>

            <!-- Editar -->
            <a href="{{ route('categories.edit', $category->id) }}"
                style="text-align: center; background-color: #16A34A; color: white; padding: 12px 24px; border-radius: 8px; font-weight: 600;
                transition: all 0.4s ease; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
                onmouseover="this.style.backgroundColor='#15803D'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.2)';"
                onmouseout="this.style.backgroundColor='#16A34A'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.1)';">
                ✏️ Editar
            </a>

            <!-- Eliminar -->
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
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
