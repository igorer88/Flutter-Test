<?php

namespace App\Http\Controllers\Shared;


use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Tag\TagsResource;
use App\Modele\Tag;

class TagsMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TagResource::collection(Tag::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function posts($id)
    {
        return PostResource::collection(Tag::findOrfail($id)->posts()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->all());
        return 'Tag created!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($tag)
    {
        return TagResource::collection(Tag::findOrfail($tag));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TagRequest  $request
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $tag)
    {
        $tag=Tag::findOrfail($tag);
        $tag->update($request->all());
        return 'Tag updated!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag)
    {
        $tag=Tag::findOrfail($tag);
        $tag->delete();
        return 'Tag deleted';
    }
}
