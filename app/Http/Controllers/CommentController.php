<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('images')->get();
        return view('comments.index', compact('comments'));
    }


    // No se usa
    // public function create()
    // {
    //     return view('comments.create');
    // }

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
            'images.*' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:102400',  // 100KB (100 KB = 102400 bytes)
            ],
        ]);

        // Crear el comentario
        $comment = Comment::create([
            'comment' => $validated['comment'],
            'post_id' => $validated['post_id'],
            'user_id' => $request->user()->id,
        ]);

        // Subir múltiples imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('comments', 'public');
                $comment->images()->create(['name' => $path]);
            }
        }

        return redirect()->route('home');
    }

    // No se usa
    // public function edit($id)
    // {
    //     return view('comments.edit', ['comment' => Comment::findOrFail($id)]);
    // }

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
