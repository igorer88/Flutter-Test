<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post', function () {
});

/*  Route::get('/posttag', function () {
    for($i=0;$i<2000;$i++){
        $posts=DB::table('posts')->select('id')->get()->random(1);

        $tags=DB::table('tags')->select('id')->get()->random(1);
        
        $in=DB::table('post_tag')
            ->insertOrIgnore(
                ['post_id' =>   $posts[0]->id ,
                'tag_id' =>  $tags[0]->id ]
            ); 
 
      //  $in=DB::insertOrIgnore('insert into post_tag (post_id, tag_id) values (?, ?)', [$posts[0]->id, $tags[0]->id]);

    }

});  */

Auth::routes(['verify' => true]);
Auth::routes();

Route::GET('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
    Route::GET('/categories', 'CategoryController@index')->name('categories.categories');
    Route::GET('/categories/{category}', 'CategoryController@show')->name('categories.category');
    Route::GET('/create-category', 'CategoryController@create')->name('categories.create-category');
    Route::GET('/edit-category/{category}/edit', 'CategoryController@edit')->name('categories.edit-category');
    Route::PUT('/update-category/{category}', 'CategoryController@update')->name('categories.update-category');
    Route::POST('/categories', 'CategoryController@store')->name('categories.save-category');
    Route::DELETE('/delete-category/{category}', 'CategoryController@destroy')->name('categories.delete-category');

    Route::GET('/tags', 'TagController@index')->name('tags.tags');
    Route::GET('/tags/{tag}', 'TagController@show')->name('tags.tag');
    Route::GET('/create-tag', 'TagController@create')->name('tags.create-tag');
    Route::GET('/edit-tag/{tag}/edit', 'TagController@edit')->name('tags.edit-tag');
    Route::PUT('/update-tag/{tag}', 'TagController@update')->name('tags.update-tag');
    Route::POST('/tags', 'TagController@store')->name('tags.save-tag');
    Route::DELETE('/delete-tag/{tag}', 'TagController@destroy')->name('tags.delete-tag');

    Route::GET('/users', 'UserController@index')->name('users.users');

    Route::GET('/profile/{user}', 'UserController@show')->name('users.profile');
    Route::GET('/create-user', 'UserController@create')->name('users.create-user');
    Route::GET('/edit-user/{user}/edit', 'UserController@edit')->name('users.edit-user');
    Route::PUT('/update-user/{user}', 'UserController@update')->name('users.update-user');
    Route::POST('/users', 'UserController@store')->name('users.save-user');
    Route::DELETE('/delete-user/{user}', 'UserController@destroy')->name('users.delete-user');
    Route::GET('/posts/{user}', 'UserController@posts')->name('users.posts');

    Route::GET('/posts', 'PostController@index')->name('posts.posts');
    Route::GET('/user-posts', 'PostController@user_posts')->name('posts.user-posts');
    Route::GET('/post/{post}', 'PostController@show')->name('posts.post');
    Route::GET('/create-post', 'PostController@create')->name('posts.create-post');
    Route::GET('/edit-post/{post}/edit', 'PostController@edit')->name('posts.edit-post');
    Route::PUT('/update-post/{post}', 'PostController@update')->name('posts.update-post');
    Route::POST('/posts', 'PostController@store')->name('posts.save-post');
    Route::DELETE('/delete-post/{post}', 'PostController@destroy')->name('posts.delete-post');



    // Route::GET('/posts/{post}/comments/{comment}', 'CommentController@show')->name('comments.comment');
    // Route::POST('/posts/{post}/comments', 'CommentController@store')->name('comments.save-comment');
    // Route::DELETE('/posts/{post}/delete-comment/{comment}', 'CommentController@destroy')->name('comments.delete-comment');

    Route::group(['prefix' => 'posts'], function () {

        Route::GET('/{post}/comments/{comment}', 'CommentController@show')->name('posts.comment');
        Route::POST('/{post}/comments', 'CommentController@store')->name('posts.do-comment');
        Route::DELETE('/{post}/delete-comment/{comment}', 'CommentController@destroy')->name('posts.delete-comment');
        Route::GET('{post}/create-comment', 'CommentController@create')->name('posts.create-comment');
    });
});

 //Route::resource('/categories','CategoryController');
