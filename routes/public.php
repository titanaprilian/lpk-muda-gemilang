<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrantController;
use Illuminate\Support\Facades\Route;

Route::name("public.")->group(function () {
    Route::get("/", [HomeController::class, "index"])->name("home");
    Route::view("/pemagangan-jepang", "public.pemagangan-jepang")->name(
        "pemagangan-jepang",
    );
    Route::view("/tokutei-ginou", "public.tokutei-ginou")->name(
        "tokutei-ginou",
    );
    Route::view("/im-japan", "public.im-japan")->name("im-japan");
    Route::get("/pendaftaran", [RegistrantController::class, "create"])->name(
        "pendaftaran.form",
    );
    Route::post("/pendaftaran", [RegistrantController::class, "store"])->name(
        "pendaftaran.store",
    );
});
