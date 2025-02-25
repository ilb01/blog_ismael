<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white">
            {{ __('Comments') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div id="success-message"
            class="flex items-center justify-between bg-gradient-to-r from-green-500 to-green-700 text-white px-6 py-4 rounded-lg shadow-xl mb-6 animate-fade-in transition-opacity duration-500 border-l-4 border-green-900">
            <div class="flex items-center space-x-3">
                <span class="text-2xl">✅</span>
                <span class="font-semibold text-lg">{{ session('success') }}</span>
            </div>
            <button
                onclick="document.getElementById('success-message').style.opacity='0'; setTimeout(() => document.getElementById('success-message').remove(), 500);"
                class="focus:outline-none text-white hover:text-gray-200 transition text-xl">
                ✖
            </button>
        </div>
    @endif
    <div class="py-5 h-full">
        <div class="container mx-auto px-6 py-6">
            <div class="bg-white dark:bg-gray-900 shadow-xl sm:rounded-lg p-6 h-full flex flex-col">
                <div class="mb-6 flex">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white w-full">Manage Comments</h3>
                </div>

                <div class="overflow-auto flex-grow w-full">
                    <table class="w-full min-h-full bg-white dark:bg-gray-800 rounded-lg shadow-lg table-fixed">
                        <thead class="bg-gradient-to-r from-blue-900 to-blue-600 dark:text-white">
                            <tr>
                                <th
                                    class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center dark:text-white">
                                    ID
                                </th>
                                <th
                                    class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center dark:text-white">
                                    Comment
                                </th>
                                <th
                                    class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center dark:text-white">
                                    User (ID)</th>
                                <th
                                    class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center dark:text-white">
                                    Post (ID)</th>
                                <th
                                    class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center dark:text-white">
                                    Comment Created</th>
                                <th
                                    class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center dark:text-white">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr
                                    class="border-b border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 dark:text-white">
                                        {{ $comment->id }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 dark:text-white">
                                        {{ $comment->comment }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 dark:text-white">
                                        {{ $comment->user->name }} ({{ $comment->user_id }})</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 dark:text-white">
                                        {{ $comment->post->title }} ({{ $comment->post_id }})</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 dark:text-white">
                                        {{ $comment->created_at }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 dark:text-white">
                                        <div class="flex justify-center space-x-6 gap-4">
                                            <!-- Botón de Ver (Show) -->
                                            <a href="{{ route('comments.show', $comment->id) }}"
                                                style="padding: 0.5rem 1rem; background-color: #f59e0b; color: white; border-radius: 0.375rem; transition: all 0.2s ease-in-out; text-align: center; display: inline-block; "
                                                onmouseover="this.style.backgroundColor='#d97706'; this.style.transform='scale(1.05)';"
                                                onmouseout="this.style.backgroundColor='#f59e0b'; this.style.transform='scale(1)';">
                                                👁️ Show
                                            </a>

                                            <!-- Botón de Eliminar (Delete) -->
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="padding: 0.5rem 1rem; background-color: #ef4444; color: white; border-radius: 0.375rem; transition: all 0.2s ease-in-out; text-align: center; display: inline-block;"
                                                    onmouseover="this.style.backgroundColor='#dc2626'; this.style.transform='scale(1.05)';"
                                                    onmouseout="this.style.backgroundColor='#ef4444'; this.style.transform='scale(1)';">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
