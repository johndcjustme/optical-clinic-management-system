<?php

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



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', App\Http\Livewire\Pages\PageDashboard::class)->name('dashboard');
    Route::get('/patients', App\Http\Livewire\Pages\PagePatient::class);
    Route::get('/users', App\Http\Livewire\Pages\PageUsers::class);
    Route::get('/inventory/{subPage}', App\Http\Livewire\Pages\PageInventory::class);
    Route::get('/orders', App\Http\Livewire\Pages\PageOrders::class);
    Route::get('/appointments', App\Http\Livewire\Pages\PageAppointments::class);
    Route::get('/account', App\Http\Livewire\Pages\AccountSettings::class);
    Route::get('/patient-appt', App\Http\Livewire\Pages\PagePatientAppt::class);
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
