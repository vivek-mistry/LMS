<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\CustomerComponent;
use App\Http\Livewire\Login;
use App\Http\Livewire\OrderComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('welcome', [WelcomeController::class, 'index']);

Route::get('login', Login::class);

Route::get('logout', [Login::class, 'logout'])->name('logout');

Route::get('customers', CustomerComponent::class)->name('customers')->middleware('auth');

Route::get('orders', OrderComponent::class)->name('orders')->middleware('auth');
