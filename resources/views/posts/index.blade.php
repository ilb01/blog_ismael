<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 ">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-5 h-full">
        <div class="container mx-auto px-6 py-6">
            <div class="bg-white dark:bg-gray-900 shadow-xl sm:rounded-lg p-6 h-full flex flex-col">
                <div class="mb-6 flex">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 w-full">Manage Posts</h3>
                    <a href="{{ route('posts.create') }}"
                        style="width: 10%;
                            padding: 0.75rem 1.5rem;
                            background-color: #28a745;
                            color: white;
                            border-radius: 0.5rem;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                            transition: all 0.3s ease-in-out;
                            outline: none;
                            border: none;
                            text-align: center;
                            transform: scale(1);"
                        onmouseover="this.style.backgroundColor='#218838'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#28a745'; this.style.transform='scale(1)';">
                        + Add Post
                    </a>
                </div>

                <div class="overflow-auto flex-grow w-full">
                    <table class="w-full min-h-full bg-white dark:bg-gray-800 rounded-lg shadow-lg table-fixed">
                        <thead class="bg-gradient-to-r from-blue-900 to-blue-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center">ID
                                </th>
                                <th class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center">Title
                                </th>
                                <th class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center">Url
                                    Clean</th>
                                <th class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center">
                                    Content</th>
                                <th class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center">
                                    Posted</th>
                                <th class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center">
                                    Category ID</th>
                                <th class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center">User
                                    ID</th>
                                <th class="px-6 py-4 text-lg font-semibold border-b-2 border-gray-600 text-center">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="border-b border-gray-600 hover:bg-gray-700 transition-all duration-300">
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 text-white">
                                        {{ $post->id }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 text-white">
                                        {{ $post->title }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 text-white">
                                        {{ $post->url_clean }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 text-white">
                                        {!! $post->content !!}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 text-white">
                                        {{ $post->posted }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 text-white">
                                        {{ $post->category_id }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 text-white">
                                        {{ $post->user_id }}</td>
                                    <td class="px-6 py-4 text-center bg-blue-900 hover:bg-blue-700 text-white">
                                        <div class="flex justify-center space-x-8">
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                style="padding: 0.5rem 1rem; background-color: #3b82f6; color: white; border-radius: 0.375rem; transition: all 0.2s ease-in-out; text-align: center; display: inline-block;"
                                                onmouseover="this.style.backgroundColor='#2563eb'; this.style.transform='scale(1.05)';"
                                                onmouseout="this.style.backgroundColor='#3b82f6'; this.style.transform='scale(1)';">
                                                ✏️ Edit
                                            </a>

                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
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
