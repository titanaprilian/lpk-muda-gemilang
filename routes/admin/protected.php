<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt; // Don't forget to import this!

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
    });
