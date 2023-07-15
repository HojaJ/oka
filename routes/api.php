<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ParagraphController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\UnitController;
use Illuminate\Http\Request;
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
Route::post('suggest', [HomeController::class, 'store']);
Route::get('policy', [HomeController::class, 'policy']);
Route::get('units', [UnitController::class, 'units']);
//Route::get('unit/{unit}', [UnitController::class, 'show']);
Route::get('sections', [SectionController::class,'index']);
Route::get('paragraphs', [ParagraphController::class,'index']);
Route::get('pages', [PageController::class,'index']);


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
