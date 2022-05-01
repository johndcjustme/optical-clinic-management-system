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




Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/dashboard', App\Http\Livewire\Pages\PageDashboard::class)->name('dashboard');
    Route::get('/patients', App\Http\Livewire\Pages\PagePatient::class);
    Route::get('/users', App\Http\Livewire\Pages\PageUsers::class);
    Route::get('/inventory', App\Http\Livewire\Pages\PageInventory::class);
    Route::get('/orders', App\Http\Livewire\Pages\PageOrders::class);
    // Route::get('/create-pdf', [App\Http\Controllers\UserController::class, 'index']);
    // Route::get('/preview-pdf/{code}', [App\Http\Controllers\PreviewPDF::class, 'index']);
    // Route::get('/download-pdf/{code}', [App\Http\Controllers\DownloadPDF::class, 'downloadPDF']);
    Route::get('/downloadpdf', [App\Http\Controllers\DownloadPDF::class, 'pdf']);
    Route::get('/appointments', App\Http\Livewire\Pages\PageAppointments::class);
    Route::get('/account', App\Http\Livewire\Pages\AccountSettings::class);
    Route::get('/reports', App\Http\Livewire\Pages\PageReports::class);
    // Route::get('/forum', App\Http\Livewire\Pages\PageForum::class);
    Route::get('/suppliers', App\Http\Livewire\Pages\PageSupplier::class);
});

Route::middleware(['auth', 'role:admin|user'])->group(function() {
    Route::get('/forum', App\Http\Livewire\Pages\PageForum::class);
});

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/book', App\Http\Livewire\Pages\PagePatientAppt::class)->name('book');
    // Route::get('/forum', App\Http\Livewire\Pages\PageForum::class);
});





// Route::middleware(['auth'])->group(function () {

//     Route::prefix('admin')->group(function() {
//         Route::get('/dashboard', App\Http\Livewire\Pages\PageDashboard::class)->name('dashboard');
//         Route::get('/patients', App\Http\Livewire\Pages\PagePatient::class);
//         Route::get('/users', App\Http\Livewire\Pages\PageUsers::class);
//         Route::get('/inventory', App\Http\Livewire\Pages\PageInventory::class);
//         Route::get('/orders', App\Http\Livewire\Pages\PageOrders::class);
//         // Route::get('/create-pdf', [App\Http\Controllers\UserController::class, 'index']);
//         // Route::get('/preview-pdf/{code}', [App\Http\Controllers\PreviewPDF::class, 'index']);
//         // Route::get('/download-pdf/{code}', [App\Http\Controllers\DownloadPDF::class, 'downloadPDF']);
//         Route::get('/downloadpdf', [App\Http\Controllers\DownloadPDF::class, 'pdf']);
//         Route::get('/appointments', App\Http\Livewire\Pages\PageAppointments::class);
//         Route::get('/account', App\Http\Livewire\Pages\AccountSettings::class);
//         Route::get('/reports', App\Http\Livewire\Pages\PageReports::class);
//         Route::get('/forum', App\Http\Livewire\Pages\PageForum::class);
//         Route::get('/suppliers', App\Http\Livewire\Pages\PageSupplier::class);

//     });



//     Route::prefix('user')->group(function () {
//     //     // Route::get('/users', function () {
//     //         // Matches The "/admin/users" URL
//             Route::get('/book', App\Http\Livewire\Pages\PagePatientAppt::class)->name('book');
//             Route::get('/forum', App\Http\Livewire\Pages\PageForum::class);
//     //     // });
//     });


// });

// Route::group(['middleware' => ['auth', 'role:user']], function () {
//     Route::get('/book', App\Http\Livewire\Pages\PagePatientAppt::class)->name('dashboard');
//     Route::get('/forum', App\Http\Livewire\Pages\PageForum::class);
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
