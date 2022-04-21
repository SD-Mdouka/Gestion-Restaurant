<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("Managments.Categories.index")->with([
           "categories" =>Category::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Managments.Categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            "title" =>"required|min:3"
        ]);
        //ajoute category
        $title = $request->title;
        Category::create([
            "title" =>$title,
            "slug"  =>Str::slug($title)
        ]);
       return redirect()->route("categories.index")->with([
           "success" => "Categorie ajoutée avec succés"
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view("Managments.Categories.edit")->with([
            "category"=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
         //validate
         $request->validate([
            "title" =>"required|min:3"
        ]);
        //ajoute category
        $title = $request->title;
        $category->update([
            "title" =>$title,
            "slug"  =>Str::slug($title)
        ]);
       return redirect()->route("categories.index")->with([
           "success" => "Categorie modifiée avec succés"
       ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //delete cat
        $category->delete();
       return redirect()->route("categories.index")->with([
           "success" => "Categorie supprimée avec succés"
       ]);
    }
}
