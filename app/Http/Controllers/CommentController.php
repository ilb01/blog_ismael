<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

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
        $request->validate([
            'comment' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',  // Validación de que el user_id exista en la tabla users
            'post_id' => 'required|exists:posts,id'   // Validación de que el post_id exista en la tabla posts
        ]);


        Comment::create($request->all());

        session()->flash('success', 'Comment created successfully!');
        return redirect()->route('comments.index');
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

