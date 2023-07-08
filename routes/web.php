<?php

use App\Http\Controllers\DashboardClientController;
use App\Http\Controllers\DashboardOrderController;
use App\Http\Controllers\DashboardProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/home', function() {
    return view('login.index', [
        'tittle' => 'Login'
    ]);
});


Route::get('/', [LoginController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
    return view('dashboard.index');
})->middleware('auth');

Route::resource('/dashboard/clients', DashboardClientController::class)->middleware('auth');

Route::resource('/dashboard/orders', DashboardOrderController::class)->middleware('auth');


Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard/orders/{order}', [DashboardOrderController::class, 'show'])->name('orders.show');
    Route::get('/dashboard/orders/{order}/details/create', [DashboardOrderController::class, 'createDetail'])->name('orders.create-detail');
    Route::post('/dashboard/orders/{order}/details', [DashboardOrderController::class, 'storeDetail'])->name('orders.store-detail');
    Route::get('/dashboard/orders/{order}/details/{detail}/edit', [DashboardOrderController::class, 'editDetail'])->name('orders.edit-detail');
    Route::put('/dashboard/orders/{order}/details/{detail}', [DashboardOrderController::class, 'updateDetail'])->name('orders.update-detail');
    Route::delete('/dashboard/orders/{order}/details/{detail}', [DashboardOrderController::class, 'destroyDetail'])->name('orders.destroy-detail');
});

Route::get('/dashboard/reports', [DashboardOrderController::class, 'report'])->name('orders.report')->middleware('auth');

Route::get('/dashboard/pdf', [DashboardOrderController::class, 'pdf'])->middleware('auth');






// Route::resource('/dashboard/projects', DashboardProjectController::class)->middleware('auth');
// Route::get('/dashboard/projects/pdf', [DashboardProjectController::class, 'pdf'])->middleware('auth');
// Route::get('/dashboard/pdf', [DashboardProjectController::class, 'pdf'])->middleware('auth');

// Route::get('/dashboard/projects/cetak_pdf', 'DashboardProjectController@cetak_pdf')->name('cetakprojects')->middleware('auth');
