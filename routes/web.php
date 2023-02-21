<?php

// dashboard controller
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\ContactController as DashboardContactController;

// website controller
use App\Http\Controllers\Website\HomeController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardHomeController::class, 'index'])->name('dashboard-home');

        Route::group(['prefix' => 'contato'], function () {
            Route::get('/', [DashboardContactController::class, 'index'])->name('dashboard-contact');
            Route::get('/visualizar/{id}', [DashboardContactController::class, 'show'])->name('dashboard-contact-show');
            Route::get('/visualizar/tipo/{label}', [DashboardContactController::class, 'label'])->name('dashboard-contact-label');
            Route::get('/visualizar/lidos', [DashboardContactController::class, 'read'])->name('dashboard-contact-read');
            Route::get('/visualizar/nao-lidos', [DashboardContactController::class, 'notRead'])->name('dashboard-contact-not-read');
            Route::get('/cadastro', [DashboardContactController::class, 'create'])->name('dashboard-contact-create');
            Route::post('/cadastrar', [DashboardContactController::class, 'store'])->name('dashboard-contact-store');
            Route::get('/editar/{id}', [DashboardContactController::class, 'edit'])->name('dashboard-contact-edit');
            Route::post('/atualizar/{id}', [DashboardContactController::class, 'update'])->name('dashboard-contact-update');
            Route::post('/apagar/{id}', [DashboardContactController::class, 'destroy'])->name('dashboard-contact-destroy');
        });
    });
});


Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

// Route::get('dashboard-home', [DashboardHomeController::class, 'index'])->name('dashboard-home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/password/{pass}', function ($pass) {
    return Hash::make($pass);
});
