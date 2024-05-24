<?php

use App\Http\Controllers\UrlController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/shorten-url', [UrlController::class, 'shortenUrl'])->name('shorten.url');

Route::get('/{shortCode}', [UrlController::class, 'redirect'])->name('redirect.url');
