<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\KasirController;


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::resource('/user', UserController::class);

// Route untuk Category
Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
});

// Route untuk Services
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/create', [ServiceController::class, 'create'])->name('create');
    Route::post('/store', [ServiceController::class, 'store'])->name('store');
    Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
    Route::get('/{id}/detail', [ServiceController::class, 'detail'])->name('detail');
    Route::put('/{service}', [ServiceController::class, 'update'])->name('update');
    Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');
});

// Route untuk Requirement
Route::prefix('requirement')->name('requirement.')->group(function () {
    Route::get('/', [RequirementController::class, 'index'])->name('index');
    Route::get('/create', [RequirementController::class, 'create'])->name('create');
    Route::post('/store', [RequirementController::class, 'store'])->name('store');
    Route::get('/{requirement}/edit', [RequirementController::class, 'edit'])->name('edit');
    Route::get('/{requirement}/detail', [RequirementController::class, 'detail'])->name('detail');
    Route::put('/{requirement}', [RequirementController::class, 'update'])->name('update');
    Route::delete('/{requirement}/destroy', [RequirementController::class, 'destroy'])->name('destroy');
});

// Route untuk Need
Route::prefix('need')->name('need.')->group(function () {
    Route::get('/', [NeedController::class, 'index'])->name('index');
    Route::get('/create', [NeedController::class, 'create'])->name('create');
    Route::post('/store', [NeedController::class, 'store'])->name('store');
    Route::get('/{need}/edit', [NeedController::class, 'edit'])->name('edit');
    Route::put('/{need}', [NeedController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [NeedController::class, 'destroy'])->name('destroy');
});

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


Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');





Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index'); // Tambahkan ini
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/delete', [ProfileController::class, 'destroy'])->name('destroy');
});


// Route untuk Register
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';
});