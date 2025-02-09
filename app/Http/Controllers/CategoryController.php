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
        return view('categories.create_edit');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id); // Busca la categoría o lanza un error 404
        return view('categories.show', compact('category')); // Retorna la vista con la categoría
    }

    // En el controlador que maneja la creación de categorías
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url_clean' => 'nullable|string|max:255'
        ]);

        Category::create($request->all());

        session()->flash('success', 'Category created successfully!');
        return redirect()->route('categories.index');
    }


    public function edit($id)
    {
        // Busca la categoría por su ID
        $category = Category::findOrFail($id);

        // Retorna la vista con la categoría
        return view('categories.create_edit', compact('category'));
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

        session()->flash('success', 'Category deleted successfully!');
        return redirect()->route('categories.index');
    }
}
