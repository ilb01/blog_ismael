<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Image;
use App\Models\Comment;
use App\Models\PostTag;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        $adminUser = new User();
        $adminUser->name = "admin";
        $adminUser->email = "adminJuan@iesemilidarder.com";
        $adminUser->role = "superadmin";
        $adminUser->password = Hash::make(12345678);
        $adminUser->save();

        User::factory(10)->create();
        $posts = Post::factory(50)->create();
        $tags = Tag::factory(50)->create();
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

        Comment::factory(50)->create();
        Image::factory(50)->create();
        PostTag::factory(50)->create();
    }
}
