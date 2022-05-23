<?php

use App\Helpers\JemaatPushNotifHelper;
use App\Http\Controllers\Auth\RegisterGerejaController;
use App\Http\Controllers\Frontend\GerejaController;
use App\Http\Controllers\Frontend\WilayahController;
use App\Http\Controllers\Gereja\BiodataGembalaController;
use App\Http\Controllers\Gereja\MasterKelompokController;
use App\Http\Controllers\Gereja\MasterKeluargaController;
use App\Http\Controllers\Gereja\UserManagementGerejaController;
use App\Http\Controllers\Gereja\ProfileGerejaController;
use App\Http\Controllers\MasterGembalaController;
use App\Http\Controllers\MasterGerejaController;
use App\Http\Controllers\MasterJemaatController;
use App\Http\Controllers\MasterUserGerejaController;
use App\Http\Controllers\MasterWilayahController;
use App\Http\Controllers\MenuManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resource\FormController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\Tools\HutSepekanController;
use App\Http\Controllers\UserManagementController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::group(["prefix" => "resources"], function () {
    Route::get('/gereja-by-wilayah', [FormController::class, 'gerejaByWilayah'])->name('resource.gereja-by-wilayah');
});

Auth::routes([
    'register' => false, // Registration Routes...
]);

Route::get('/register/gembala/5526f5323af331ab22dac08d817cfb7520a80fc1', [RegisterGerejaController::class, "showRegistrationForm"])->name("register.gembala");
Route::post('/register/gembala/5526f5323af331ab22dac08d817cfb7520a80fc1', [RegisterGerejaController::class, "register"])->name("register.gembala");

Route::group(["prefix" => "wilayah"], function () {
    Route::get('/', [WilayahController::class, 'index'])->name('front.wilayah.index');
    // Route::get('/genslug', [WilayahController::class, 'generateSlug']);
    Route::get('/{slug}', [WilayahController::class, 'show'])->name('front.wilayah.show');
    Route::get('/{slug}/feed', [WilayahController::class, 'feed'])->name('front.wilayah.feed');
});

Route::get('/gereja', [GerejaController::class, 'index'])->name('front.gereja.index');

Route::group(["prefix" => "g"], function () {
    Route::get('/', function () {
        return redirect()->route("front.gereja.index");
    });
    Route::get('/{slug}', [GerejaController::class, 'show'])->name('front.gereja.show');
    Route::get('/{slug}/schedule', [GerejaController::class, 'schedule'])->name('front.gereja.schedule');
    // Route::get('/{slug}/feed', [GerejaController::class, 'feed'])->name('front.gereja.feed');
});


Route::group([
    "middleware" => ["auth"],
    "prefix" => "admin"
], function () {
    Route::get('/', [ProfileController::class, 'show'])->name('home');
    Route::post('/onesignal', [ProfileController::class, 'subscribe'])->name('onesignal.subscribe');

    Route::get('/my-account', [ProfileController::class, 'show'])->name('account');
    Route::get('/edit-account', [ProfileController::class, 'edit'])->name('account.edit');
    Route::post('/edit-account', [ProfileController::class, 'update'])->name('account.store');

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

        Route::group(["prefix" => "/master-jemaat"], function () {
            Route::get("/api-search", [MasterJemaatController::class, 'searchJemaat'])->name('master-jemaat.api-search');

            Route::get("/", [MasterJemaatController::class, 'index'])->name('master-jemaat.index');
            Route::get("/create", [MasterJemaatController::class, 'create'])->name('master-jemaat.create');
            Route::get("/{jemaat}", [MasterJemaatController::class, 'show'])->name('master-jemaat.detail');
            Route::get("/{jemaat}/edit", [MasterJemaatController::class, 'edit'])->name('master-jemaat.edit');
            Route::get("/{jemaat}/delete", [MasterJemaatController::class, 'delete'])->name('master-jemaat.delete');

            Route::post("/", [MasterJemaatController::class, 'store'])->name('master-jemaat.store');
            Route::put("/{jemaat}", [MasterJemaatController::class, 'update'])->name('master-jemaat.update');
            Route::delete("/{jemaat}", [MasterJemaatController::class, 'destroy'])->name('master-jemaat.destroy');
        });

        Route::group(["prefix" => "/master-kelompok"], function () {
            Route::get("/", [MasterKelompokController::class, 'index'])->name('master-kelompok.index');
            Route::get("/create", [MasterKelompokController::class, 'create'])->name('master-kelompok.create');
            Route::get("/{kelompok}", [MasterKelompokController::class, 'show'])->name('master-kelompok.detail');
            Route::get("/{kelompok}/edit", [MasterKelompokController::class, 'edit'])->name('master-kelompok.edit');

            Route::post("/", [MasterKelompokController::class, 'store'])->name('master-kelompok.store');
            Route::put("/{kelompok}", [MasterKelompokController::class, 'update'])->name('master-kelompok.update');
            Route::delete("/{kelompok}", [MasterKelompokController::class, 'destroy'])->name('master-kelompok.destroy');

            Route::get("/{kelompok}/member", [MasterKelompokController::class, 'showMember'])->name('master-kelompok.member');
            Route::get("/{kelompok}/member/search", [MasterKelompokController::class, 'searchMember'])->name('master-kelompok.search');
            Route::post("/{kelompok}/member", [MasterKelompokController::class, 'addMember'])->name('master-kelompok.member.add');
            Route::delete("/{kelompok}/member/{member}", [MasterKelompokController::class, 'removeMember'])->name('master-kelompok.member.remove');
        });

        Route::group(["prefix" => "/master-keluarga"], function () {
            Route::get("/", [MasterKeluargaController::class, 'index'])->name('master-keluarga.index');
            Route::get("/create", [MasterKeluargaController::class, 'create'])->name('master-keluarga.create');
            Route::get("/{keluarga}", [MasterKeluargaController::class, 'show'])->name('master-keluarga.detail');
            Route::get("/{keluarga}/edit", [MasterKeluargaController::class, 'edit'])->name('master-keluarga.edit');

            Route::post("/", [MasterKeluargaController::class, 'store'])->name('master-keluarga.store');
            Route::put("/{keluarga}", [MasterKeluargaController::class, 'update'])->name('master-keluarga.update');
            Route::delete("/{keluarga}", [MasterKeluargaController::class, 'destroy'])->name('master-keluarga.destroy');

            Route::get("/{keluarga}/member", [MasterKeluargaController::class, 'showMember'])->name('master-keluarga.member');
            Route::get("/{keluarga}/member/search", [MasterKeluargaController::class, 'searchMember'])->name('master-keluarga.search');
            Route::post("/{keluarga}/member", [MasterKeluargaController::class, 'addMember'])->name('master-keluarga.member.add');
            Route::delete("/{keluarga}/member/{member}", [MasterKeluargaController::class, 'removeMember'])->name('master-keluarga.member.remove');
        });

        Route::group(["prefix" => "/profile-gereja"], function () {
            Route::get("/", [ProfileGerejaController::class, 'show'])->name('profile-gereja.detail');
            Route::get("/edit", [ProfileGerejaController::class, 'edit'])->name('profile-gereja.edit');

            Route::put("/edit", [ProfileGerejaController::class, 'update'])->name('profile-gereja.update');
        });

        Route::group(["prefix" => "/biodata-gembala"], function () {
            Route::get("/", [BiodataGembalaController::class, 'show'])->name('biodata-gembala.detail');
            Route::get("/edit", [BiodataGembalaController::class, 'edit'])->name('biodata-gembala.edit');

            Route::put("/edit", [BiodataGembalaController::class, 'update'])->name('biodata-gembala.update');
        });

        Route::group(["prefix" => "/hut-sepekan"], function () {
            Route::get("/", [HutSepekanController::class, 'index'])->name('hut-sepekan.index');
        });


        Route::group(["prefix" => "/user-management-gereja"], function () {
            Route::get("/", [UserManagementGerejaController::class, 'index'])->name('user-management-gereja.index');
            Route::get("/create", [UserManagementGerejaController::class, 'create'])->name('user-management-gereja.create');
            Route::get("/{user}", [UserManagementGerejaController::class, 'show'])->name('user-management-gereja.detail');
            Route::get("/{user}/edit", [UserManagementGerejaController::class, 'edit'])->name('user-management-gereja.edit');

            Route::post("/", [UserManagementGerejaController::class, 'store'])->name('user-management-gereja.store');
            Route::put("/{user}", [UserManagementGerejaController::class, 'update'])->name('user-management-gereja.update');
            Route::delete("/{user}", [UserManagementGerejaController::class, 'destroy'])->name('user-management-gereja.destroy');
        });
    });
});
