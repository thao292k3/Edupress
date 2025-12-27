

@extends('backend.admin.master')

@section('content')
    <div class="page-content">

        @include('backend.section.breadcrumb', ['title' => 'Category', 'sub_title' => 'Insert-Category']);


        <div class="card col-md-8">

            <div class="card-body">

                <div class="card-body p-4">

                    <div style="display: flex; align-items:center; justify-content:space-between">
                        <h5 class="mb-4">Thêm mới bài viết</h5>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Quay lại</a>

                    </div>

                    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Nội dung</label>
                            <textarea name="description" id="editor" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Hình ảnh</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu bài viết</button>
                    </form>
                </div>

            </div>

        </div>


    </div>
@endsection

@push('scripts')
    <script src="{{ asset('customjs/admin/category.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
