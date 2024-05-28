<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ParagraphController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\UnitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('home', [SectionController::class,'index']);
Route::get('units', [UnitController::class, 'units']);
Route::get('units/{id}', [UnitController::class, 'show']);

Route::get('paragraphs/{id}', [ParagraphController::class,'index']);

Route::get('pages', [PageController::class,'index']);
Route::get('pages/{id}', [PageController::class,'show']);


Route::post('suggest', [HomeController::class, 'store']);
Route::get('policy', [HomeController::class, 'policy']);

Route::get('version', [PageController::class,'version']);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
