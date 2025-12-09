<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait FileUploadTrait
{
    public function uploadFile($file, $folder, $existingFile = null)
    {
        // Nếu không có file upload → giữ lại file cũ
        if (!$file instanceof UploadedFile) {
            return $existingFile;
        }

        // Đảm bảo file tạm tồn tại
        if (!is_file($file->getPathname())) {
            return $existingFile; // không xử lý file không tồn tại
        }

        $targetFolder = public_path('uploads/' . $folder);

        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0755, true);
        }

        // Xóa ảnh cũ nếu có
        if ($existingFile && file_exists(public_path($existingFile))) {
            @unlink(public_path($existingFile));
        }

        // Tạo tên file mới
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Upload file mới
        $file->move($targetFolder, $fileName);

        return 'uploads/' . $folder . '/' . $fileName;
    }

    public function deleteFile($path)
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
