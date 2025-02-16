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

        // Reemplazar las barras invertidas (\) por barras normales (/) en la ruta del nombre de la imagen
        $imageName = str_replace('\\', '/', $request->name);

        // Almacenar la imagen con la ruta y el comentario asociado
        Image::create([
            'name' => $imageName,  // Guardar el nombre de la imagen con la ruta correcta
            'comment_id' => $request->comment_id,  // Asociar la imagen al comentario
        ]);


        session()->flash('success', 'Image created successfully!');
        return redirect()->route('images.index');
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

        session()->flash('success', 'Image deleted successfully!');
        return redirect()->route('images.index');
    }
}
