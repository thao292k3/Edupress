@extends('frontend.master')

@section('content')
    <div class="container py-5">
        <div class="section-heading mb-5">
            <h2 class="section__title">Khóa học của tôi</h2>
            <p class="section__desc">Tiếp tục hành trình chinh phục kiến thức của bạn.</p>
        </div>

        @if ($courses->isEmpty())
            <div class="alert alert-info">Bạn chưa đăng ký khóa học nào.</div>
        @else
            <div class="row">
                @foreach ($courses as $item)
                    
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card card-item shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                            
                            <img src="{{ asset($item->course->course_image) }}" class="card-img-top"
                                alt="{{ $item->course->course_name }}">

                            <div class="card-body">
                                <h5 class="card-title font-weight-bold fs-18">{{ $item->course->course_name }}</h5>

                                <div class="progress-wrapper my-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fs-14 text-muted">Tiến độ học tập</span>
                                        
                                        <span class="fs-14 font-weight-bold text-primary">0%</span>
                                    </div>
                                    <div class="progress" style="height: 8px; border-radius: 5px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>

                                <div class="btn-box d-flex justify-content-between mt-4">
                                    
                                    <a href="{{ route('course-details', $item->course->course_name_slug) }}"
                                        class="btn btn-outline-secondary btn-sm radius-md">Chi tiết</a>

                                    
                                    <a href="{{ route('course-details', $item->course->course_name_slug) }}" class="btn btn-primary btn-sm radius-md">Vào học ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .card-item {
            transition: transform 0.3s;
        }

        .card-item:hover {
            transform: translateY(-5px);
        }

        .radius-md {
            border-radius: 8px;
            padding: 8px 15px;
        }
    </style>
@endsection
