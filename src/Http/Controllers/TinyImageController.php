<?php

namespace Murdercode\TinymceEditor\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TinyImageController
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'file' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:'.config('nova-tinymce-editor.extra.upload_images.maxSize', 2048),
            ],
        ]);
        $disk = config('nova-tinymce-editor.extra.upload_images.disk');
        try {
            $file = $request->file('file')
                ->storePublicly(
                    config('nova-tinymce-editor.extra.upload_images.folder'),
                    compact('disk')
                );
        } catch (\Throwable $e) {
            report($e);

            return response()->json(['error' => 'Failed to move uploaded file.']);
        }

        return response()->json(['location' => Storage::disk($disk)->url($file)]);
    }
}
