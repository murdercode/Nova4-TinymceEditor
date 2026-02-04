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
                'mimes:jpeg,png,jpg,webp',
                'max:'.config('nova-tinymce-editor.extra.upload_images.maxSize', 2048),
            ],
        ]);

        $uploadedFile = $request->file('file');
        
        // Check if the uploaded file is a valid image
        $imageInfo = @getimagesize($uploadedFile->getRealPath());
        if ($imageInfo === false) {
            return response()->json(['error' => 'The file is not a valid image.'], 422);
        }
        
        // Check MIME type
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        if (!in_array($imageInfo['mime'], $allowedMimeTypes)) {
            return response()->json(['error' => 'Unsupported image type.'], 422);
        }
        
        // Check for potentially dangerous content
        $fileContent = file_get_contents($uploadedFile->getRealPath());
        $dangerousPatterns = [
            '/<\?php/i',
            '/<\?=/i',
            '/<script/i',
            '/eval\(/i',
            '/base64_decode/i',
            '/system\(/i',
            '/exec\(/i',
            '/shell_exec/i',
        ];
        
        foreach ($dangerousPatterns as $pattern) {
            if (preg_match($pattern, $fileContent)) {
                return response()->json(['error' => 'The file contains potentially dangerous code.'], 422);
            }
        }
        
        $disk = config('nova-tinymce-editor.extra.upload_images.disk');
        try {
            $file = $uploadedFile
                ->storePublicly(
                    config('nova-tinymce-editor.extra.upload_images.folder'),
                    compact('disk')
                );
        } catch (\Throwable $e) {
            report($e);

            return response()->json(['error' => 'Failed to move uploaded file.'], 422);
        }

        return response()->json(['location' => Storage::disk($disk)->url($file)]);
    }
}
