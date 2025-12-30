<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

Route::prefix("admin")
    ->name("admin.")
    ->group(function () {
        // Include auth routes
        require __DIR__ . "/admin/auth.php";

        // Protected routes
        Route::middleware("auth")->group(function () {
            require __DIR__ . "/admin/protected.php";
        });
    });
