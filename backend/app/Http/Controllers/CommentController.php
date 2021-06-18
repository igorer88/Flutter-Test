<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Shared\CommentsMasterController;
use App\Http\Requests\CommentRequest;
use App\Modele\Comment;
use App\Modele\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $masterController;

    public function __construct()
    {
        $this->masterController=new CommentsMasterController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post)
    {
        return view('comments.comments')->with('comments',$this->masterController->index($post));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post)
    {
        return view('comments.create_comment')->with('post',Post::findOrfail($post));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request,$post)
    {
        return redirect()->back()->with('message', $this->masterController->store($request,$post));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $comment
     * @return \Illuminate\Http\Response
     */
    public function show( $post, $comment)
    {
        return view('comments.comment')->with('comment', $this->masterController->show($post,$comment));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit( $comment)
    {
        $comment=Comment::findOrfail($comment);
        
        return view('comments.edit_comment')->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @param  int  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post,$comment)
    {
        return redirect()->route('comments.comments')->with('message', $this->masterController->update($request,$post,$comment));
    }

    /**
     * Remove the specified resource from storage.
     *@param  int  $post
     * @param  int  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($post, $comment)
    {
        return redirect()->back()->with('message', $this->masterController->destroy($post,$comment));
    }


}
