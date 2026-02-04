<?php

use Illuminate\Support\Facades\Route;
use Murdercode\TinymceEditor\Http\Controllers\TinyImageController;
use Murdercode\TinymceEditor\Http\Middleware\TinymceMiddleware;

// Without CSRF protection
if (config('nova-tinymce-editor.extra.upload_images.enable_api_routes', true)) {
    Route::post('/upload', TinyImageController::class)->name('tinymce.upload')
        ->middleware('auth');
}
