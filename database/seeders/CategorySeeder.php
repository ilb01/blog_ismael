<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Ruta absoluta al archivo JSON en Laragon
        $jsonPath = base_path('storage/data/categories.json');

        // Leer el JSON
        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            $categories = json_decode($jsonData, true);

            // Insertar en la base de datos
            foreach ($categories['categories']['category'] as $category) {
                Category::create([
                    'title' => $category['name'],
                    'url_clean' => $category['url'],
                ]);
            }
        } else {
            $this->command->error("❌ El archivo JSON no se encontró en: " . $jsonPath);
        }
    }
}
