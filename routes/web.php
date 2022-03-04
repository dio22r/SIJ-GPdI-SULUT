<?php

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
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::resource("/user-management", App\Http\Controllers\UserManagementController::class);

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
        Route::get("/", [RoleManagementController::class, 'index'])->name('menu-management.index');
        Route::get("/create", [RoleManagementController::class, 'create'])->name('menu-management.create');
        Route::get("/{menu}", [RoleManagementController::class, 'show'])->name('menu-management.detail');
        Route::get("/{menu}/edit", [RoleManagementController::class, 'edit'])->name('menu-management.edit');
        Route::get("/{menu}/permision", [RoleManagementController::class, 'editPermission'])->name('menu-management.permission');

        Route::post("/", [RoleManagementController::class, 'store'])->name('menu-management.store');
        Route::put("/{menu}", [RoleManagementController::class, 'update'])->name('menu-management.update');
        Route::put("/{menu}/permision", [RoleManagementController::class, 'updatePermission'])->name('menu-management.uppdate-permission');
        Route::delete("/{menu}", [RoleManagementController::class, 'destroy'])->name('menu-management.destroy');
    });
});
