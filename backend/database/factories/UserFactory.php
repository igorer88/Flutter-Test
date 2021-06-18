<?php

namespace Database\Factories;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;
    
    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make("pass.word$1"), // password
            'remember_token' => Str::random(10),
            'api_token'=>bin2hex(openssl_random_pseudo_bytes(30)),
            'avatar'=> $this->faker->imageUrl(100,100),
        ];
    }
}
