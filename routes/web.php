<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Links\SubmitLink;
use App\Livewire\Links\LinkShow;
use Inertia\Inertia;

Route::get('/', \App\Livewire\HomePage::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', function () {
        return Inertia::render('dashboard', [
            'links' => auth()->user()->links()->latest()->take(5)->get(),
        ]);
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/links/submit', SubmitLink::class)->name('links.submit');
});

Route::get('/links/{link}', LinkShow::class)->name('links.show');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
