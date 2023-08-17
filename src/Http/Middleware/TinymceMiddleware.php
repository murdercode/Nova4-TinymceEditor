<?php

namespace Murdercode\TinymceEditor\Http\Middleware;

use Closure;

class TinymceMiddleware
{
    public function handle($request, Closure $next)
    {

        $isActive = config('nova-tinymce-editor.extra.upload_images.enabled') ?? false;

        if (! $isActive) {
            header('HTTP/1.1 500 Server Error');
            return response()->json(['error' => 'Server error']);
        }

        return $next($request);
    }
}
