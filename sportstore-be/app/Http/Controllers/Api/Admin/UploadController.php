<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class UploadController extends Controller
{
    /**
     * Upload ảnh
     * 
     * @bodyParam image file required Ảnh cần upload.
     * @bodyParam folder string Thư mục con (VD: products, avatars). Default: 'uploads'
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'folder' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $folder = $request->input('folder', 'uploads');
            
            // Tạo tên file ngẫu nhiên
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($folder, $filename, 'public');
            
            // Trả về URL để frontend dùng làm preview/lưu vào DB
            $url = asset('storage/' . $folder . '/' . $filename);
            
            return ApiResponse::success([
                'url'      => $url,
                'path'     => 'public/' . $folder . '/' . $filename,
                'filename' => $filename
            ], 'Upload ảnh thành công');
        }

        return ApiResponse::error('Không tìm thấy file upload', 400);
    }
}
