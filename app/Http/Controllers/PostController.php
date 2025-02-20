<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            // Obtener todos los posts con sus tags
            $posts = Post::with('tags')->get();
            return view('posts.index', compact('posts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Coger todas las categorías
        $categories = Category::all();

        // Coger todos los tags disponibles
        $allTags = Tag::all();

        return view('posts.create_edit', compact('categories', 'allTags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // Validar los datos del request usando el Form Request (StorePostRequest)
        $validatedData = $request->validated();

        // Crear el post con los datos validados
        $post = Post::create([
            'title' => $validatedData['title'],
            'url_clean' => $validatedData['url_clean'],
            'content' => $validatedData['content'],
            'posted' => $validatedData['posted'],
            'user_id' => $request->user()->id, // Obtener el ID del usuario autenticado
            'category_id' => $validatedData['category_id'],
        ]);

        // Sincronizar los tags con el post
        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        // Si hay algo en el campo de búsqueda, buscar los posts por título
        if ($query) {
            $posts = Post::where('title', 'like', "%{$query}%")->get();
        } else {
            $posts = Post::all(); // Mostrar todos los posts si no hay búsqueda
        }

        return view('blog', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ordenar comentarios por fecha ascendente
        $post = Post::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->findOrFail($id);

        return view('posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Buscar el post por ID
        $post = Post::findOrFail($id);

        // Obtener todas las categorías
        $categories = Category::all();

        // Obtener todos los tags disponibles
        $allTags = Tag::all();

        return view('posts.create_edit', compact('post', 'categories', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url_clean' => 'required|string|max:255',
            'content' => 'required|string',
            'posted' => 'required|in:yes,not',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id', // Comprobar que todos los tags existen
        ]);

        // Buscar el post por ID
        $post = Post::findOrFail($id);

        // Actualizar los campos del post
        $post->update($validated);

        // Sincronizar los tags con el post
        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
