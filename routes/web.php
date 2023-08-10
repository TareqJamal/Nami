<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCRUDController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\LaravelLocalization;

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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(
    [
        'prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
    Route::controller(AdminController::class)->group(function ()
    {
        Route::get('/admins','index')->name('admins');
        Route::get('/admins/data','admins_data')->name('admins_data');

    });

    Route::controller(CRUDController::class)->group(function ()
    {
        Route::post('/admins/store','store')->name('admin.store');
        Route::post('/admins/delete','delete')->name('admin.delete');
        Route::post('/admin/edit','edit')->name('admin.edit');
        Route::post('/admin/update','update')->name('admin.update');

    });

    Route::controller(AuthController::class)->group(function ()
    {
        Route::get('/','login')->name('admin.login');
        Route::post('/admin/check/login','check')->name('admin.check');

    });
    Route::controller(ProductController::class)->group(function ()
    {
        Route::get('/products','index')->name('products');
        Route::get('/products/datatable','products_data')->name('products_data');

    });
    Route::controller(ProductCRUDController::class)->group(function ()
    {
        Route::post('/product/store','store')->name('product.store');
        Route::post('/product/delete','delete')->name('product.delete');
        Route::post('/product/edit','edit')->name('product.edit');
        Route::post('/product/update/{id}','update')->name('product.update');
    });
});






