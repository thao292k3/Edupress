@extends('backend.admin.master')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">Chỉnh sửa bài viết</h6>
            <hr/>
            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Tiêu đề bài viết</label>
                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh hiện tại</label><br>
                    <img src="{{ asset($blog->image) }}" style="width: 100px; margin-bottom: 10px;">
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung</label>
                    <textarea name="description" id="editor" class="form-control">{{ $blog->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endsection