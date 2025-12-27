@extends('frontend.master')

@section('content')
@php
    
    $videoUrl = $lesson->url ?? ($lesson->video_url ?? '');
    $isYoutube = str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be');
    $youtubeId = null;
    if ($isYoutube) {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoUrl, $match);
        $youtubeId = $match[1] ?? null;
    }
    
    // Kiểm tra quyền xem
    $user = auth()->user();
    $courseIsFree = ($course->selling_price ?? 0) <= 0;
    $isEnrolled = $user ? \App\Models\CourseEnrollment::where('course_id', $course->id)->where('user_id', $user->id)->exists() : false;
    $canView = $isEnrolled || $courseIsFree || ($lesson->is_preview == 1);
@endphp

<style>
    .learning-wrapper { background: #f0f2f5; padding: 30px 0; min-height: 100vh; font-family: sans-serif; }
    /* Fix lỗi Video bị nhỏ */
    .video-main-container { background: #000; border-radius: 8px; overflow: hidden; position: relative; width: 100%; padding-top: 56.25%; /* Tỉ lệ 16:9 */ }
    .video-main-container iframe, .video-main-container video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; }
    
    /* Sidebar thiết kế đơn giản, không dùng Bootstrap Accordion để tránh lỗi JS */
    .course-sidebar { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); height: 600px; display: flex; flex-direction: column; }
    .sidebar-title { padding: 15px; border-bottom: 2px solid #eee; font-weight: bold; font-size: 18px; color: #333; }
    .sidebar-sections { flex: 1; overflow-y: auto; }
    
    .section-header { background: #f8f9fa; padding: 12px 15px; font-weight: 600; border-bottom: 1px solid #eee; color: #555; display: flex; justify-content: space-between; cursor: pointer; }
    .lesson-list { display: block; } /* Để mặc định hiện tất cả bài học */
    
    .lesson-item-row { display: flex; align-items: center; padding: 10px 15px; text-decoration: none !important; color: #444; border-bottom: 1px solid #f9f9f9; font-size: 14px; }
    .lesson-item-row:hover { background: #f0f7ff; }
    .lesson-item-row.active { background: #e7f1ff; border-left: 4px solid #007bff; color: #007bff; font-weight: 600; }
    .lesson-item-row i { margin-right: 10px; font-size: 18px; }
    
    .quiz-row { color: #dc3545; background: #fff5f5; }
    
    .lesson-info { background: #fff; margin-top: 20px; padding: 20px; border-radius: 8px; }
</style>

<div class="learning-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="video-main-container">
                    @if($canView)
                        @if($isYoutube && $youtubeId)
                            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&rel=0" allowfullscreen allow="autoplay"></iframe>
                        @elseif($videoUrl)
                            <video id="player" controls autoplay>
                                <source src="{{ asset($videoUrl) }}" type="video/mp4">
                            </video>
                        @else
                            <div class="text-white d-flex align-items-center justify-content-center h-100">Chưa có video</div>
                        @endif
                    @else
                        <div class="text-white text-center p-5">
                            <i class="la la-lock fs-50 mb-3 text-warning"></i>
                            <h4>Vui lòng đăng ký để xem nội dung</h4>
                            <a href="{{ route('course.view', $quiz->course->course_name_slug) }}" class="btn btn-primary mt-3">Mua khóa học</a>
                        </div>
                    @endif
                </div>

                <div class="lesson-info shadow-sm">
                    <h2>{{ $lesson->lecture_title }}</h2>
                    <div class="mt-3 text-muted">{!! $lesson->content !!}</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="course-sidebar shadow-sm">
                    <div class="sidebar-title">Nội dung khóa học</div>
                    <div class="sidebar-sections">
                        @foreach ($course_content as $section)
                            <div class="section-group">
                                <div class="section-header">
                                    <span>{{ $section->title }}</span>
                                    <i class="la la-angle-down"></i>
                                </div>
                                <div class="lesson-list">
                                    @foreach ($section->lesson as $l)
                                        <a href="{{ route('frontend.lesson.show', $l->id) }}" 
                                           class="lesson-item-row {{ $l->id == $lesson->id ? 'active' : '' }}">
                                            <i class="la la-play-circle"></i>
                                            <span>{{ $l->lecture_title }}</span>
                                        </a>
                                    @endforeach
                                    
                                    @if($section->quizzes)
                                        @foreach($section->quizzes as $quiz)
                                            <a href="{{ route('quiz.take', $quiz->id) }}" class="lesson-item-row quiz-row">
                                                <i class="la la-question-circle"></i>
                                                <span>Bài kiểm tra: {{ $quiz->title }}</span>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection