<?php

namespace Database\Factories\Modele;

use App\Modele\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'color' => $this->faker->hexColor,
        ];
    }
}
