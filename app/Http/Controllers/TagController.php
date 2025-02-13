<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Muestra una lista de etiquetas.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Muestra el formulario para crear una nueva etiqueta.
     */
    public function create()
    {
        return view('tags.create_edit');
    }

    /**
     * Almacena una nueva etiqueta en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'url_clean' => 'nullable|string|max:500'
        ]);

        Tag::create($request->all());

        session()->flash('success', 'Tag created successfully!');
        return redirect()->route('tags.index');
    }

    /**
     * Muestra una etiqueta específica.
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show', compact('tag'));
    }

    /**
     * Muestra el formulario para editar una etiqueta.
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.create_edit', compact('tag'));
    }

    /**
     * Actualiza una etiqueta en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'url_clean' => 'nullable|string|max:500',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($validated);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully!');
    }

    /**
     * Elimina una etiqueta de la base de datos.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        session()->flash('success', 'Tag deleted successfully!');
        return redirect()->route('tags.index');
    }
}
