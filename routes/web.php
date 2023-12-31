<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;



//Route::get('/', function () {
//    return view('admin.login');
//});

Route::get('/',[AuthController::class,'Login'])->name('admin.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::controller(AuthController::class)->group(function (){
    Route::get('/','Login')->name('admin.login');
    Route::post('/admin/login','authenticate')->name('admin.auth');
    Route::get('/admin/logout','AdminLogout')->name('admin.logout');
});
//End AuthController Group Function
Route::middleware('auth')->group(function () {
        Route::controller(AdminController::class)->group(function (){
            Route::get('/admin/dashboard','DashBoard')->name('admin.dashboard');
        });
});
//End AdminController Group Function


Route::middleware('auth')->group(function () {
Route::controller(ManagerController::class)->group(function (){

});
});
//End AdminController Group Function

