<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequirementController;


Route::get('/', function () {
    return view('index');
});



Route::resource('/user', UserController::class);

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create']);
Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{category}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');




Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{services}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::get('/services/{id}/detail', [ServiceController::class, 'detail'])->name('services.detail');
Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
Route::get('/services/{id}/detail', [ServiceController::class, 'show'])->name('services.show');
Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');

Route::get('/requirement', [RequirementController::class, 'index'])->name('requirement.index');
Route::get('/requirement/{requirement}/edit', [RequirementController::class, 'edit'])->name('requirement.edit');









