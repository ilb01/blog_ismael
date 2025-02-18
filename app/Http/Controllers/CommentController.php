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
        // Obtener todos los usuarios y posts
        $users = User::all();
        $posts = Post::all();
        return view('comments.create_edit', compact('users', 'posts'));
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id); // Busca el comentario por ID
        return view('comments.show', compact('comment'));
    }

    public function store(Request $request)
    {
        // Validar datos del formulario
        $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Aseguramos que sea una imagen y con los formatos correctos
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

        // Verificar si se han subido imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Verificamos que la imagen sea válida antes de procesarla
                if ($image->isValid()) {
                    // Almacenar la imagen en el disco público, en la carpeta 'comments'
                    $path = $image->store('comments', 'public');

                    // Aseguramos que el nombre del archivo se almacene correctamente
                    $filename = basename($path); // Usamos basename() para obtener solo el nombre del archivo

                    // Crear la entrada en la base de datos para la imagen
                    Image::create([
                        'name' => $filename,
                        'comment_id' => $comment->id, // Relacionamos la imagen con el comentario
                    ]);
                } else {
                    // Si la imagen no es válida, puedes lanzar un error o hacer algo aquí
                    return back()->withErrors(['images' => 'Algunas imágenes no son válidas.']);
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
        $comment->delete();

        session()->flash('success', 'Comment deleted successfully!');
        return redirect()->route('comments.index');
    }
}
