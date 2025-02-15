<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    public function run()
    {
        // Ruta al archivo JSON
        $jsonPath = storage_path('data/images.json');

        // Leer el JSON
        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            $images = json_decode($jsonData, true);

            // Insertar en la base de datos
            foreach ($images['images']['image'] as $image) {
                Image::create([
                    'name' => $image['name'],
                    'comment_id' => $image['comment_id'],
                ]);
            }
        } else {
            $this->command->error("❌ El archivo JSON no se encontró en: " . $jsonPath);
        }
    }
}
