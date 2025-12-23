<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

Route::get("/", function () {
    return view("public.home");
})->name("home");

Route::get("/pemagangan-jepang", function () {
    return view("public.pemagangan-jepang");
})->name("pemagangan-jepang");

Route::get("/tokutei-ginou", function () {
    return view("public.tokutei-ginou");
})->name("tokutei-ginou");

Route::get("/im-japan", function () {
    return view("public.im-japan");
})->name("im-japan");

Route::get("/pendaftaran", function () {
    return view("public.form-pendaftaran");
})->name("pendaftaran");

// Admin Auth Routes
Route::prefix("admin")
    ->name("admin.")
    ->group(function () {
        // 1. Login View
        $limiter = config("fortify.limiters.login");

        Route::get("/login", [AuthenticatedSessionController::class, "create"])
            ->middleware(["guest:" . config("fortify.guard")])
            ->name("login");

        // 2. Login Action (POST)
        Route::post("/login", [AuthenticatedSessionController::class, "store"])
            ->middleware(
                array_filter([
                    "guest:" . config("fortify.guard"),
                    $limiter ? "throttle:" . $limiter : null,
                ]),
            )
            ->name("login.store");

        // 3. Logout Action
        Route::post("/logout", [
            AuthenticatedSessionController::class,
            "destroy",
        ])->name("logout");

        Route::get("/forgot-password", [
            PasswordResetLinkController::class,
            "create",
        ])
            ->middleware(["guest:" . config("fortify.guard")])
            ->name("password.request");

        // 2. Send Reset Link Email (Action)
        Route::post("/forgot-password", [
            PasswordResetLinkController::class,
            "store",
        ])
            ->middleware(["guest:" . config("fortify.guard")])
            ->name("password.email");

        // 3. Reset Password Form (The link clicked in the email)
        Route::get("/reset-password/{token}", [
            NewPasswordController::class,
            "create",
        ])
            ->middleware(["guest:" . config("fortify.guard")])
            ->name("password.reset");

        // 4. Update Password (Action)
        Route::post("/reset-password", [NewPasswordController::class, "store"])
            ->middleware(["guest:" . config("fortify.guard")])
            ->name("password.update");

        // Protected Admin Routes
        Route::middleware("auth")->group(function () {
            Route::get("/dashboard", function () {
                return view("admin.dashboard");
            })->name("dashboard");
        });
    });
