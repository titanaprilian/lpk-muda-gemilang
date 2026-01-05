<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrantController;
use Illuminate\Support\Facades\Route;

Route::name("public.")->group(function () {
    Route::get("/", [HomeController::class, "index"])->name("home");
    Route::get("/program/{slug}", [HomeController::class, "show"])->name(
        "program.show",
    );

    Route::get("/pendaftaran", [RegistrantController::class, "create"])->name(
        "pendaftaran.form",
    );
    Route::post("/pendaftaran", [RegistrantController::class, "store"])->name(
        "pendaftaran.store",
    );
});
