<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\NeedController;



Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return view('login');
})->name('login');


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
Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');

Route::get('/requirement', [RequirementController::class, 'index'])->name('requirement.index');
Route::get('/requirement/create', [RequirementController::class, 'create'])->name('requirement.create');
Route::post('/requirement/store', [RequirementController::class, 'store'])->name('requirement.store');
Route::get('/requirement/{requirement}/edit', [RequirementController::class, 'edit'])->name('requirement.edit');
Route::get('/requirement/{requirement}/detail', [RequirementController::class, 'detail'])->name('requirement.detail');
Route::put('/requirement/{requirement}', [RequirementController::class, 'update'])->name('requirement.update');
Route::delete('/requirement/{requirement}/destroy', [RequirementController::class, 'destroy'])->name('requirement.destroy');



Route::get('/need', [NeedController::class, 'index'])->name('need.index');
Route::get('/need/create', [NeedController::class, 'create']);
Route::get('/need/{need}/edit', [NeedController::class, 'edit'])->name('need.edit');
Route::post('/need/store', [NeedController::class, 'store'])->name('need.store');
Route::put('/need/{need}', [NeedController::class, 'update'])->name('need.update');
Route::delete('/need/{id}/destroy', [NeedController::class, 'destroy'])->name('need.destroy');







Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';