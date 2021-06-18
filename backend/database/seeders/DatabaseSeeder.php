<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Truncate tables
        Schema::disableForeignKeyConstraints();
        DB::table("categories")->truncate();
        DB::table("comments")->truncate();
        DB::table("images")->truncate();
        DB::table("password_resets")->truncate();
        DB::table("posts")->truncate();
        DB::table("tags")->truncate();
        DB::table("users")->truncate();
        DB::table("videos")->truncate();
        Schema::enableForeignKeyConstraints();

        // User with same address
        App\User::factory()->create([
            'email' => "user@example.com"
        ]);
        // Create random data
        App\User::factory()->count(20)->create();
        App\Modele\Category::factory()->count(10)->create();
        App\Modele\Post::factory()->count(250)->create();
        App\Modele\Tag::factory()->count(50)->create();
        App\Modele\Image::factory()->count(200)->create();
        App\Modele\Video::factory()->count(50)->create();
        App\Modele\Comment::factory()->count(1500)->create();
    }
}
