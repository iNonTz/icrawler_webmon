<?php

use App\Http\Controllers\iCrawlerController;
use App\Http\Controllers\MonitorController;
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
//Route::get('welcome/', function () {
//    return view('welcome');
//});

Route::get('/', [MonitorController::class, 'showIndex'])->name('index');
Route::get('crawler/', [MonitorController::class, 'crawler'])->name('crawler');
Route::get('/crawler_tools/', [MonitorController::class, 'crawlerTools'])->name('crawl-tools');
Route::post('/crawler_tools/', [MonitorController::class, 'crawlerTools'])->name('crawl-tools');


