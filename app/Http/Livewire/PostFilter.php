<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostFilter extends Component
{
    public $search = ''; // Para filtrar por título
    public $category_id = ''; // Para filtrar por categoría
    public $tag_id = ''; // Para filtrar por tag
    public $posted = 'yes'; // Para filtrar por estado (publicado o no)

    public function render()
    {
        // Obtener los posts filtrados
        $posts = Post::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->category_id, function ($query) {
                $query->where('category_id', $this->category_id);
            })
            ->when($this->tag_id, function ($query) {
                $query->whereHas('tags', function ($q) {
                    $q->where('tags.id', $this->tag_id);
                });
            })
            ->when($this->posted !== '', function ($query) {
                $query->where('posted', $this->posted);
            })
            ->with(['category', 'tags', 'user', 'comments']) // Cargar relaciones
            ->get();

        // Obtener categorías y tags para los filtros
        $categories = Category::all();
        $tags = Tag::all();

        return view('livewire.post-filter', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
