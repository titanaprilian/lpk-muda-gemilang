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

Route::prefix("export-reports")
    ->name("export-reports.")
    ->group(function () {
        Route::get("/", function () {
            return view("admin.export-reports.index");
        })->name("index");
    });

Route::prefix("settings")
    ->name("settings.")
    ->group(function () {
        Route::get("/", function () {
            return view("admin.settings.index");
        })->name("index");
    });

Route::prefix("galleries")
    ->name("galleries.")
    ->group(function () {
        Route::get("/", function () {
            return view("admin.galleries.index");
        })->name("index");

        Route::get("/create", function () {
            return view("admin.galleries.form");
        })->name("create");

        Route::get("/{id}", function ($id) {
            return view("admin.galleries.view", compact("id"));
        })->name("view");

        Route::get("/{id}/edit", function ($id) {
            return view("admin.galleries.form", compact("id"));
        })->name("edit");
    });

Route::prefix("programs")
    ->name("programs.")
    ->group(function () {
        Route::get("/", function () {
            return view("admin.programs.index");
        })->name("index");

        Route::get("/create", function () {
            return view("admin.programs.form");
        })->name("create");

        Route::get("/{id}/edit", function ($id) {
            return view("admin.programs.form", ["id" => $id]);
        })->name("edit");

        Route::get("/{id}", function ($id) {
            return view("admin.programs.view", ["id" => $id]);
        })->name("view");
    });
