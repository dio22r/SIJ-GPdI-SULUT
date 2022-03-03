<?php

use App\Http\Controllers\UserManagementController;
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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::resource("/user-management", App\Http\Controllers\UserManagementController::class);

    Route::group(["prefix" => "/user-management"], function () {
        Route::get("/", [UserManagementController::class, 'index'])->name('user-management.index');
        Route::get("/create", [UserManagementController::class, 'create'])->name('user-management.create');
        Route::get("/{user}", [UserManagementController::class, 'show'])->name('user-management.detail');
        Route::get("/{user}/edit", [UserManagementController::class, 'edit'])->name('user-management.edit');

        Route::post("/", [UserManagementController::class, 'store'])->name('user-management.store');
        Route::put("/{user}", [UserManagementController::class, 'update'])->name('user-management.update');
        Route::get("/{user}/edit", [UserManagementController::class, 'edit'])->name('user-management.edit');
        Route::delete("/{user}", [UserManagementController::class, 'destroy'])->name('user-management.destroy');
    });

    Route::group(["prefix" => "/role-management"], function () {
        Route::get("/", [RoleManagementController::class, 'index'])->name('role-management.index');
        Route::get("/create", [RoleManagementController::class, 'create'])->name('role-management.create');
        Route::get("/{menu}", [RoleManagementController::class, 'show'])->name('role-management.detail');
        Route::get("/{menu}/edit", [RoleManagementController::class, 'edit'])->name('role-management.edit');

        Route::post("/", [RoleManagementController::class, 'store'])->name('role-management.store');
        Route::put("/{menu}", [RoleManagementController::class, 'update'])->name('role-management.update');
        Route::get("/{menu}/edit", [RoleManagementController::class, 'edit'])->name('role-management.edit');
        Route::delete("/{menu}", [RoleManagementController::class, 'destroy'])->name('role-management.destroy');
    });
});
