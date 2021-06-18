<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Comment\CommentsResource;
use App\Modele\Comment;
use App\Modele\Post;

class CommentsMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post)
    {
        return CommentResource::collection($post->comments->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest   $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request,$id)
    {
        $comment =new Comment();
        $comment->author_id= Auth::user()->getAuthIdentifier();
        $comment->content= $request->content;
        Post::findOrfail($id)->comments()->save($comment);
        return 'Comment created!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post,$id)
    {
        return CommentResource::collection(Post::findOrfail($post)->comments()->findOrfail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $post,$id)
    {
        //$comment=Comment::findOrfail($id);
        Post::findOrfail($post)->comments()->findOrfail($id)->update($request->all());
        return 'Comment updated!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post,$id)
    {
        //$comment=Comment::findOrfail($id);
        Post::findOrfail($post)->comments()->findOrfail($id)->delete();
        return 'Comment deleted';
    }
}
