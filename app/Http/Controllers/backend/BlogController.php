<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use FileUploadTrait;

    public function index() {
        $blogs = Blog::latest()->get();
        return view('backend.admin.blog.index', compact('blogs'));
    }

    public function create() {
        return view('backend.admin.blog.create');
    }

    public function store(Request $request) {
        $request->validate(['title' => 'required', 'description' => 'required']);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), 'blogs'); 
        }

        Blog::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'Thêm bài viết thành công');
    }

    public function edit($id) {
    $blog = Blog::findOrFail($id);
    return view('backend.admin.blog.edit', compact('blog'));
}

public function update(Request $request, $id) {
    $blog = Blog::findOrFail($id);
    $data = $request->all();
    
    if ($request->hasFile('image')) {
        
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }
        
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/blogs'), $imageName);
        $data['image'] = 'uploads/blogs/'.$imageName;
    }

    $blog->update($data);
    return redirect()->route('admin.blog.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id) {
        $blog = Blog::findOrFail($id);
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }
        $blog->delete();
        return redirect()->back()->with('success', 'Xóa bài viết thành công');
    }
}
