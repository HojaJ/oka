<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParagraphController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SuggestController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VersionController;
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

Route::redirect('/', 'dashboard');

Route::group(['middleware' => 'auth:web'], function(){
    Route::get('/dashboard', function() { return view('dashboard.dashboard', [
        'version' => \App\Models\Version::first()
    ]); })->name('dashboard');

    Route::put('version_start', [VersionController::class, 'switch'])->name('version_start');
    Route::put('version_clear', [VersionController::class, 'clear'])->name('version_clear');

    Route::resource('/admin_user', AdminController::class);
    Route::resource('/policy', PolicyController::class)->except(['store', 'delete']);
    Route::resource('/suggest', SuggestController::class)->only(['index', 'destroy']);
    Route::resource('/image', ImageController::class);

    Route::resource('/page', PageController::class);
    Route::put('/page_/{page}',[PageController::class,'update_'])->name('page.update_');
    Route::post('/page_bulk', [PageController::class,'bulk_add'])->name('page.bulkadd');
    Route::put('/page_edit/{page}', [PageController::class,'page_edit'])->name('page.page_edit');
    Route::delete('/page_remove', [PageController::class,'bulk_remove'])->name('page.remove');

    Route::resource('/section', SectionController::class);
    Route::post('/section_bulk', [SectionController::class,'bulk_add'])->name('section.bulkadd');
    Route::put('/section_e/{section}', [SectionController::class,'page_edit'])->name('section.page_edit');
    Route::delete('/section_remove', [SectionController::class,'bulk_remove'])->name('section.remove');

    Route::resource('/unit', UnitController::class);
    Route::put('/unit_edit/{unit}', [UnitController::class,'page_edit'])->name('unit.unit_edit');

    Route::resource('paragraph', ParagraphController::class);
    Route::put('/paragraph_e/{paragraph}', [ParagraphController::class,'page_edit'])->name('paragraph.paragraph_edit');
    Route::post('/mark-as-read', [HomeController::class, 'markNotification'])->name('admin.markNotification');
});

require __DIR__.'/auth.php';
