<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

$limiter = config("fortify.limiters.login");
$guestMiddleware = ["guest:" . config("fortify.guard")];

// Login Routes
Route::controller(AuthenticatedSessionController::class)->group(
    function () use ($limiter, $guestMiddleware) {
        Route::get("/login", "create")
            ->middleware($guestMiddleware)
            ->name("login");

        Route::post("/login", "store")
            ->middleware(
                array_filter([
                    ...$guestMiddleware,
                    $limiter ? "throttle:" . $limiter : null,
                ]),
            )
            ->name("login.store");

        Route::post("/logout", "destroy")->name("logout");
    },
);

// Password Reset Routes
Route::prefix("forgot-password")
    ->name("password.")
    ->group(function () use ($guestMiddleware) {
        Route::get("/", [PasswordResetLinkController::class, "create"])
            ->middleware($guestMiddleware)
            ->name("request");

        Route::post("/", [PasswordResetLinkController::class, "store"])
            ->middleware($guestMiddleware)
            ->name("email");
    });

Route::prefix("reset-password")
    ->name("password.")
    ->group(function () use ($guestMiddleware) {
        Route::get("/{token}", [NewPasswordController::class, "create"])
            ->middleware($guestMiddleware)
            ->name("reset");

        Route::post("/", [NewPasswordController::class, "store"])
            ->middleware($guestMiddleware)
            ->name("update");
    });
