<?php

use App\Http\Requests\ApplicationRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $contest = \App\Models\Contest::query()->where('ends_at', '>', now())->first();
    $deadline = $contest->ends_at->toIso8601String();

    $positions = \App\Models\Position::select('code')->get()->pluck('code')->toArray();

    return Inertia::render('welcome', [
        'positions' => $positions,
        'deadline' => $deadline,
        'currentlyRecruiting' => true,
    ]);
})->name('home');

Route::get('/success', function () {
    return Inertia::render('success', [
        'data' => session('data') ?? [],
    ]);
});

Route::post('/apply', function (ApplicationRequest $request) {

    $contest = \App\Models\Contest::query()->where('ends_at', '>', now())->first();
    $validated = $request->validated();

    $validated['contest_id'] = $contest->id;

    \App\Models\Application::create($validated);
    $password = \Illuminate\Support\Str::password(8);
    \App\Models\User::create(['email' => $validated['email'], 'password' => $password, 'name' => $validated['name']]);

    return Redirect::to('/success')->with(['data' => $validated]);

});
require __DIR__.'/settings.php';
