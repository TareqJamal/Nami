<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CRUDController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::controller(AdminController::class)->group(function ()
{
    Route::get('/admins','index')->middleware(['auth:admin'])->name('admins');
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
     Route::get('/login/admin','login')->name('admin.login');
     Route::post('/admin/check/login','check')->name('admin.check');

 });




