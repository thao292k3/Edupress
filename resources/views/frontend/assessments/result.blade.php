@extends('frontend.master')

@section('content')
    <style>
        .result-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 60px 20px;
            margin-bottom: -50px;
            /* Tạo hiệu ứng thẻ đè lên nền */
            position: relative;
            z-index: 1;
        }

        .result-card {
            background: #fff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 2;
        }

        .score-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 8px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.1);
        }

        .level-badge {
            padding: 8px 25px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .course-card-custom {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #eee;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .course-img-wrapper {
            position: relative;
            height: 180px;
        }

        .course-img-wrapper img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .price-tag {
            font-size: 1.25rem;
            font-weight: 800;
            color: #2d3a4b;
        }

        .btn-details {
            border-radius: 8px;
            font-weight: 600;
            padding: 10px;
        }
    </style>

    <div class="container py-5">
        <div class="result-header text-center">
            <div class="score-circle">
                <h2 class="mb-0 text-white font-weight-bold">{{ round($score ?? $percent) }}%</h2>
            </div>
            <h3 class="font-weight-bold mb-2">Chúc mừng bạn đã hoàn thành!</h3>
            <p class="opacity-75">Dựa trên câu trả lời, đây là lộ trình học tập tối ưu cho bạn.</p>
        </div>

        <div class="card result-card mx-auto" style="max-width: 1000px;">
            <div class="card-body p-5">
                <div class="text-center mb-5">
                    <p class="text-muted mb-2 font-weight-medium">Trình độ hiện tại của bạn là:</p>
                    <span
                        class="level-badge {{ $level == 'Advanced' ? 'bg-success' : ($level == 'Intermediate' ? 'bg-warning' : 'bg-info') }} text-white shadow-sm">
                        <i class="la la-trophy mr-1"></i> {{ $level }}
                    </span>
                </div>

                <h5 class="font-weight-bold mb-4" style="color: #2d3a4b;">
                    <i class="la la-graduation-cap text-primary"></i> Khóa học dành riêng cho bạn
                </h5>

                <div class="row">
                    @if (isset($suggestedCourses) && $suggestedCourses->count() > 0)
                        @foreach ($suggestedCourses as $course)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card course-card-custom h-100">
                                    <div class="course-img-wrapper">
                                        <img src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
                                        <div class="position-absolute top-0 right-0 p-2">
                                            <span class="badge badge-light shadow-sm">{{ $level }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column p-3">
                                        <h6 class="font-weight-bold mb-2"
                                            style="line-height: 1.5; height: 45px; overflow: hidden;">
                                            {{ Str::limit($course->course_name, 50) }}
                                        </h6>
                                        <p class="text-muted small mb-3">
                                            <i class="la la-user"></i> {{ $course->user->name ?? 'Giảng viên chuyên gia' }}
                                        </p>
                                        <div
                                            class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                            <span class="price-tag"
                                                style="color: #e74c3c; font-weight: 800; font-size: 1.1rem;">
                                                {{ number_format($course->discount_price, 0, ',', '.') }}đ
                                            </span>



                                            <a href="{{ route('course-details', $course->course_name_slug) }}"
                                                class="btn btn-primary btn-details"> Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="py-5 text-center bg-light rounded-lg">
                                <i class="la la-search mb-3 text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted">Chúng tôi chưa tìm thấy khóa học nào phù hợp 100% với trình độ này.
                                    Hãy thử quay lại sau!</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('frontend.home') }}" class="btn btn-link text-muted mr-3">
                        <i class="la la-home"></i> Trang chủ
                    </a>
                    <a href="{{ url('/skill-assessment') }}" class="btn btn-outline-primary px-4"
                        style="border-radius: 10px;">
                        Làm lại bài test
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
