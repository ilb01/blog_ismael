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
    }

    public function show($id)
    {
        $comment = Comment::with('images')->findOrFail($id);
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
                if ($image->isValid()) {
                    // Generar un nombre único para cada imagen
                    $filename = uniqid('image_', true) . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('comments', $filename, 'public');  // Almacenar imagen en el directorio 'comments'

                    // Guardar la ruta de la imagen en la base de datos
                    Image::create([
                        'name' => $path,
                        'comment_id' => $comment->id,
                    ]);
                }
            }
        }

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $users = User::all();
        $posts = Post::all();
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
        // Eliminar las imágenes asociadas antes de eliminar el comentario
        foreach ($comment->images as $image) {
            Storage::delete('public/' . $image->name);  // Eliminar imagen del almacenamiento
            $image->delete();  // Eliminar registro en la base de datos
        }

        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully!');
    }
}
