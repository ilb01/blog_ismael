<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // Ruta absoluta al archivo JSON en Laragon
        $jsonPath = base_path('storage/data/comments.json');

        // Leer el JSON
        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            $comments = json_decode($jsonData, true);

            // Insertar en la base de datos
            foreach ($comments['comments']['comment'] as $comment) {
                Comment::create([
                    'comment' => $comment['comment'],
                    'user_id' => $comment['user_id'],
                    'post_id' => $comment['post_id'],
                ]);
            }
        } else {
            $this->command->error("❌ El archivo JSON no se encontró en: " . $jsonPath);
        }
    }
}
