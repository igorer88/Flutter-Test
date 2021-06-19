<?php

namespace Database\Factories\Modele;

use App\Modele\Category;
use App\Modele\Post;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'excerpt' => $this->faker->paragraph,
            'post_type' => $this->faker->randomElement(['text','video']),

            'author_id' =>  function(){
                return User::all()->random();
            },
            'category_id' =>  function(){
                return Category::all()->random();
            },
        ];
    }
}
