<?php

namespace Database\Factories\Modele;

use App\Modele\Post;
use App\Modele\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    protected $model = Video::class;
    
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'url' => $this->faker->imageUrl(800,600),
            'post_id' => function(){
                return Post::all()->random();
            }
        ];
    }
}
