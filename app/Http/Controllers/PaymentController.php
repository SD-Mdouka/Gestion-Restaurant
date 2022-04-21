<?php

namespace App\Http\Controllers;

use App\Table;
use App\Servant;
use App\Category;
use App\Menu;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
   public function index()
   {
    return view('payments.index')->with([
        "categories"    =>Category::all(),
        "tables"        =>Table::all(),
        "servants"      =>Servant::all()
    ]);
   }
}
