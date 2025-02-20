<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // Muestra todas las imágenes
    public function index()
    {
        $images = Image::all(); // Obtiene todas las imágenes
        return view('images.index', compact('images'));
    }

    // Muestra el formulario para crear una nueva imagen
    public function create()
    {
        return view('images.create_edit');
    }

    // Almacena una nueva imagen en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'comment_id' => 'nullable|exists:comments,id',
        ]);

        // Almacena la imagen
        Image::create([
            'name' => $request->name,
            'comment_id' => $request->comment_id,
        ]);

        return redirect()->route('images.index')->with('success', 'Image created successfully!');
    }

    // Muestra el formulario para editar una imagen existente
    public function edit($id)
    {
        $image = Image::findOrFail($id); // Busca la imagen por ID
        return view('images.create_edit', compact('image'));
    }

    // Actualiza una imagen en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'comment_id' => 'nullable|exists:comments,id',
        ]);

        $image = Image::findOrFail($id); // Busca la imagen por ID
        $image->update($validated); // Actualiza los datos de la imagen

        return redirect()->route('images.index')->with('success', 'Image updated successfully!');
    }

    // Elimina una imagen de la base de datos
    public function destroy($id)
    {
        $image = Image::findOrFail($id); // Busca la imagen por ID
        $image->delete(); // Elimina la imagen

        return redirect()->route('images.index')->with('success', 'Image deleted successfully!');
    }
}
