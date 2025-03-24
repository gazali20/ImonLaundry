<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\NeedController;
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
