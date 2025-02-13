<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        // Ruta absoluta al archivo JSON en Laragon
        $jsonPath = base_path('storage/data/tags.json');

        // Leer el JSON
        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            $tags = json_decode($jsonData, true);

            // Insertar en la base de datos
            foreach ($tags['tags']['tag'] as $tag) {
                Tag::create([
                    'name' => $tag['name'],
                    'url_clean' => $tag['url'],
                ]);
            }
        } else {
            $this->command->error("❌ El archivo JSON no se encontró en: " . $jsonPath);
        }
    }
}
