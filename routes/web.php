<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(["register"=> false,"reset" => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource("categories","CategoryController");
Route::resource("tables","TableController");
Route::resource("servants","ServantController");
Route::resource("menus","MenuController");
Route::resource("payments","PaymentController");
Route::resource("sales","SalesController");
Route::get("reports","ReportController@index")->name("reports.index");
Route::get("reports/generate","ReportController@generate")->name("reports.generate");
Route::post("reports/export","ReportController@export")->name("reports.export");
Route::post("reports/exporttopdf","ReportController@exporttopdf")->name("reports.exporttopdf");

