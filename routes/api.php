<?php

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Murdercode\TinymceEditor\Http\Controllers\TinyImageController;
use Murdercode\TinymceEditor\Http\Middleware\TinymceMiddleware;

// Without CSRF protection
Route::post('/upload', [TinyImageController::class, 'upload'])->name('tinymce.upload')
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->middleware(TinymceMiddleware::class);
