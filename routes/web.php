<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);


Route::resource('/user', UserController::class);


Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
});


Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/create', [ServiceController::class, 'create'])->name('create');
    Route::post('/store', [ServiceController::class, 'store'])->name('store');
    Route::get('/{services}/edit', [ServiceController::class, 'edit'])->name('edit');
    Route::get('/{services}/detail', [ServiceController::class, 'detail'])->name('detail');
    Route::put('/{services}', [ServiceController::class, 'update'])->name('update');
    Route::delete('/{services}', [ServiceController::class, 'destroy'])->name('destroy');
});


Route::prefix('requirement')->name('requirement.')->group(function () {
    Route::get('/', [RequirementController::class, 'index'])->name('index');
    Route::get('/create', [RequirementController::class, 'create'])->name('create');
    Route::post('/store', [RequirementController::class, 'store'])->name('store');
    Route::get('/{requirement}/edit', [RequirementController::class, 'edit'])->name('edit');
    Route::get('/{requirement}/detail', [RequirementController::class, 'detail'])->name('detail');
    Route::put('/{requirement}', [RequirementController::class, 'update'])->name('update');
    Route::delete('/{requirement}', [RequirementController::class, 'destroy'])->name('destroy');
});


Route::prefix('need')->name('need.')->group(function () {
    Route::get('/', [NeedController::class, 'index'])->name('index');
    Route::get('/create', [NeedController::class, 'create'])->name('create');
    Route::post('/store', [NeedController::class, 'store'])->name('store');
    Route::get('/{need}/edit', [NeedController::class, 'edit'])->name('edit');
    Route::put('/{need}', [NeedController::class, 'update'])->name('update');
    Route::delete('/{need}', [NeedController::class, 'destroy'])->name('destroy');
});


// Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
// Route::get('/kasir/detail', [KasirController::class, 'detail'])->name('kasir.detail');
// Route::get('/kasir/rincian', [KasirController::class, 'rincian'])->name('kasir.rincian');

// Route::resource('kasir', KasirController::class);
// Route::patch('kasir/{kasir}/status', [KasirController::class, 'updateStatus'])->name('kasir.updateStatus');



// Route::get('/kasir', [KasirController::class, 'index']);
Route::post('/kasir', [KasirController::class, 'store']);
Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index'); // Halaman utama kasir
Route::get('/kasir/detail', [KasirController::class, 'show'])->name('kasir.detail'); // Halaman daftar transaksi
Route::get('/rincian/{id}', [KasirController::class, 'rincian'])->name('kasir.rincian'); // Halaman rincian transaksi

Route::put('/kasir/{id}', [KasirController::class, 'update']);
Route::delete('/kasir/{id}', [KasirController::class, 'destroy']);

Route::patch('/kasir/{id}/status', [KasirController::class, 'updateStatus'])->name('kasir.updateStatus'); // Update status transaksi



Route::get('/api/services', [ServiceController::class, 'getServices']);


Route::get('/Accounting', [ExpensesController::class, 'index'])->name('accounting.index');
Route::post('/expenses/store/{id}', [ExpensesController::class, 'store'])->name('expenses.store');

Route::get('/Invoice', [InvoiceController::class, 'index'])->name('Invoice.index');
Route::get('/Invoice/detail', [InvoiceController::class, 'detail'])->name('Invoice.detail');

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/delete', [ProfileController::class, 'destroy'])->name('destroy');
});


require __DIR__ . '/auth.php';
