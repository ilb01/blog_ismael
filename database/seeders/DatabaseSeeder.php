<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $adminUser->name ="admin";
        $adminUser->email = "adminJuan@iesemilidarder.com";
        $adminUser->role = "superadmin";
        $adminUser->password = Hash::make(12345678);
        $adminUser->save();

        User::factory(10)->create();
        Post::factory(50)->create();
    }
}

