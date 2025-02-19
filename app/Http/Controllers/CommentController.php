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
        $comments = Comment::with('images')->get();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        $users = User::all();
        $posts = Post::all();
        return view('comments.create_edit', compact('users', 'posts'));
    }

    public function show($id)
    {
        $comment = Comment::with('images')->findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear el comentario
        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $request->user()->id,
        ]);

        // Procesar las imágenes si existen
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    // Generar un nombre único para la imagen con un identificador único (UUID o ID del comentario)
                    $filename = uniqid('image_', true) . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('comments', $filename, 'public'); // Almacena la imagen en el directorio 'comments' en el almacenamiento público

                    // Guardar la imagen en la base de datos
                    Image::create([
                        'name' => $path,  // Guardamos solo la ruta relativa al almacenamiento
                        'comment_id' => $comment->id,
                    ]);
                }
            }
        }



        return redirect()->route('comments.index')->with('success', 'Comment created successfully!');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $users = User::all();
        $posts = Post::all();
        return view('comments.create_edit', compact('comment', 'users', 'posts'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validated);

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully!');
    }

    public function destroy(Comment $comment)
    {
        // Eliminar imágenes asociadas antes de borrar el comentario
        foreach ($comment->images as $image) {
            Storage::disk('public')->delete($image->name); // Elimina la imagen del almacenamiento
            $image->delete();
        }

        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully!');
    }
}
