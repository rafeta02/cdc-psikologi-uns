<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait MediaUploadingTrait
{
    public function storeMedia(Request $request)
    {
        // Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }
        
        // If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('tmp/uploads');

        try {
            if (! file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        // Get custom naming parameters from request
        $collection = $request->input('collection', '');
        $nim = $request->input('nim', 'unknown');
        
        if ($collection && $nim !== 'unknown') {
            // Use custom naming format: nim_collection_uniqid.extension
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $uniqueId = uniqid();
            $name = $nim . '_' . $collection . '_' . $uniqueId . '.' . $extension;
        } else {
            // Fallback to original naming
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
        }

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
