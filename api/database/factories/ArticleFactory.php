<?php

namespace Database\Factories;

use App\Domain\Articles\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'brief' => $this->faker->paragraph,
            'full_text' => $this->faker->text(2000),
        ];
    }
}
