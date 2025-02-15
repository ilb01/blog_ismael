<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        $adminUser = new User();
        $adminUser->name = "admin";
        $adminUser->email = "adminJuan@iesemilidarder.com";
        $adminUser->role = "superadmin";
        $adminUser->password = Hash::make(12345678);
        $adminUser->save();

        // Crear 10 usuarios aleatorios
        User::factory(10)->create();

        // Ejecutar otros seeders
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ImageSeeder::class);

        // Obtener todos los posts y tags
        $posts = Post::all();
        $tags = Tag::all();

        // Asociar tags a los posts (sin duplicación)
        $posts->each(function ($post) use ($tags) {
            $tagIds = $tags->random(rand(1, 5))->pluck('id')->toArray();
            $tagData = [];
            foreach ($tagIds as $id) {
                $tagData[$id] = [
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            $post->tags()->attach($tagData);
        });
    }
}
