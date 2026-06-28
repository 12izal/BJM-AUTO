<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\HomepageBannerController;

/*
|--------------------------------------------------------------------------
| FRONTEND (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index'])
    ->name('home');

Route::get('/mobil/{product}', [FrontendController::class, 'detail'])
    ->name('frontend.detail');

/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('login.authenticate');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Product
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/product',
        ProductController::class
    );

    Route::delete(
        '/admin/product/image/{image}',
        [ProductController::class, 'destroyImage']
    )->name('product.image.destroy');

    Route::put(
        '/admin/product/image/{image}/cover',
        [ProductController::class, 'setCover']
    )->name('product.image.cover');

    /*
    |--------------------------------------------------------------------------
    | Homepage Banner
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/banner',
        HomepageBannerController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Company Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/company',
        [CompanyProfileController::class, 'index']
    )->name('company.index');

    Route::put(
        '/admin/company',
        [CompanyProfileController::class, 'update']
    )->name('company.update');

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/user',
        UserController::class
    );

});