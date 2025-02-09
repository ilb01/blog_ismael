<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            $posts = Post::all();
            return view('posts.index', compact('posts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->url_clean = $request->url_clean;
        $post->content = $request->content;
        $post->user_id = User::all()->random()->id;
        $post->save();
        Post::create($request->all());

        session()->flash('success', 'Post created successfully!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Busca la categoría por su ID
        $post = Post::findOrFail($id);

        // Retorna la vista con el post
        return view('posts.create_edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url_clean' => 'required|string|max:255',
            'content' => 'required|string',
            'posted' => 'required|in:yes,not',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validated);

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
