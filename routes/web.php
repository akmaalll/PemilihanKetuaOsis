<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KetosController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NilaiKetosController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SawMethodController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TodoController;
use App\Http\Controllers\Admin\UserMenuController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController as Auths;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{any}', [App\Http\Controllers\PagesController::class, 'index'])->where('any', '.*');


// Auth::routes();

// Route::resource('photos', PhotoController::class)->except(['create', 'store', 'update', 'destroy']);
// Route::resource('photos', PhotoController::class)->only(['index', 'show']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/register', [App\Http\Controllers\HomeController::class, 'register']);
Route::post('/auth/register', [App\Http\Controllers\HomeController::class, 'registerStore']);

Route::domain('')->group(function () { // development
    // Route::domain('permohonan.bpfkmakassar.go.id')->group(function () { // production

    // Auth::routes();
    Route::get('/auth/login', [Auths::class, 'index'])->name('admin.login');
    Route::post('/auth/login', [Auths::class, 'login'])->name('login');



    Route::get('/logout', [Auths::class, 'logout'])->middleware('auth');


    // ADMIN_ROUTES
    Route::group(['prefix' => 'admin',   'middleware' => ['web']], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin');


        # APPS 


        Route::group(['prefix' => '/calon-ketos'], function () {
            Route::get('/', [KetosController::class, 'index'])->name('calon-ketos.index');
            Route::get('/data', [KetosController::class, 'data'])->name('calon-ketos.data');
            Route::get('/create', [KetosController::class, 'create'])->name('calon-ketos.create');
            Route::post('/store', [KetosController::class, 'store'])->name('calon-ketos.store');
            Route::get('/{id}/edit', [KetosController::class, 'edit'])->name('calon-ketos.edit');
            Route::get('/{id}/obser', [NilaiKetosController::class, 'obser'])->name('calon-ketos.obser');
            Route::put('/{id}', [KetosController::class, 'update'])->name('calon-ketos.update');
            Route::delete('/{id}', [KetosController::class, 'destroy'])->name('calon-ketos.delete');
        });

        Route::group(['prefix' => '/nilai-ketos'], function () {
            Route::get('/', [NilaiKetosController::class, 'index'])->name('nilai-ketos.index');
            Route::get('/data', [NilaiKetosController::class, 'data'])->name('nilai-ketos.data');
            Route::get('/{id}/create', [NilaiKetosController::class, 'create'])->name('nilai-ketos.create');
            Route::post('/store', [NilaiKetosController::class, 'store'])->name('nilai-ketos.store');
            Route::get('/{id}/edit', [NilaiKetosController::class, 'edit'])->name('nilai-ketos.edit');
            Route::put('/{id}', [NilaiKetosController::class, 'update'])->name('nilai-ketos.update');
            Route::delete('/{id}', [NilaiKetosController::class, 'destroy'])->name('nilai-ketos.delete');
        });

        Route::group(['prefix' => '/perhitungan-saw'], function () {
            Route::get('/', [SawMethodController::class, 'index'])->name('perhitungan-saw.index');
            Route::get('/data', [SawMethodController::class, 'data'])->name('perhitungan-saw.data');
        });

        Route::group(['prefix' => '/kriteria'], function () {
            Route::get('/', [KriteriaController::class, 'index'])->name('kriteria.index');
            Route::get('/data', [KriteriaController::class, 'data'])->name('kriteria.data');
            Route::get('/create', [KriteriaController::class, 'create'])->name('kriteria.create');
            Route::post('/store', [KriteriaController::class, 'store'])->name('kriteria.store');
            Route::get('/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
            Route::put('/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
            Route::delete('/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.delete');
        });


        # MENU MASTER DATA 

        # USER SETTING
        Route::group(['prefix' => '/roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/data', [RoleController::class, 'data'])->name('roles.data');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/{id}', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.delete');
        });

        Route::group(['prefix' => '/menus'], function () {
            Route::get('/', [MenuController::class, 'index'])->name('menus.index');
            Route::get('/data', [MenuController::class, 'data'])->name('menus.data');
            Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
            Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
            Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
            Route::put('/{id}', [MenuController::class, 'update'])->name('menus.update');
            Route::delete('/{id}', [MenuController::class, 'destroy'])->name('menus.delete');
        });

        Route::group(['prefix' => '/user-menus'], function () {
            Route::get('/', [UserMenuController::class, 'index'])->name('user-menus.index');
            Route::get('/data', [UserMenuController::class, 'data'])->name('user-menus.data');
            Route::post('/store', [UserMenuController::class, 'store'])->name('user-menus.store');
            Route::get('/{id}/edit', [UserMenuController::class, 'edit'])->name('user-menus.edit');
            Route::get('/{id}/show', [UserMenuController::class, 'show'])->name('user-menus.show');
            Route::delete('/{id}', [UserMenuController::class, 'destroy'])->name('user-menus.delete');
        });
        Route::get('user-menus/create/{id}', [UserMenuController::class, 'create'])->name('user-menus.create');


        Route::group(['prefix' => '/users'], function () {
            Route::get('/', [UsersController::class, 'index'])->name('users.index');
            Route::get('/data', [UsersController::class, 'data'])->name('users.data');
            Route::get('/create', [UsersController::class, 'create'])->name('users.create');
            Route::post('/store', [UsersController::class, 'store'])->name('users.store');
            Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
            Route::put('/{id}', [UsersController::class, 'update'])->name('users.update');
            Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.delete');
        });

        Route::group(['prefix' => '/settings'], function () {
            Route::get('/', [SettingController::class, 'index'])->name('settings.index');
            Route::get('/data', [SettingController::class, 'data'])->name('settings.data');
            Route::get('/create', [SettingController::class, 'create'])->name('settings.create');
            Route::post('/store', [SettingController::class, 'store'])->name('settings.store');
            Route::get('/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit');
            Route::put('/{id}', [SettingController::class, 'update'])->name('settings.update');
            Route::delete('/{id}', [SettingController::class, 'destroy'])->name('settings.delete');
        });
    });
});
