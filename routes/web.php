<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\ActivityComponent;
use App\Http\Livewire\CustomerComponent;
use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\Login;
use App\Http\Livewire\OrderComponent;
use App\Http\Livewire\ReceiptComponent;
use App\Http\Livewire\Stock;
use App\Http\Livewire\TrashedOrders;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('welcome', [WelcomeController::class, 'index']);

Route::get('/', Login::class)->name('sign_in');

Route::get('logout', [Login::class, 'logout'])->name('logout');

Route::get('customers', CustomerComponent::class)->name('customers')->middleware('auth');

Route::get('orders', OrderComponent::class)->name('orders')->middleware('auth');

Route::get('stock', Stock::class)->name('stocks')->middleware('auth');

Route::get('dashboard', DashboardComponent::class)->name('dashboard')->middleware('auth');

Route::get('receipt', ReceiptComponent::class)->name('receipt')->middleware('auth');

Route::get('trashed-orders', TrashedOrders::class)->name('trashed_orders')->middleware('auth');

Route::get('activity-logs', ActivityComponent::class)->name('activity_logs')->middleware('auth');
