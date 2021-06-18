<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Shared\TagsMasterController;
use App\Http\Requests\TagRequest;
use App\Modele\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $masterController;

    public function __construct()
    {
        $this->masterController=new TagsMasterController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.tags')->with('tags', $this->masterController->index());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create_tag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        return redirect()->route('tags.tags')->with('message', $this->masterController->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($tag)
    {
        return view('tags.tag')->with('tag', $this->masterController->show($tag));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($tag)
    {
        $tag=Tag::findOrfail($tag);
        
        return view('tags.edit_tag')->with('tag', $tag);
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
        return redirect()->route('tags.tags')->with('message', $this->masterController->update($request,$tag));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag)
    {
        return redirect()->route('tags.tags')->with('message', $this->masterController->destroy($tag));
    }
}
