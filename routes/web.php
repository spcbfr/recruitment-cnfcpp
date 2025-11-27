<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    $deadline = \Carbon\Carbon::parse("2025-12-05 20:30:00")->toIso8601String();
    return Inertia::render('welcome', [
        'deadline' => $deadline,
        'currentlyRecruiting' => true,
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::post("/apply", function(\Illuminate\Http\Request $request){

});
require __DIR__.'/settings.php';
