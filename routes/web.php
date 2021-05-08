<?php

use App\Http\Controllers\MainController;
use App\Http\Livewire\Client\CartIndex;
use App\Http\Livewire\Intranet\Dashboard\AdminDashboard;
use App\Http\Livewire\Intranet\Reservations\ReservationIndex;
use App\Http\Livewire\Intranet\Salons\SalonIndex;
use App\Http\Livewire\Intranet\Salons\SalonShow;
use App\Http\Livewire\Intranet\Services\ServiceIndex;
use App\Http\Livewire\Intranet\Users\UserIndex;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [MainController::class, 'index'])->name('dashboard');

/**
 * INTRANET
 */
Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'intranet'], function () {

    Route::get('/', AdminDashboard::class)->name('intranet');

    Route::group(['as' => 'intranet.'], function () {
        Route::get('salons', SalonIndex::class)->name('salons.index');
        Route::get('salon/{salon}', SalonShow::class)->name('salon.show');

        Route::get('users', UserIndex::class)->name('users.index');
        Route::get('services', ServiceIndex::class)->name('services.index');
        Route::get('reservations', ReservationIndex::class)->name('reservations.index');
    });
});


/**
 * CLIENT
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('cart/add/{id}', [CartIndex::class, 'add'])->name('add.reservation');

    Route::get('salon/{id}', [MainController::class, 'showSalon'])->name('salon.show');
});
