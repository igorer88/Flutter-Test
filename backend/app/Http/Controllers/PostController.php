<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Shared\PostsMasterController;
use App\Http\Requests\PostRequest;
use App\Modele\Category;
use App\Modele\Post;
use App\Modele\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected $masterController;

    public function __construct()
    {
        $this->masterController=new PostsMasterController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.posts')->with('posts', $this->masterController->index());
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_posts()
    {
        return view('posts.posts')->with('posts', $this->masterController->user_posts());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create_post')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        return redirect()->route('posts.user-posts')->with('message', $this->masterController->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modele\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        return view('posts.post')->with('post', $this->masterController->show($post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modele\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
       
        $post=Post::findOrfail($post);
        $this->masterController->PostUserCheck($post,' edit');
        return view('posts.edit_post')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'post'=> $post,
            'post_tags' =>DB::select('select tag_id from post_tag where post_id = ?', [$post->id]),
            //DB::select('select * from users where active = ?', [1])
            //insert('insert into post_tag (post_id, tag_id) values (?, ?)', [$post->id, $tag]);
        ]);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @param  \App\Modele\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request,$post)
    {
        return redirect()->route('posts.user-posts')->with('message', $this->masterController->update($request,$post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modele\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        return redirect()->route('posts.user-posts')->with('message', $this->masterController->destroy($post));
    }
}
