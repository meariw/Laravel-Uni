<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Article::factory()
            ->count(10)
            ->has(Comment::factory()->count(3))
            ->create();
    }
}