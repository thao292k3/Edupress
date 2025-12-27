@extends('backend.instructor.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="mb-0 text-primary font-weight-bold">
                            <i class="fas fa-plus-circle mr-2"></i>Thêm Câu Hỏi Mới
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="post" action="{{ route('instructor.assessments.store') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label class="form-label font-weight-600">
                                    <i class="fas fa-question-circle text-muted mr-1"></i> Nội dung câu hỏi
                                </label>
                                <textarea name="question" class="form-control form-control-lg shadow-none" rows="3"
                                    placeholder="Nhập câu hỏi tại đây..." required style="border-radius: 10px; border: 1px solid #e0e0e0;"></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label font-weight-600">
                                    <i class="fas fa-list-ul text-muted mr-1"></i> Các lựa chọn trả lời
                                </label>
                                <small class="text-muted d-block mb-2">Nhập mỗi phương án trên một dòng khác nhau.</small>
                                <textarea name="options_text" class="form-control shadow-none" rows="5" required
                                    placeholder="Example:&#10;Chưa biết gì|1|Beginner&#10;Biết cơ bản|2|Intermediate&#10;Thành thạo|3|Advanced"
                                    style="border-radius: 10px; border: 1px solid #e0e0e0;"></textarea>
                                <small class="form-text text-muted">Weight should be a small integer; level is optional
                                    (Beginner/Intermediate/Advanced).</small>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label font-weight-600">
                                    <i class="fas fa-check-double text-success mr-1"></i> Đáp án đúng
                                </label>
                                <input type="text" name="correct_option" class="form-control shadow-none"
                                    placeholder="Nhập chính xác nội dung của đáp án đúng"
                                    style="border-radius: 8px; border: 1px solid #e0e0e0; height: 45px;">
                                <label>Correct option (optional)</label>
                            </div>

                            <hr class="my-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ url()->previous() }}" class="btn btn-light px-4">Quay lại</a>
                                <button type="submit" class="btn btn-primary px-5 shadow-sm" style="border-radius: 8px;">
                                    <i class="fas fa-save mr-2"></i> Lưu câu hỏi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-label {
            color: #444;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .form-control:focus {
            border-color: #4e73df !important;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1) !important;
        }

        .font-weight-600 {
            font-weight: 600;
        }
    </style>
@endsection
