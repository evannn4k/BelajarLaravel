<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\User\DashboardController as UserDashboard;

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;

Route::controller(AuthController::class)
->group(function() {
    Route::get("/", "login")->name("login")->middleware("guestMiddleware");
    Route::get("/register", "register")->name("register")->middleware("guestMiddleware");

    Route::get("/logout", "logout")->name("logout");

    Route::post("/verify", "verify")->name("auth.verify");
    Route::post("/daftar", "daftar")->name("auth.daftar");
});

// admin
Route::middleware("auth:admin")
->name("admin.")
->prefix("/admin")
->group(function() {
    
    Route::controller(AdminDashboard::class)
    ->group(function() {
        Route::get("/dashboard", "index")->name("dashboard");
    });
    
    
    Route::controller(EventController::class)
    ->prefix("/event")
    ->name("event.")
    ->group(function() {
        Route::get("/index", "index")->name("index");
        
        Route::get("/create", "create")->name("create");
        Route::post("/store", "store")->name("store");
        
        Route::get("/edit/{event}", "edit")->name("edit");
        Route::put("/update/{event}", "update")->name("update");
        
        Route::delete("/delete/{event}", "delete")->name("delete");
    });
    
    Route::controller(CouponController::class)
    ->prefix("/coupon")
    ->name("coupon.")
    ->group(function() {
        Route::get("/index", "index")->name("index");
        
        Route::get("/create", "create")->name("create");
        Route::post("/store", "store")->name("store");
        
        Route::get("/edit/{coupon}", "edit")->name("edit");
        Route::put("/update/{coupon}", "update")->name("update");
        
        Route::delete("/delete/{coupon}", "delete")->name("delete");
    }); 

    Route::controller(AdminUser::class)
    ->prefix("/user")
    ->name("user.")
    ->group(function() {
        Route::get("/index", "index")->name("index");
        
        Route::get("/create", "create")->name("create");
        Route::post("/store", "store")->name("store");
        
        Route::get("/edit/{user}", "edit")->name("edit");
        Route::put("/update/{user}", "update")->name("update");
        
        Route::delete("/delete/{user}", "delete")->name("delete");
    }); 
});
     
Route::get("/user/dashboard", [UserDashboard::class, "index"])->name("user.dashboard")->middleware("auth:user");