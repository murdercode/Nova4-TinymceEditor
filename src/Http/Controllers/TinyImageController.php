<?php

namespace Murdercode\TinymceEditor\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TinyImageController
{
    public function upload(Request $request): JsonResponse
    {
        $validator = $this->validateRequest($request);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $imageFolder = config('nova-tinymce-editor.extra.upload_images.folder') ?? 'images';
        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            $file = Storage::disk('public')->putFile($imageFolder, $temp['tmp_name']);

            return response()->json(['location' => Storage::disk('public')->url($file)]);
        } else {
            return response()->json(['error' => 'Failed to move uploaded file.']);
        }

    }

    public function validateRequest(Request $request): \Illuminate\Validation\Validator
    {
        $maxSize = config('nova-tinymce-editor.extra.upload_images.maxSize') ?? 2048;
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:'.$maxSize,
        ]);

        return $validator;
    }
}
