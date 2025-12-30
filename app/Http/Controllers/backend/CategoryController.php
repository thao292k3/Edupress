<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $all_categories = Category::latest()->get();
        return view('backend.admin.category.index', compact('all_categories'));
    }

    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        // $data = $request->validated();
        // $photo = $request->file('image');

        $this->categoryService->saveCategory($request->validated(), $request->file('image'));

        return redirect()->back()->with('success', 'Danh mục đã được tạo thành công.');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.admin.category.edit', compact('category'));
    }


    public function update(CategoryRequest $request, string $id)
    {
        $this->categoryService->updateCategory($request->validated(), $request->file('image'), $id);
        return redirect()->back()->with('success', 'Danh mục đã được cập nhật thành công.');
    }


    public function destroy($id)
    {
      
        $category = Category::withCount(['subcategories', 'courses'])->findOrFail($id);

        
        if ($category->subcategories_count > 0) {
            return redirect()->back()->with('error', 'Không thể xóa! Danh mục này đang có ' . $category->subcategories_count . ' danh mục con.');
        }

        
        if ($category->courses_count > 0) {
            return redirect()->back()->with('error', 'Không thể xóa! Danh mục này đang có ' . $category->courses_count . ' khóa học trực thuộc.');
        }

        
        if ($category->image) {
            $imagePath = public_path(parse_url($category->image, PHP_URL_PATH));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được xóa thành công.');
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();

        return response()->json($subcategories);
    }


}
