<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-6 py-6">
        <h1 class="text-3xl font-bold dark:text-white mb-6">{{ isset($category) ? 'Edit' : 'Create' }} Category</h1>

        <!-- Formulario de creación y edición -->
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
            method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <div class="dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="title" class="block dark:text-white font-semibold">Title</label>
                    <input type="text" name="title" id="title"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('title', isset($category) ? $category->title : '') }}" required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="url_clean" class="block dark:text-white font-semibold">Url Clean</label>
                    <input type="text" name="url_clean" id="url_clean"
                        class="w-full px-4 py-2 mt-2 bg-gray-700  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('url_clean', isset($category) ? $category->url_clean : '') }}" required>
                    @error('url_clean')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-wrap justify-end items-center gap-6">
                    <a href="{{ route('categories.index') }}"
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
                        {{ isset($category) ? 'Update' : 'Create' }} Category
                    </button>
                </div>
        </form>
    </div>
</x-app-layout>
