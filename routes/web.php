<?php

use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagersController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\RegionsController;
use App\Http\Controllers\Admin\ZonesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
   return redirect()->route('login');
});

Auth::routes();
Route::get('/home', function(){
   return redirect()->route('admin.dashboard.index');

})->name('home');
Route::middleware(["auth"])->name("admin.")->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    Route::name("regions.")->middleware("superadmin")->prefix("/regions")->group(function () {
        Route::get('/', [RegionsController::class, 'index'])->name('index');
        Route::post('/create', [RegionsController::class, 'create'])->name('create');
        Route::post('/update/{id}', [RegionsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [RegionsController::class, 'delete'])->name('delete');
    });

    Route::name("zones.")->middleware("superadmin")->prefix("/zones")->group(function () {
        Route::get('/', [ZonesController::class, 'index'])->name('index');
        Route::post('/create', [ZonesController::class, 'create'])->name('create');
        Route::post('/update/{id}', [ZonesController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ZonesController::class, 'delete'])->name('delete');
    });

    Route::name("managers.")->middleware("superadmin")->prefix("/managers")->group(function () {
        Route::get('/', [ManagersController::class, 'index'])->name('index');
        Route::post('/create', [ManagersController::class, 'create'])->name('create');
        Route::post('/update', [ManagersController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ManagersController::class, 'delete'])->name('delete');
    });
    
    Route::name("profile.")->prefix("/profile")->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
    });

    Route::name("members.")->prefix("/members")->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('index');
        Route::get('/all', [MemberController::class, 'getMembers'])->name('getMembers');
        Route::post('/create', [MemberController::class, 'create'])->name('create');
        Route::post('/export/{id}', [MemberController::class, 'export'])->name('export');
        Route::get('/get-zones/{id}', [MemberController::class, 'zones'])->name('zones');
        Route::post('/update/{id}', [MemberController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [MemberController::class, 'delete'])->name('delete');
    });
    
    Route::get('/logout', [AreasController::class, 'logout'])->name('logout');
});

Route::get('/logout', function () {
   Auth::logout();
   return redirect()->route('login');
})->name("admin.logout");
Auth::routes();
