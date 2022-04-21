<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Servant;
use Illuminate\Http\Request;

class SalesController extends Controller
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
        $sales = Sales::orderBy("created_at","DESC")->paginate(10);
        return view("sales.index")->with([
            "sales" => $sales
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
        $request->validate([
            "table_id"          =>"required",
            "menu_id"           =>"required",
            "servant_id"        =>"required",
            "quantity"          =>"required|numeric",
            "total_price"       =>"required|numeric",
            "total_received"    =>"required|numeric",
            "change"            =>"required|numeric",
            "payment_type"      =>"required",
            "payment_status"    =>"required",
        ]);
        //create ventes
        $sale = Sales::create([
           "servant_id"        =>$request->servant_id,
            "table_id"             =>$request->table_id,
           "menu_id"              =>$request->menu_id,
           "quantity"             =>$request->quantity,
           "total_price"          =>$request->total_price,
            "total_received"    =>$request->total_received,
            "change"            =>$request->change,
            "payment_type"      =>$request->payment_type,
            "payment_status"    =>$request->payment_status,
        ]);
       //create par des relations menu & table
       $sale->menus()->sync($request->menu_id);
       $sale->tables()->sync($request->table_id);
       return redirect()->back()->with([
           "success" => "Vente effectue avec succés"
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //get sale to update
         $sales = Sales::findOrFail($id);
        //get sale tables
         $tables = $sales->tables()->where("sales_id",$sales->id)->get();
         //get sale menus
         $menus = $sales->menus()->where("sales_id",$sales->id)->get();
         return view('sales.edit')->with([
            "tables"       =>$tables,
            "menus"        =>$menus,
            "servants"     =>Servant::all(),
            "sales"        =>$sales
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       //validation
        $request->validate([
            "table_id"          =>"required",
            "menu_id"           =>"required",
            "servant_id"        =>"required",
            "quantity"          =>"required|numeric",
            "total_price"       =>"required|numeric",
            "total_received"    =>"required|numeric",
            "change"            =>"required|numeric",
            "payment_type"      =>"required",
            "payment_status"    =>"required",
        ]);
        //get sale to update
        $sale = Sales::findOrFail($id);
        //update ventes
        $sale->update([
           "servant_id"        =>$request->servant_id,
            "table_id"             =>$request->table_id,
           "menu_id"              =>$request->menu_id,
           "quantity"             =>$request->quantity,
           "total_price"          =>$request->total_price,
            "total_received"    =>$request->total_received,
            "change"            =>$request->change,
            "payment_type"      =>$request->payment_type,
            "payment_status"    =>$request->payment_status,
        ]);
       //create par des relations menu & table
       $sale->menus()->sync($request->menu_id);
       $sale->tables()->sync($request->table_id);
       return redirect()->back()->with([
           "success" => "Vente effetué avec succés"
       ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get sale to delete
        $sale = Sales::findOrFail($id);
        //delete sales
        $sale->delete();
        return redirect()->back()->with([
            "success" => "Paiment Supprimé avec succés"
        ]);
    }
}
