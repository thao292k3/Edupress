@extends('frontend.master')

@extends('frontend.master')

@section('content')
<style>
    /* Tùy chỉnh giao diện câu hỏi đẹp hơn */
    .assessment-container {
        max-width: 800px;
        margin: 50px auto;
    }
    .question-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
    }
    .question-title {
        font-weight: 700;
        color: #2d3a4b;
        margin-bottom: 20px;
        font-size: 1.2rem;
    }
    /* Biến radio thành các ô chọn sang trọng */
    .option-item {
        display: block;
        position: relative;
        padding: 15px 20px 15px 50px;
        margin-bottom: 12px;
        cursor: pointer;
        background: #f8f9fa;
        border: 2px solid #f1f3f5;
        border-radius: 10px;
        transition: all 0.2s;
    }
    .option-item:hover {
        background: #eef2ff;
        border-color: #4e73df;
    }
    .option-item input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    .checkmark {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 2px solid #ced4da;
        border-radius: 50%;
    }
    .option-item input:checked ~ .checkmark {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    .option-item input:checked ~ .checkmark:after {
        content: "";
        position: absolute;
        display: block;
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    .option-item input:checked + span {
        font-weight: 600;
        color: #4e73df;
    }
    .btn-submit {
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: #4e73df;
        border: none;
        box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
    }
</style>

<div class="container assessment-container">
    <div class="text-center mb-5">
        <h3 class="font-weight-bold">Đánh giá kỹ năng nhanh</h3>
        <p class="text-muted">Chỉ mất 1 phút để chúng tôi tìm ra lộ trình học tập tối ưu cho bạn.</p>
    </div>

    <form method="post" action="{{ route('assessment.submit') }}" id="assessmentForm">
        @csrf
        
        @if(!empty($questions) && $questions->count())
            @foreach($questions as $idx => $q)
                <div class="card question-card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <label class="question-title">
                            <span class="text-primary mr-2">Câu {{ $idx + 1 }}:</span> {{ $q->question }}
                        </label>
                        
                        <div class="options-group">
                            @foreach($q->options as $opt)
                                @php
                                    $text = is_array($opt) ? ($opt['text'] ?? '') : (is_object($opt) ? ($opt->text ?? '') : $opt);
                                    $weight = is_array($opt) ? ($opt['weight'] ?? 1) : (is_object($opt) ? ($opt->weight ?? 1) : 1);
                                @endphp
                                <label class="option-item">
                                    <input type="radio" name="answers[q{{ $q->id }}]" value="{{ $weight }}" required>
                                    <span>{{ $text }}</span>
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            {{-- Mẫu hiển thị nếu không có dữ liệu --}}
            <div class="alert alert-info text-center shadow-sm" style="border-radius:15px">
                <i class="la la-info-circle mr-2"></i> Hiện chưa có câu hỏi nào được tải lên hệ thống.
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mt-5">
            <a class="btn btn-link text-muted" href="{{ route('frontend.home') }}">
                <i class="la la-arrow-left"></i> Quay lại trang chủ
            </a>
            <button class="btn btn-primary btn-submit" type="submit">
                Hoàn thành & Xem kết quả <i class="la la-check-circle ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
    // Một chút JS để tạo hiệu ứng mượt mà khi chọn
    document.querySelectorAll('.option-item input').forEach(input => {
        input.addEventListener('change', function() {
            // Xóa class active ở các option cùng câu hỏi
            let parent = this.closest('.options-group');
            parent.querySelectorAll('.option-item').forEach(item => {
                item.style.borderColor = '#f1f3f5';
                item.style.background = '#f8f9fa';
            });
            
            // Thêm style cho item được chọn
            if(this.checked) {
                this.parentElement.style.borderColor = '#4e73df';
                this.parentElement.style.background = '#eef2ff';
            }
        });
    });
</script>
@endsection

