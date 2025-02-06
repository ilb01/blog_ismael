@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-white mb-4">Categories</h1>

        <!-- Botón para agregar categoría -->
        <a href="{{ route('categories.create') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">Add Category</a>

        <!-- Tabla -->
        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-md">
            <table class="min-w-full text-white">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-4 py-2 text-sm font-semibold text-left">ID</th>
                        <th class="px-4 py-2 text-sm font-semibold text-left">Title</th>
                        <th class="px-4 py-2 text-sm font-semibold text-left">Url Clean</th>
                        <th class="px-4 py-2 text-sm font-semibold text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="px-4 py-2 text-sm">{{ $category->id }}</td>
                            <td class="px-4 py-2 text-sm">{{ $category->title }}</td>
                            <td class="px-4 py-2 text-sm">{{ $category->url_clean }}</td>
                            <td class="px-4 py-2 text-sm">
                                <!-- Botón de Editar -->
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-400 hover:text-yellow-600 mr-3">Edit</a>

                                <!-- Formulario para Eliminar -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
