<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\CouponController;

use App\Http\Controllers\User\EventController as PublicEvent;

use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\EventController as AdminEvent;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

Route::controller(AuthController::class)
->group(function() {
    Route::get("/login", "login")->name("login")->middleware("guestMiddleware");
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
    
    
    Route::controller(AdminEvent::class)
    ->prefix("/event")
    ->name("event.")
    ->group(function() {
        Route::get("/", "index")->name("index");
        Route::get("/detail/{slug}", "detail")->name("detail");
        
        Route::get("/create", "create")->name("create");
        Route::post("/store", "store")->name("store");
        
        Route::get("/edit/{event}", "edit")->name("edit");
        Route::put("/update/{event}", "update")->name("update");
        
        Route::delete("/delete/{event}", "delete")->name("delete");

        Route::put("/register/approved/{id}", "registerApproved")->name("register.approved");
        Route::delete("/register/delete/{id}", "registerDelete")->name("register.delete");
        });
    
    Route::controller(CouponController::class)
    ->prefix("/coupon")
    ->name("coupon.")
    ->group(function() {
        Route::get("/", "index")->name("index");
        
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
        Route::get("/", "index")->name("index");
        
        Route::get("/create", "create")->name("create");
        Route::post("/store", "store")->name("store");
        
        Route::get("/edit/{user}", "edit")->name("edit");
        Route::put("/update/{user}", "update")->name("update");
        
        Route::delete("/delete/{user}", "delete")->name("delete");
    }); 
});
     
Route::controller(PublicEvent::class)
->group(function() {
    Route::get("/", "index")->name("index");
    Route::get("/history", "history")->name("history");
    
    Route::get("/detail/{slug}", "detail")->name("detail");
    Route::post("/regist-event", "registEvent")->name("regist.event");
    Route::get("/payment-event/{registration}", "paymentEvent")->name("payment.event");
    Route::put("/payment-proof/{registration}", "paymentProof")->name("payment.proof");
    });

// Route::get("/user/dashboard", "index")->name("user.dashboard")->middleware("auth:user");