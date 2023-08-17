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

        // Validate request
        $validator = $this->validateRequest($request);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $accepted_origins = [config('app.url')];
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
            } else {
                header('HTTP/1.1 403 Origin Denied');
            }
        }

        $imageFolder = config('nova-tinymce-editor.extra.upload_images.folder') ?? 'images';
        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            $file = Storage::disk('public')->putFile($imageFolder, $temp['tmp_name']);

            return response()->json(['location' => Storage::disk('public')->url($file)]);

        } else {
            // Notify editor that the upload failed
            header('HTTP/1.1 500 Server Error');

            return response()->json(['error' => 'Server error']);
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
