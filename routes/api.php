<?php

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Murdercode\TinymceEditor\Http\Controllers\TinyImageController;
use Murdercode\TinymceEditor\Http\Middleware\TinymceMiddleware;

// Without CSRF protection
// Route::post('/upload', TinyImageController::class)->name('tinymce.upload')
//     ->withoutMiddleware([VerifyCsrfToken::class])
//     ->middleware(TinymceMiddleware::class);
