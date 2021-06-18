<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Shared\CategoriesMasterController;
use App\Http\Requests\CategoriesRequest;
use App\Modele\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $masterController;

    public function __construct()
    {
        $this->masterController = new CategoriesMasterController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.categories')->with('categories', $this->masterController->index());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('categories.create_category')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        return redirect()->route('categories.categories')->with('message', $this->masterController->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modele\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        return view('categories.category')->with('category', $this->masterController->show($category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modele\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $category = Category::findOrfail($category);

        return view('categories.edit_category')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modele\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $category)
    {
        return redirect()->route('categories.categories')->with('message', $this->masterController->update($request, $category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modele\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        return redirect()->route('categories.categories')->with('message', $this->masterController->destroy($category));
    }
}
