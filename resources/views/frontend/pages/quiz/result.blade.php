@extends('frontend.master')

@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
                <div class="media media-card align-items-center">
                    <div class="media-img media--img radius-round">
                        <img class="mr-3" id="photoPreview"
                            src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('frontend/images/team11.jpg') }}"
                            alt="avatar image">
                    </div>
                    <div class="media-body">
                        <h2 class="section__title fs-30">Kết quả bài kiểm tra</h2>
                        <p class="section__desc">Chúc mừng bạn đã hoàn thành bài thi!</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-item">
                        <div class="card-body">
                            <div class="quiz-result-header d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h3 class="fs-24 font-weight-semi-bold">{{ $quiz->title }}</h3>
                                    <p class="pt-2">Khóa học: <span
                                            class="text-color font-weight-medium">{{ $quiz->course->course_name }}</span>
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="badge {{ $isPassed ? 'badge-success' : 'badge-danger' }} p-2 fs-16">
                                        {{ $isPassed ? 'ĐÃ VƯỢT QUA' : 'CHƯA ĐẠT' }}
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-item border border-gray p-3 text-center">
                                        <h4 class="fs-18 font-weight-semi-bold">Điểm số</h4>
                                        <p class="fs-24 text-primary font-weight-bold pt-1">{{ $totalMarks }} /
                                            {{ $quiz->total_marks }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-item border border-gray p-3 text-center">
                                        <h4 class="fs-18 font-weight-semi-bold">Tỷ lệ đúng</h4>
                                        <p class="fs-24 text-success font-weight-bold pt-1">{{ round($percentage, 2) }}%</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-item border border-gray p-3 text-center">
                                        <h4 class="fs-18 font-weight-semi-bold">Câu đúng</h4>
                                        <p class="fs-24 text-info font-weight-bold pt-1">{{ $correctCount }} /
                                            {{ $quiz->questions->count() }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-item border border-gray p-3 text-center">
                                        <h4 class="fs-18 font-weight-semi-bold">Yêu cầu</h4>
                                        <p class="fs-24 text-warning font-weight-bold pt-1">{{ $quiz->pass_score }}%</p>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-box mt-5 d-flex justify-content-center">
                                @if ($nextLesson)
                                    <a href="{{ route('frontend.lesson.show', $nextLesson->id) }}"
                                        class="btn theme-btn mr-3">
                                        Tiếp tục bài học <i class="la la-arrow-right ml-1"></i>
                                    </a>
                                @else
                                    <a href="{{ route('course-details', $quiz->course->course_name_slug) }}"
                                        class="btn theme-btn mr-3">
                                        Quay lại khóa học
                                    </a>
                                @endif

                                
                                @if (!$isPassed)
                                    <a href="{{ route('quiz.take', $quiz->id) }}"
                                        class="btn theme-btn theme-btn-transparent">
                                        <i class="la la-refresh mr-1"></i> Thi lại ngay
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
