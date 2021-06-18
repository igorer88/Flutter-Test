<?php

namespace Database\Factories\Modele;

use App\Modele\Image;
use App\Modele\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = Image::class;
    
    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'url' => $this->faker->imageUrl(800,600),
            'post_id' => function(){
                return Post::all()->random();
            },
            'featured' => $this->faker->randomElement([true,false]),
        
        ];
    }
}
