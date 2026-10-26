<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        Role::firstWhere('name', 'moderator')->users()->create([
            'name'     => 'Модератор',
            'email'    => 'moderator@example.com',
            'password' => 'password',
        ]);

        Article::factory()
            ->count(10)
            ->has(Comment::factory()->count(3))
            ->create();
    }
}