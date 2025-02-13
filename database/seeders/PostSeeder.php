<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Ruta absoluta al archivo JSON en Laragon
        $jsonPath = base_path('storage/data/posts.json');

        // Leer el JSON
        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            $categories = json_decode($jsonData, true);

            // Insertar en la base de datos
            foreach ($categories['posts']['post'] as $post) {
                Post::create([
                    'id' => $post['id'],
                    'title' => $post['name'],
                    'url_clean' => $post['url'],
                    'content' => $post['content'],
                ]);
            }
        } else {
            $this->command->error("❌ El archivo JSON no se encontró en: " . $jsonPath);
        }
    }
}
