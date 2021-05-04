<?php

use App\Http\Livewire\Intranet\Dashboard\AdminDashboard;
use App\Http\Livewire\Intranet\Salons\SalonIndex;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('intranet', AdminDashboard::class)->name('intranet');

    Route::get('intranet/salons', SalonIndex::class)->name('salon-index');
    Route::get('intranet/users', UserIndex::class)->name('user-index');
});
