<?php

namespace Database\Factories\Modele;

use App\User;
use App\Modele\Post;
use App\Modele\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;
    
    public function definition()
    {
        return [
            'content' => $this->faker->sentence,
            'post_id' =>  function(){
                return Post::all()->random();
            },
        
            'author_id' =>  function(){
                return User::all()->random();
            }
        ];
    }
}
