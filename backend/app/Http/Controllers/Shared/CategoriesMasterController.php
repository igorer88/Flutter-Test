<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoriesResource;
use App\Http\Resources\Category\CategoryResource;
use App\Modele\Category;
use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\Post\PostResource;

class CategoriesMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  CategoryResource::collection(Category::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        Category::create($request->all());
        return 'Category created!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CategoryResource(Category::findOrfail($id));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function posts($id)
    {
        return PostResource::collection(Category::findOrfail($id)->posts()->paginate());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request,$category)
    {
        $category=Category::findOrfail($category);
        $category->update($request->all());
        return 'Category updated!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findOrfail($id);
        $category->delete();
        return 'Category deleted';
    }
}
