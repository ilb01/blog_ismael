<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-6 py-6">
        <h1 class="text-3xl font-bold text-white mb-6">{{ isset($post) ? 'Edit' : 'Create' }} Post</h1>

        <!-- Formulario de creación y edición -->
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}"
            method="POST">
            @csrf
            @if (isset($post))
                @method('PUT') <!-- Si estamos editando, usamos PUT -->
            @endif
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="title" class="block text-white font-semibold">Title</label>
                    <!-- Valor del campo title con valor de categoría en caso de edición -->
                    <input type="text" name="title" id="title"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('title', isset($post) ? $post->title : '') }}" required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="url_clean" class="block text-white font-semibold">Url Clean</label>
                    <!-- Valor del campo url_clean con valor de categoría en caso de edición -->
                    <input type="text" name="url_clean" id="url_clean"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('url_clean', isset($post) ? $post->url_clean : '') }}" required>
                    @error('url_clean')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-white font-semibold">Content</label>
                    <!-- Valor del campo content con valor de categoría en caso de edición -->
                    <input type="text" name="content" id="content"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('content', isset($post) ? $post->content : '') }}" required>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="posted" class="block text-white font-semibold">Posted</label>
                    <!-- Valor del campo posted con valor de categoría en caso de edición -->
                    <input type="text" name="posted" id="posted"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('posted', isset($post) ? $post->posted : '') }}" required>
                    @error('posted')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-white font-semibold">Category ID</label>
                    <!-- Valor del campo category_id con valor de categoría en caso de edición -->
                    <input type="text" name="category_id" id="category_id"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('category_id', isset($post) ? $post->category_id : '') }}" required>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="user_id" class="block text-white font-semibold">User ID</label>
                    <!-- Valor del campo user_id con valor de categoría en caso de edición -->
                    <input type="text" name="user_id" id="user_id"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('user_id', isset($post) ? $post->user_id : '') }}" required>
                    @error('user_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex flex-wrap justify-end items-center gap-6">
                    <a href="{{ route('posts.index') }}"
                        style="flex: 0 1 15%; text-align: center; background-color: #de364f; color: white; padding: 8px 16px; border-radius: 8px; font-weight: 600;
                        display: flex; align-items: center; justify-content: center; gap: 8px; transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;"
                        onmouseout="this.style.backgroundColor='#de364f'; this.style.boxShadow='none';"
                        onmouseover="this.style.backgroundColor='#fd1235'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.2)';">
                        Cancel
                    </a>

                    <button type="submit"
                        style="flex: 0 1 15%; text-align: center; background-color: #4caf50; color: white; padding: 8px 16px; border-radius: 8px; font-weight: 600;
                        display: flex; align-items: center; justify-content: center; gap: 8px; transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;"
                        onmouseover="this.style.backgroundColor='#388e3c'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.2)';"
                        onmouseout="this.style.backgroundColor='#4caf50'; this.style.boxShadow='none';">
                        {{ isset($post) ? 'Update' : 'Create' }} Post
                    </button>
                </div>
        </form>
    </div>
</x-app-layout>
