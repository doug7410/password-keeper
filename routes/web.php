<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('apps')->middleware(['auth'])->group(function(){
    Route::get('/', [\App\Http\Controllers\AppsController::class, 'index'])->name('apps');
    Route::get('/create', [\App\Http\Controllers\AppsController::class, 'create'])->name('create_app');
    Route::get('/edit/{app}', [\App\Http\Controllers\AppsController::class, 'show'])->name('edit_app');
    Route::patch('/{app}', [\App\Http\Controllers\AppsController::class, 'update'])->name('update_app');
    Route::delete('/{app}', [\App\Http\Controllers\AppsController::class, 'delete'])->name('delete_app');
    Route::post('/store', [\App\Http\Controllers\AppsController::class, 'store'])->name('save_app');
});
