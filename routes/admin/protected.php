<?php

use Illuminate\Support\Facades\Route;

Route::get("/dashboard", function () {
    return view("admin.dashboard");
})->name("dashboard");

// Registrant Routes
Route::prefix("registrants")
    ->name("registrants.")
    ->group(function () {
        Route::get("/", function () {
            return view("admin.registrants.index");
        })->name("index");

        Route::get("/create", function () {
            return view("admin.registrants.form");
        })->name("create");

        Route::get("/{id}", function ($id) {
            return view("admin.registrants.view", compact("id"));
        })->name("view");

        Route::get("/{id}/edit", function ($id) {
            return view("admin.registrants.form", compact("id"));
        })->name("edit");

        // If you'll add more CRUD routes later
        // Route::post('/', [RegistrantController::class, 'store'])->name('store');
        // Route::put('/{id}', [RegistrantController::class, 'update'])->name('update');
        // Route::delete('/{id}', [RegistrantController::class, 'destroy'])->name('destroy');
    });
