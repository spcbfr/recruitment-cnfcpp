<?php

use App\Http\Requests\ApplicationRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
$contest = \App\Models\Contest::query()->where('ends_at', '>', now())->first();
Route::get('/', function () use ($contest) {
    $deadline = $contest->ends_at->toIso8601String();

    return Inertia::render('welcome', [
        'deadline' => $deadline,
        'currentlyRecruiting' => true,
    ]);
})->name('home');

Route::view("/success", 'success');

Route::post('/apply', function (ApplicationRequest $request) use($contest) {

    $validated = $request->validated();

    $validated['contest_id'] = $contest->id;

    \App\Models\Application::create($validated);
    $password = \Illuminate\Support\Str::password(8);
    \App\Models\User::create(['email' => $validated['email'], 'password' => $password, 'name'=> $validated['name'] ]);
    return Redirect::to("/success")->with(['email' => $validated['email'], 'password' => $password]);

});
require __DIR__.'/settings.php';
