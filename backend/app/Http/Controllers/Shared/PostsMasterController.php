<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostsResource;
use App\Modele\Image;
use App\Modele\Post;
use Illuminate\Support\Facades\DB;
use App\Exceptions\PostNotBelongsToUser;
use App\Modele\Comment;

class PostsMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(Post::paginate());
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_posts()
    {
        return PostResource::collection(Auth::user()->posts()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post =new Post;
        $post->author_id= Auth::user()->getAuthIdentifier();
        $post->title= $request->title;
        $post->content= $request->content;
        $post->post_type= 'text';
        $post->category_id= $request->category_id;
        $post->save();

        if($request->has('post_tags')){
            foreach ($request->input('post_tags') as $tag) {
                
                DB::insert('insert into post_tag (post_id, tag_id) values (?, ?)', [$post->id, $tag]);
                //DB::table('post_tag')->insert(['post_id' =>$post->id, 'tag_id' => $id]);
            }
        }

        if($request->hasFile('image_id')){
            $counter=0;
            foreach ($request->file('image_id') as $key => $image_post) {
                $path=$image_post->store('public');
                $image =new Image();
                $image->description="";
                $image->url=$path;
                $image->post_id=$post->id;
                if($counter==0){
                    $image->featured=true;
                }else{
                    $image->featured=false;
                }
                $image->save();
                $counter++;

            }
        }

        return 'Post created!';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        
        return new PostResource(Post::findOrfail($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $post)
    {
        $post=Post::findOrfail($post);
        $this->PostUserCheck($post,'update');
        
        $post->update($request->all());
        return 'Post updated!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $post=Post::findOrfail($post);
        $this->PostUserCheck($post,' delete');
       
        $comments=Comment::where('post_id',$post->id)->get() ;
     
        foreach ($comments as $key => $value) {
            $value->delete();
        }

        $images=Image::where('post_id',$post->id)->get() ;
     
        foreach ($images as $key => $value) {
            $value->delete();
        }

        
        // $post->comments()->delete();
        // $post->images()->delete();
        $post->delete();
        return 'Post deleted';
    }

    public function PostUserCheck($post,$action){
        
        if(Auth::id() !== $post->author_id){
            throw new PostNotBelongsToUser($action);

        }
    }

}
