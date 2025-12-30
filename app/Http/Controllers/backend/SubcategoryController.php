<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{

    protected $subCategoryService;

    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }

    public function index()
    {
        $all_subcategories = SubCategory::with('category')->latest()->get();
        return view('backend.admin.subcategory.index', compact('all_subcategories'));
    }

    
    public function create()
    {
        $all_categories = Category::orderBy('name', 'asc')->get();
        return view('backend.admin.subcategory.create', compact('all_categories'));
    }

  
    public function store(SubCategoryRequest $request)
    {
        
        $this->subCategoryService->saveSubCategory($request->validated());
        return redirect()->back()->with('success', 'Danh mục con đã được tạo thành công');
    }


    public function edit(string $id)
    {
        $sub_category = SubCategory::find($id);
        $all_categories = Category::latest()->get();
        return view('backend.admin.subcategory.edit', compact('sub_category', 'all_categories'));
    }

    
    public function update(SubCategoryRequest $request, string $id)
    {
        $this->subCategoryService->updateSubCategory($request->validated(), $id);
        return redirect()->back()->with('success', 'Danh mục con đã được cập nhật thành công');
    }

    
    public function destroy(string $id)
    {
      
        $subCategory = SubCategory::withCount('courses')->findOrFail($id);

        
        if ($subCategory->courses_count > 0) {
            return redirect()->back()->with('error', 'Không thể xóa! Danh mục con này đang chứa ' . $subCategory->courses_count . ' khóa học.');
        }

        
        $subCategory->delete();

        return redirect()->route('admin.subcategory.index')->with('success', 'Danh mục con đã được xóa thành công.');
    }

    
}