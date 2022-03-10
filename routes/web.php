<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

// Route::get('/', function () {
//     return view('livewire.show-posts');
// });

Route::view("/", 'welcome');

Route::post('user',[UserController::class, 'testRequest']);

// Route::get('/landing', App\Http\Livewire\Pages\PageLanding::class);
Route::get('/page/{view}', App\Http\Livewire\Pages\PageLogin::class);
    // ->middleware('isLoggedIn');
Route::get('/users', App\Http\Livewire\Pages\PageUsers::class);
Route::get('/dashboard', App\Http\Livewire\Pages\PageDashboard::class)->middleware('isNotLoggedIn');
Route::get('/patients', App\Http\Livewire\Pages\PagePatient::class);
Route::get('/inventory', App\Http\Livewire\Pages\PageInventory::class);
Route::get('/orders', App\Http\Livewire\Pages\PageOrders::class);
Route::get('/appointments', App\Http\Livewire\Pages\PageAppointments::class);
Route::get('/account', App\Http\Livewire\Pages\AccountSettings::class);


Route::get('/logout', function(){
    if(session()->has('curr_user_id')) {
        session()->flush();
    }
    return redirect('page/login');
});


