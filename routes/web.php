<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return view('index');
});



Route::resource('/user', UserController::class);
Route::resource('customer', CustomerController::class);
Route::resource('vehicle', VehicleController::class);


Route::resource('spare_part', SparepartController::class);
Route::resource('transaction', TransactionController::class);
Route::resource('history', TransactionController::class);


