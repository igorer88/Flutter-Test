<?php

namespace Database\Factories\Modele;

use App\Modele\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;
    
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        ];
    }
}
