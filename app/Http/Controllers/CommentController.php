<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function show($id)
    {
        return view('comments.show', compact('comment'));
    }

    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Asegura que todas las imágenes sean válidas
        ]);

        // Crear el comentario
        $comment = Comment::create([
            'comment' => $validated['comment'],
            'post_id' => $validated['post_id'],
            'user_id' => $request->user()->id,
        ]);

        // Subir múltiples imágenes
        if ($request->hasFile('images')) {
            $images = $request->file('images');  // Obtener todas las imágenes
            foreach ($images as $image) {
                    $path = $image->store('comments',  'public');  // Almacenar imagen en el directorio 'comments'
                    $comment->images()->create(['name' => $path, 'comment_id' => $comment->id]);
            }
        }

        return redirect()->route('home');
    }

    public function edit($id)
    {
        return view('comments.edit', ['comment' => Comment::findOrFail($id)]);
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully!');
    }
}
