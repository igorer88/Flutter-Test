<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('api_token', 60)->unique();
            $table->string('avatar')->nullable();
            $table->string('user_type')->default('user'); // ('admin','author')

            $table->json('liked_posts')->nullable();
            $table->string('disliked_posts')->nullable();
            $table->json('favourite_posts')->nullable();
            $table->string('favourite_categories')->nullable();
            $table->string('preferences')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
