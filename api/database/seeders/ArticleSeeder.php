<?php

namespace Database\Seeders;

use App\Domain\Articles\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        Article::factory()
            ->count(10) // Generate 10 fake articles
            ->create();
    }
}
