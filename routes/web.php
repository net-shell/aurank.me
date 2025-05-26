<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Link;

Route::middleware(['guest'])->group(function () {
    Route::get('login', function () {
        return Inertia::render('auth/login');
    })->name('login');

    Route::get('register', function () {
        return Inertia::render('auth/register');
    })->name('register');

    Route::get('password/reset', function () {
        return Inertia::render('auth/password-reset');
    })->name('password.request');
});

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return Inertia::render('home', [
            'links' => Auth::user()->links()->latest()->take(5)->get(),
            'topLinks' => Link::auRankTop()->get(),
        ]);
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/links/submit', function () {
        return Inertia::render('links/submit-link');
    })->name('links.submit');
});

Route::get('/links/{link}', function (Link $link) {
    return Inertia::render('links/link-show', [
        'link' => [
            'id' => $link->id,
            'url' => $link->url,
            'total_rating' => $link->ratings->sum('score'),
            'positive_ratings' => $link->ratings->where('score', '>', 0)->map(function ($rating) {
                return [
                    'id' => $rating->id,
                    'score' => $rating->score,
                    'evidence_count' => $rating->evidence->count(),
                    'user_name' => $rating->user->name
                ];
            }),
            'negative_ratings' => $link->ratings->where('score', '<', 0)->map(function ($rating) {
                return [
                    'id' => $rating->id,
                    'score' => $rating->score,
                    'evidence_count' => $rating->evidence->count(),
                    'user_name' => $rating->user->name
                ];
            })
        ]
    ]);
})->name('links.show');

require __DIR__ . '/api.php';
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
