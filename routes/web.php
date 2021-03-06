<?php

use App\Http\Controllers\MainController;
use App\Http\Livewire\Client\ReservationAvailability;
use App\Http\Livewire\Client\SalonShow as ClientSalonShow;
use App\Http\Livewire\Client\SalonsIndex;
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

/**
 * GUEST
 */
Route::view('/', 'welcome')->name('welcome');
Route::get('salons/{category}', SalonsIndex::class)->name('salons');
Route::get('salon/{salonId}', ClientSalonShow::class)->name('salon.show'); // SalonShow::class
Route::get('reservation/availability/{salon}', ReservationAvailability::class)->name('availability');
Route::post('register-salon', [MainController::class, 'storeSalon'])->name('store.salon');
Route::get('register-salon/create', [MainController::class, 'createSalon'])->name('create.salon');


/**
 * LOGGED IN (CLIENT)
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

});

/**
 * INTRANET
 */
Route::group(['middleware' => ['auth:sanctum', 'verified', 'intranetRoles'], 'prefix' => 'intranet'], function () {
    // Dashboards
    Route::get('/', AdminDashboard::class)->name('intranet');
    // Salons
    Route::get('salons', SalonIndex::class)->name('intranet.salons.index');
    Route::get('salon/{salon}', SalonShow::class)->name('intranet.salon.show');
    // Services
    Route::get('services', ServiceIndex::class)->name('intranet.services.index');
    // Reservations
    Route::get('reservations', ReservationIndex::class)->name('intranet.reservations.index');
    // Users
    Route::get('users', UserIndex::class)->name('intranet.users.index')->middleware('role:admin');
});
