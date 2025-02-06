<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-6 py-6">
        <h1 class="text-3xl font-bold text-white mb-6">{{ isset($category) ? 'Edit' : 'Create' }} Category</h1>

        <!-- Formulario de creación y edición -->
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
            @csrf
            @if(isset($category))
                @method('PUT') <!-- Si estamos editando, usamos PUT -->
            @endif
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="title" class="block text-white font-semibold">Title</label>
                    <!-- Valor del campo title con valor de categoría en caso de edición -->
                    <input type="text" name="title" id="title" class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title', isset($category) ? $category->title : '') }}" required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="url_clean" class="block text-white font-semibold">Url Clean</label>
                    <!-- Valor del campo url_clean con valor de categoría en caso de edición -->
                    <input type="text" name="url_clean" id="url_clean" class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('url_clean', isset($category) ? $category->url_clean : '') }}" required>
                    @error('url_clean')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('categories.index') }}" class="inline-block bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300">Cancel</a>
                    <button type="submit" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">{{ isset($category) ? 'Update' : 'Create' }} Category</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
