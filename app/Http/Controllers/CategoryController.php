<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    // En el controlador que maneja la creación de categorías
public function store(Request $request)
{
    // Validación y lógica de creación de la categoría
    $request->validate([
        'title' => 'required|string|max:255',
        'url_clean' => 'required|string|max:255|unique:categories,url_clean',
    ]);

    Category::create($request->all());

    // Redirigir después de la creación
    return redirect()->route('categories.index');
}


    public function edit($id)
    {
        // Busca la categoría por su ID
        $category = Category::findOrFail($id);

        // Retorna la vista con la categoría
        return view('categories.edit', compact('category'));
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url_clean' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
