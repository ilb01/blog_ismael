<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-6 py-6">
        <h1 class="text-3xl font-bold text-white mb-6">{{ isset($comment) ? 'Edit' : 'Create' }} Comment</h1>

        <!-- Formulario de creación y edición -->
        <form action="{{ isset($comment) ? route('comments.update', $comment->id) : route('comments.store') }}"
            method="POST">
            @csrf
            @if (isset($comment))
                @method('PUT') <!-- Si estamos editando, usamos PUT -->
            @endif
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="name" class="block text-white font-semibold">Comment</label>
                    <!-- Valor del campo name con valor de categoría en caso de edición -->
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('name', isset($comment) ? $comment->comment : '') }}" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-white font-semibold">User ID</label>
                    <!-- Valor del campo user_id con valor de categoría en caso de edición -->
                    <input type="text" name="user_id" id="user_id"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('user_id', isset($comment) ? $comment->user_id : '') }}" required>
                    @error('user_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="post_id" class="block text-white font-semibold">Post ID</label>
                    <!-- Valor del campo post_id con valor de categoría en caso de edición -->
                    <input type="text" name="post_id" id="post_id"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('post_id', isset($comment) ? $comment->post_id : '') }}" required>
                    @error('post_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex flex-wrap justify-end items-center gap-6">
                    <a href="{{ route('comments.index') }}"
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
                        {{ isset($comment) ? 'Update' : 'Create' }} Comment
                    </button>
                </div>
        </form>
    </div>
</x-app-layout>
