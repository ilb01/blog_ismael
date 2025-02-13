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
            $posts = json_decode($jsonData, true);

            // Insertar en la base de datos
            foreach ($posts['posts']['post'] as $post) {
                Post::create([
                    'title' => $post['title'],
                    'url_clean' => $post['url'],
                    'content' => $post['content'],
                    'posted' => $post['posted'],
                    'user_id'=> $post['user_id'],
                    'category_id' => $post['category_id'],
                ]);
            }
        } else {
            $this->command->error("❌ El archivo JSON no se encontró en: " . $jsonPath);
        }
    }
}
