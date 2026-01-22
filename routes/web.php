<?php

use App\Http\Requests\ApplicationRequest;
use App\Models\Position;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {

    $contest = \App\Models\Contest::query()->where('ends_at', '>', now())->first();
    if ($contest == null) {
        return view('end');
    }
    $deadline = $contest->ends_at->toIso8601String();

    $positions = \App\Models\Position::select('code')->get()->pluck('code')->toArray();
    $degrees = ['asd'];
    $degrees = $contest->degrees;

    return Inertia::render('welcome', [
        'positions' => $positions,
        'deadline' => $deadline,
        'degrees' => $degrees,
        'currentlyRecruiting' => true,
    ]);
})->name('home');

Route::get('/success', function () {
    $data = [
        'position' => '1',
        'id' => '1',
        'position_name' => 'web developer',

        // Personal info
        'name' => 'محمد أمين بن صالح',
        'gender' => 'ذكر',
        'birth_date' => '1999-07-18',
        'address' => '12 نهج الحبيب بورقيبة',
        'city' => 'باب بحر',
        'governorate' => 'تونس',
        'postal_code' => '1000',
        'cin' => '12345678',
        'cin_date' => '2018-05-22',
        'tel' => '22123456',
        'email' => 'amine.bensaleh@email.tn',

        // Education
        'degree' => 'الإجازة الوطنية في الإعلامية',
        'specialty' => 'نظم معلومات',
        'graduation_year' => '2022',
        'equivalence_decision' => 'قرار عدد 154/2023',
        'equivalence_date' => '2023-03-10',

        // Results
        'bac_average' => '14.85',
        'score' => '30',
        'grad_average' => '13.90',
    ];

    return Inertia::render('success', [
        'data' => session('data') ?? [],
    ]);
});

Route::post('/apply', function (ApplicationRequest $request) {

    $contest = \App\Models\Contest::query()->where('ends_at', '>', now())->first();
    $validated = $request->validated();

    $validated['contest_id'] = $contest->id;
    $validated['position_name'] = Position::where('code', $validated['position'])->first()->name;

    $app = \App\Models\Application::create(Arr::except($validated, 'agreement'));
    $validated['id'] = $app->id;
    $validated['score'] = $app->score;

    $password = \Illuminate\Support\Str::password(8);
    \App\Models\User::create(['email' => $validated['email'], 'password' => $password, 'name' => $validated['name']]);

    return Redirect::to('/success')->with(['data' => $validated]);

});
require __DIR__.'/settings.php';
