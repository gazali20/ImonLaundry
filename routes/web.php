<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;



Route::get('/', function () {
    return view('index');
});



Route::resource('/user', UserController::class);

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create']);
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('category/{category}/edit', [UserController::class, 'edit'])->name('category.edit');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');


