<?php

use App\Http\Controllers\MasterGembalaController;
use App\Http\Controllers\MasterGerejaController;
use App\Http\Controllers\MasterUserGerejaController;
use App\Http\Controllers\MasterWilayahController;
use App\Http\Controllers\MenuManagementController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\UserManagementController;

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
    return view('welcome');
});

Auth::routes();

Route::group([
    "middleware" => ["auth"],
    "prefix" => "admin"
], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(["middleware" => "menuautho"], function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::group(["prefix" => "/user-management"], function () {
            Route::get("/", [UserManagementController::class, 'index'])->name('user-management.index');
            Route::get("/create", [UserManagementController::class, 'create'])->name('user-management.create');
            Route::get("/{user}", [UserManagementController::class, 'show'])->name('user-management.detail');
            Route::get("/{user}/edit", [UserManagementController::class, 'edit'])->name('user-management.edit');

            Route::post("/", [UserManagementController::class, 'store'])->name('user-management.store');
            Route::put("/{user}", [UserManagementController::class, 'update'])->name('user-management.update');
            Route::delete("/{user}", [UserManagementController::class, 'destroy'])->name('user-management.destroy');
        });

        Route::group(["prefix" => "/role-management"], function () {
            Route::get("/", [RoleManagementController::class, 'index'])->name('role-management.index');
            Route::get("/create", [RoleManagementController::class, 'create'])->name('role-management.create');
            Route::get("/{role}", [RoleManagementController::class, 'show'])->name('role-management.detail');
            Route::get("/{role}/edit", [RoleManagementController::class, 'edit'])->name('role-management.edit');
            Route::get("/{role}/permision", [RoleManagementController::class, 'editPermission'])->name('role-management.permission');

            Route::post("/", [RoleManagementController::class, 'store'])->name('role-management.store');
            Route::put("/{role}", [RoleManagementController::class, 'update'])->name('role-management.update');
            Route::post("/{role}/permision", [RoleManagementController::class, 'updatePermission'])->name('role-management.uppdate-permission');
            Route::delete("/{role}", [RoleManagementController::class, 'destroy'])->name('role-management.destroy');
        });

        Route::group(["prefix" => "/menu-management"], function () {
            Route::get("/", [MenuManagementController::class, 'index'])->name('menu-management.index');
            Route::get("/create", [MenuManagementController::class, 'create'])->name('menu-management.create');
            Route::get("/{menu}", [MenuManagementController::class, 'show'])->name('menu-management.detail');
            Route::get("/{menu}/edit", [MenuManagementController::class, 'edit'])->name('menu-management.edit');

            Route::post("/", [MenuManagementController::class, 'store'])->name('menu-management.store');
            Route::put("/{menu}", [MenuManagementController::class, 'update'])->name('menu-management.update');
            Route::delete("/{menu}", [MenuManagementController::class, 'destroy'])->name('menu-management.destroy');
        });


        Route::group(["prefix" => "/master-wilayah"], function () {
            Route::get("/", [MasterWilayahController::class, 'index'])->name('master-wilayah.index');
            Route::get("/create", [MasterWilayahController::class, 'create'])->name('master-wilayah.create');
            Route::get("/{wilayah}", [MasterWilayahController::class, 'show'])->name('master-wilayah.detail');
            Route::get("/{wilayah}/edit", [MasterWilayahController::class, 'edit'])->name('master-wilayah.edit');

            Route::post("/", [MasterWilayahController::class, 'store'])->name('master-wilayah.store');
            Route::put("/{wilayah}", [MasterWilayahController::class, 'update'])->name('master-wilayah.update');
            Route::delete("/{wilayah}", [MasterWilayahController::class, 'destroy'])->name('master-wilayah.destroy');

            Route::delete("/{wilayah}/remove/{gereja)", [MasterWilayahController::class, 'destroy'])->name('master-wilayah.gereja.destroy');
        });


        Route::group(["prefix" => "/master-gereja"], function () {
            Route::get("/", [MasterGerejaController::class, 'index'])->name('master-gereja.index');
            Route::get("/create", [MasterGerejaController::class, 'create'])->name('master-gereja.create');
            Route::get("/{gereja}", [MasterGerejaController::class, 'show'])->name('master-gereja.detail');
            Route::get("/{gereja}/edit", [MasterGerejaController::class, 'edit'])->name('master-gereja.edit');

            Route::post("/", [MasterGerejaController::class, 'store'])->name('master-gereja.store');
            Route::put("/{gereja}", [MasterGerejaController::class, 'update'])->name('master-gereja.update');
            Route::delete("/{gereja}", [MasterGerejaController::class, 'destroy'])->name('master-gereja.destroy');


            Route::get("/{gereja}/user/create", [MasterUserGerejaController::class, 'create'])->name('master-gereja.user.create');
            Route::get("/{gereja}/user/{user}", [MasterUserGerejaController::class, 'store'])->name('master-gereja.user.detail');
            Route::get("/{gereja}/user/{user}/edit", [MasterUserGerejaController::class, 'edit'])->name('master-gereja.user.edit');

            Route::post("/{gereja}/user", [MasterUserGerejaController::class, 'store'])->name('master-gereja.user.store');
            Route::put("/{gereja}/user/{user}", [MasterUserGerejaController::class, 'update'])->name('master-gereja.user.update');
            Route::delete("/{gereja}/user/{user}", [MasterUserGerejaController::class, 'destroy'])->name('master-gereja.user.destroy');
        });

        Route::group(["prefix" => "/master-gembala"], function () {
            Route::get("/", [MasterGembalaController::class, 'index'])->name('master-gembala.index');
            Route::get("/create", [MasterGembalaController::class, 'create'])->name('master-gembala.create');
            Route::get("/{gembala}", [MasterGembalaController::class, 'show'])->name('master-gembala.detail');
            Route::get("/{gembala}/edit", [MasterGembalaController::class, 'edit'])->name('master-gembala.edit');

            Route::post("/", [MasterGembalaController::class, 'store'])->name('master-gembala.store');
            Route::put("/{gembala}", [MasterGembalaController::class, 'update'])->name('master-gembala.update');
            Route::delete("/{gembala}", [MasterGembalaController::class, 'destroy'])->name('master-gembala.destroy');
        });
    });
});
