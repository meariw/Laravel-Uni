<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{

    // генерируем фейковую новость для таблицы articles.
    public function definition(): array
    {
        return [
            'datePublic' => $this->faker->date(),
            'title'      => $this->faker->sentence(3),
            'shortDesc'  => $this->faker->sentence(),
            'desc'       => $this->faker->paragraphs(3, true),
        ];
    }
}