<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create_edit');
    }

    public function show($id)
    {
        $image = Image::findOrFail($id);
        return view('images.show', compact('image'));
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'comment_id' => 'nullable|exists:comments,id',
        ]);

        // Reemplazar las barras invertidas por barras normales en la ruta de la imagen
        $path = str_replace('\\', '/', $request->name);

        // Almacenar la imagen con la ruta y el comentario asociado
        Image::create([
            'name' => $path,  // Ruta de la imagen
            'comment_id' => $request->comment_id,  // ID del comentario asociado
        ]);

        return redirect()->route('images.index')->with('success', 'Image created successfully!');
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('images.create_edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'comment_id' => 'nullable|exists:comments,id',
        ]);

        $image = Image::findOrFail($id);
        $image->update($validated);

        return redirect()->route('images.index')->with('success', 'Image updated successfully!');
    }

    public function destroy(Image $image)
    {
        $image->delete();

        return redirect()->route('images.index')->with('success', 'Image deleted successfully!');
    }
}
