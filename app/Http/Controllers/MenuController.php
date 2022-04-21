<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        return view("Managments.menus.index")->with([
            "menus"         =>Menu::paginate(5),
            "categories"    =>Category::paginate(5)
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
        return view("Managments.menus.create")->with([
            "categories" =>Category::all()
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         //validate
         $request->validate([
            "title"         =>"required|min:3|unique:menus,title",
            "description"   =>"required|min:5",
            "image"         =>"required|image|mimes:png,jpg,jpeg|max:2048",
            "price"         =>"required|numeric",
            "category_id"   =>"required|numeric",
        ]);
        if($request->hasfile("image")){
            $file = $request->image;
            $imageName = time() . "_" .$file->getClientOriginalName();
            $file->move(public_path('images/menus'),$imageName);
              //ajoute category
            $title = $request->title;
            Menu::create([
                "title"         =>$title,
                "slug"          =>Str::slug($title),
                "description"   =>$request->description,
                "price"         =>$request->price,
                "category_id"   =>$request->category_id,
                "image"         => $imageName
            ]);
            return redirect()->route("menus.index")->with([
                "success" => "Menu ajoutée avec succés"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
        return view("Managments.menus.edit")->with([
            "categories" =>Category::all(),
            "menu" =>  $menu
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
          //validate
          $request->validate([
            "title"         =>"required|min:3|unique:menus,title,".$menu->id,
            "description"   =>"required|min:5",
            "image"         =>"image|mimes:png,jpg,jpeg|max:2048",
            "price"         =>"required|numeric",
            "category_id"   =>"required|numeric",
        ]);
        if($request->hasfile("image")){
            unlink(public_path('images/menus' . $menu->image));
            $file = $request->image;
            $imageName = time() . "_" .$file->getClientOriginalName();
            $file->move(public_path('images/menus'),$imageName);
            //ajoute category
            $title = $request->title;
            $menu->update([
                "title"         =>$title,
                "slug"          =>Str::slug($title),
                "description"   =>$request->description,
                "price"         =>$request->price,
                "category_id"   =>$request->category_id,
                "image"         => $imageName
                ]);
            return redirect()->route("menus.index")->with([
                "success" => "Menu modifier avec succés"
            ]);
        }else{
            $title = $request->title;
            $menu->update([
                "title"        =>$title,
                "slug"         =>Str::slug($title),
                "description"  =>$request->description,
                "price"        =>$request->price,
                "category_id"  =>$request->category_id,
                ]);
                return redirect()->route("menus.index")->with([
                    "success" => "Menu modifier avec succés"
                ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //Remove Image
        unlink(public_path('images/menus' . $menu->image));
        $menu->delete();
        return redirect()->route("menus.index")->with([
            "success" => "Menu supprimée avec succés"
        ]);
    }
}
