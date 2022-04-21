<?php

namespace App\Http\Controllers;

use App\Servant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ServantController extends Controller
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
        return view("Managments.serveurs.index")->with([
            "servants" =>Servant::paginate(5)
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
        return view("Managments.serveurs.create");

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
            "name" =>"required|min:3",
        ]);
        //ajoute category
        Servant::create([
            "name" =>$request->name,
            "address"  =>$request->address,
        ]);
       return redirect()->route("servants.index")->with([
           "success" => "Serveurs ajoutée avec succés"
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function show(Servant $servant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function edit(Servant $servant)
    {
        //
        return view("Managments.serveurs.edit")->with([
            "servants"=>$servant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servant $servant)
    {
        //
          //validate
          $request->validate([
            "name" =>"required|min:3",
        ]);
        //update category
        $servant->update([
            "name" =>$request->name,
            "address"  =>$request->address,
        ]);
       return redirect()->route("servants.index")->with([
           "success" => "Serveurs modifié avec succés"
       ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servant $servant)
    {
        //
        $servant->delete();
        return redirect()->route("servants.index")->with([
            "success" => "serveurs supprimée avec succés"
        ]);
    }
}
