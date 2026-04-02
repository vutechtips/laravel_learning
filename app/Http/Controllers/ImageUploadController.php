<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            $manager = new ImageManager(new Driver());

            foreach ($request->file('images') as $index => $image) {
                // Tạo tên file mới
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $path = 'properties/' . date('Y/m');

                // Resize & lưu ảnh
                $img = $manager->read($image->getRealPath());
                $img->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Lưu ảnh gốc
                $fullPath = $path . '/' . $imageName;
                $img->save(public_path('storage/' . $fullPath), 85);

                // Tạo thumbnail
                $thumbName = 'thumb_' . $imageName;
                $img->resize(400, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path('storage/' . $path . '/' . $thumbName), 75);

                $uploadedImages[] = [
                    'path' => $fullPath,
                    'thumb' => $path . '/' . $thumbName,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'images' => $uploadedImages
        ]);
    }
}
