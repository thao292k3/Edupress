<?php
namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Hash;
class CategoryService
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

     public function saveCategory(array $data, $image = null)
    {

        return $this->categoryRepository->saveCategory($data, $image);
    }
    public function updateCategory(array $data, $image = null, $id)
    {
        return $this->categoryRepository->updateCategory($data, $image, $id);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}



