<?php

namespace Murdercode\TinymceEditor\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TinymceMiddleware
{
    public function handle($request, Closure $next)
    {

        /**
         * Check if the upload is globally enabled
         */
        $isActive = config('nova-tinymce-editor.extra.upload_images.enabled') ?? false;
        if (! $isActive) {
            throw new NotFoundHttpException;
        }

        return $next($request);
    }
}
