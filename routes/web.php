<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Back\ProfileController;
use App\Http\Controllers\Back\PasswordController;
use App\Http\Controllers\Back\StaffsController;
use App\Http\Controllers\Back\CategoriesController;
use App\Http\Controllers\Back\BrandsController;
use App\Http\Controllers\Back\ProductsController;
use App\Http\Controllers\Front\PagesController;
use App\Http\Controllers\Front\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('cms')->name('back.')->group(function() {

    Route::middleware('auth:cms')->group(function() {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('back.dashboard.index');

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::controller(ProfileController::class)->group(function() {
            Route::get('profile', 'edit')->name('profile.edit');

            Route::post('profile', 'update')->name('profile.update');

        });

        Route::controller(PasswordController::class)->group(function() {
            Route::get('password', 'edit')->name('password.edit');

            Route::post('password', 'update')->name('password.update');

        });

        Route::resource('/staffs', StaffsController::class)->except(['show'])->middleware('admin');

        Route::resources([
            'categories' => CategoriesController::class,
            'brands' => BrandsController::class,
            'products' => ProductsController::class,
        ], [
            'except' => ['show']
        ]);

        Route::get('/products/{product}/image/{filename}', [ProductsController::class, 'image'])->name('products.image');


    });
    
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.show');

    Route::post('login', [LoginController::class, 'login'])->name('login.login');
});

Route::name('front.')->group(function() {

    Route::get('/category/{category}', [PagesController::class, 'category'])->name('pages.category');

    Route::get('/brand/{brand}', [PagesController::class, 'brand'])->name('pages.brand');

    Route::get('/product/{product}', [PagesController::class, 'product'])->name('pages.product');

    Route::get('/search', [PagesController::class, 'search'])->name('pages.search');

    Route::get('/', [PagesController::class, 'home'])->name('pages.home');

    Route::controller(CartController::class)->group(function() {
        Route::get('/cart', 'index')->name('cart.index');
        Route::match(['put', 'patch'], '/cart', 'update')->name('cart.update');
        Route::get('/cart/{product}', 'destroy')->name('cart.destroy');
        Route::post('/cart/{product}/{qty?}', 'store');
    });

});

Auth::routes();
