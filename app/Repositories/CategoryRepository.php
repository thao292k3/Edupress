<?php

namespace App\Repositories;

use App\Models\Category;

use \App\Traits\FileUploadTrait;

class CategoryRepository
{
    use FileUploadTrait;

   

    public function saveCategory(array $data, $image)
    {
        $category = new Category();

        // Handle file upload
        if ($image) {
            $data['image'] = $this->uploadFile($image, 'category', $category->image);
        }

        $category->create($data); //lưu trử tất cả dữ liệu trừ ảnh
        // if ($image) {
        //     $category->addMedia($image)->toMediaCollection('category_photos');
        // }
        return $category;

    }
    public function updateCategory(array $data, $image, $id)
{
    $category = Category::findOrFail($id);

    // Nếu upload ảnh mới
    if ($image) {
        $data['image'] = $this->uploadFile($image, 'category', $category->image);
    } else {
       
        $data['image'] = $category->image;
    }

    $category->update($data);

    return $category;
}

    
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        // if ($category->hasMedia('category_photos')) {
        //     $category->clearMediaCollection('category_photos');
        // }
        $category->delete();
    }
    
}
