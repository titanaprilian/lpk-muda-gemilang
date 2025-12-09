<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

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

Route::view("dashboard", "dashboard")
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware(["auth"])->group(function () {
    Route::redirect("settings", "settings/profile");

    Volt::route("settings/profile", "settings.profile")->name("profile.edit");
    Volt::route("settings/password", "settings.password")->name(
        "user-password.edit",
    );
    Volt::route("settings/appearance", "settings.appearance")->name(
        "appearance.edit",
    );

    Volt::route("settings/two-factor", "settings.two-factor")
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication() &&
                    Features::optionEnabled(
                        Features::twoFactorAuthentication(),
                        "confirmPassword",
                    ),
                ["password.confirm"],
                [],
            ),
        )
        ->name("two-factor.show");
});
