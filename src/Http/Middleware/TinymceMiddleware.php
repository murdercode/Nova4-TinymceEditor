<?php

namespace Murdercode\TinymceEditor\Http\Middleware;

use Closure;

class TinymceMiddleware
{
    public function handle($request, Closure $next)
    {

        /**
         * Check if the upload is globally enabled
         */
        $isActive = config('nova-tinymce-editor.extra.upload_images.enabled') ?? false;
        if (! $isActive) {
            header('HTTP/1.1 500 Server Error');

            return response()->json(['error' => 'Server error']);
        }

        /**
         * Check if the request coming from the same origin
         */
        $accepted_origins = [rtrim(config('app.url'), '/')];
        $origin = rtrim($_SERVER['HTTP_ORIGIN'], '/');
        
        if (isset($origin)) {
            if (in_array($origin, $accepted_origins)) {
                header('Access-Control-Allow-Origin: ' . $origin);
            } else {
                header('HTTP/1.1 403 Origin Denied');
                return response()->json(['error' => 'Origin denied']);
            }
        }


        return $next($request);
    }
}
