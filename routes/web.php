<?php

// dashboard controller
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\ContactController as DashboardContactController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\Dashboard\BlogController as DashboardBlogController;
use App\Http\Controllers\Dashboard\ProductsController as DashboardProductsController;

// website controller
use App\Http\Controllers\Website\AboutController;
use App\Http\Controllers\Website\BlogController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProductsController;

// illuminate
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
Route::redirect('/home', '/dashboard', 301);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardHomeController::class, 'index'])->name('dashboard-home');

        Route::group(['prefix' => 'contato'], function () {
            Route::get('/', [DashboardContactController::class, 'index'])->name('dashboard-contact');
            Route::get('visualizar/{id}', [DashboardContactController::class, 'show'])->name('dashboard-contact-show');
            Route::get('visualizar/tipo/{label}', [DashboardContactController::class, 'label'])->name('dashboard-contact-label');
            Route::get('cadastro', [DashboardContactController::class, 'create'])->name('dashboard-contact-create');
            Route::post('cadastrar', [DashboardContactController::class, 'store'])->name('dashboard-contact-store');
            Route::get('editar/{id}', [DashboardContactController::class, 'edit'])->name('dashboard-contact-edit');
            Route::post('atualizar/{id}', [DashboardContactController::class, 'update'])->name('dashboard-contact-update');
            Route::post('apagar/{id}', [DashboardContactController::class, 'destroy'])->name('dashboard-contact-destroy');
            Route::get('lidos', [DashboardContactController::class, 'read'])->name('dashboard-contact-read');
            Route::get('nao-lidos', [DashboardContactController::class, 'notRead'])->name('dashboard-contact-not-read');
        });

        Route::group(['prefix' => 'perfil'], function () {
            Route::get('/', [DashboardUserController::class, 'edit'])->name('dashboard-user');
            Route::post('/cadastrar', [DashboardUserController::class, 'store'])->name('dashboard-user-store');
            Route::post('/atualizar', [DashboardUserController::class, 'update'])->name('dashboard-user-update');
        });

        Route::group(['prefix' => "produtos"], function () {
            Route::get('/', [DashboardProductsController::class, 'index'])->name('dashboard-products');
            Route::get('/visualizar/{id}', [DashboardProductsController::class, 'edit'])->name('dashboard-products-edit');
            Route::get('/atualizar/{id}', [DashboardProductsController::class, 'update'])->name('dashboard-products-update');
            Route::get('/cadastro', [DashboardProductsController::class, 'create'])->name('dashboard-products-create');
            Route::post('/cadastrar', [DashboardProductsController::class, 'store'])->name('dashboard-products-store');
            Route::post('/apagar/{id}', [DashboardProductsController::class, 'destroy'])->name('dashboard-products-destroy');
        });

        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', [DashboardBlogController::class, 'index'])->name('dashboard-blog');
            Route::get('/cadastro', [DashboardBlogController::class, 'create'])->name('dashboard-blog-create');
            Route::post('/cadastrar', [DashboardBlogController::class, 'store'])->name('dashboard-blog-store');
            Route::get('/visualizar/{id}', [DashboardBlogController::class, 'edit'])->name('dashboard-blog-edit');
            Route::post('/atualizar/{id}', [DashboardBlogController::class, 'update'])->name('dashboard-blog-update');
            Route::post('/apagar/{id}', [DashboardBlogController::class, 'destroy'])->name('dashboard-blog-destroy');
        });
    });
});


Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/sobre', [AboutController::class, 'index'])->name('about');
    Route::get('/produtos', [ProductsController::class, 'index'])->name('products');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/contato', [ContactController::class, 'index'])->name('contact');
    Route::post('/contato', [ContactController::class, 'store'])->name('contact-store');
});

// Route::get('/password/{pass}', function ($pass) {
//     return Hash::make($pass);
// });
