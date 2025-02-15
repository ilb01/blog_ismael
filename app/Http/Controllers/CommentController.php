<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        $users = User::all();  // Obtener todos los usuarios
        $posts = Post::all();  // Obtener todos los posts
        return view('comments.create_edit', compact('users', 'posts'));
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id); // Busca el comentario o lanza un error 404
        return view('comments.show', compact('comment')); // Retorna la vista con el comentario
    }

    // En el controlador que maneja la creación de comentarios
    public function store(Request $request)
    {
        // Validar datos del formulario
        $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'images.*.image' => 'Solo se permiten archivos de imagen.',
            'images.*.mimes' => 'Solo se permiten imágenes en formato JPEG, PNG, JPG o GIF.',
        ]);

        // Crear el comentario
        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'post_id' => $request->input('post_id'),
            'user_id' => Auth::id(), // Usuario autenticado
        ]);

        // Guardar imágenes si se suben
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Guardar la imagen en el directorio 'public/comments'
                $path = $image->store('comments', 'public'); // Asegúrate de que sea 'public' para hacerlo accesible
                $filename = str_replace('public/', '', $path); // Obtener el nombre limpio del archivo

                // Crear la entrada en la base de datos para la imagen
                Image::create([
                    'name' => $filename,
                    'comment_id' => $comment->id, // Asociar la imagen con el comentario
                ]);
            }
        }

        return redirect()->route('comments.index')->with('success', 'Comment created successfully!');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $users = User::all();  // Obtener todos los usuarios
        $posts = Post::all();  // Obtener todos los posts
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
        $comment->delete();

        session()->flash('success', 'Comment deleted successfully!');
        return redirect()->route('comments.index');
    }
}
