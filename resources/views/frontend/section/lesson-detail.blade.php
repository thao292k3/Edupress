@extends('frontend.master')

@section('content')
    @php

        $videoUrl = $lesson->url ?? ($lesson->video_url ?? '');
        $isYoutube = str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be');
        $youtubeId = null;
        if ($isYoutube) {
            preg_match(
                '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                $videoUrl,
                $match,
            );
            $youtubeId = $match[1] ?? null;
        }

        $user = auth()->user();
        $courseIsFree = ($course->selling_price ?? 0) <= 0;
        $isEnrolled = $user
            ? \App\Models\CourseEnrollment::where('course_id', $course->id)->where('user_id', $user->id)->exists()
            : false;
        $canView = $isEnrolled || $courseIsFree || $lesson->is_preview == 1;
    @endphp

    <style>
        .learning-wrapper {
            background: #f0f2f5;
            padding: 30px 0;
            min-height: 100vh;
            font-family: sans-serif;
        }


        .video-main-container {
            background: #000;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            width: 100%;
            padding-top: 56.25%;

        }

        .video-main-container iframe,
        .video-main-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .course-sidebar {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: 600px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-title {
            padding: 15px;
            border-bottom: 2px solid #eee;
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .sidebar-sections {
            flex: 1;
            overflow-y: auto;
        }

        .section-header {
            background: #f8f9fa;
            padding: 12px 15px;
            font-weight: 600;
            border-bottom: 1px solid #eee;
            color: #555;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
        }

        .lesson-list {
            display: block;
        }



        .lesson-item-row {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none !important;
            color: #444;
            border-bottom: 1px solid #f9f9f9;
            font-size: 14px;
        }

        .lesson-item-row:hover {
            background: #f0f7ff;
        }

        .lesson-item-row.active {
            background: #e7f1ff;
            border-left: 4px solid #007bff;
            color: #007bff;
            font-weight: 600;
        }

        .lesson-item-row i {
            margin-right: 10px;
            font-size: 18px;
        }

        .quiz-row {
            color: #dc3545;
            background: #fff5f5;
        }

        .lesson-info {
            background: #fff;
            margin-top: 20px;
            padding: 20px;
            border-radius: 8px;
        }

        .lesson-item-row.locked {
            pointer-events: none;
            opacity: 0.6;
            cursor: not-allowed;


        }

        .lesson-item-row.locked {
            opacity: 0.6;
            cursor: not-allowed;
            background-color: #f8f9fa;
            pointer-events: none;
            /* Ngăn chặn mọi tương tác click */
        }

        .lesson-item-row.locked i.la-lock {
            color: #dc3545;
        }

        .video-main-container {
            background: #000;
            aspect-ratio: 16/9;
            width: 100%;
            position: relative;
        }
    </style>

    <div class="learning-wrapper py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="video-main-container shadow rounded overflow-hidden"
                        style="background: #1a1a1a; min-height: 650px; display: flex; align-items: center; justify-content: center;">
                        @if ($canView)

                            @if (!empty($lesson->quiz_id))
                                <div class="quiz-display-area text-center p-5 w-100">
                                    <div class="icon-box mb-4">
                                        <i class="la la-check-square text-primary" style="font-size: 80px;"></i>
                                    </div>
                                    <h2 class="text-white mb-3">Bài kiểm tra: {{ $lesson->lecture_title }}</h2>
                                    <p class="text-light mb-4">Vui lòng hoàn thành bài thi này để hệ thống ghi nhận tiến độ
                                        của bạn.</p>


                                    <a href="{{ route('quiz.take', $lesson->quiz_id) }}"
                                        class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">
                                        <i class="fas fa-edit me-2"></i> NHẤN VÀO ĐÂY ĐỂ LÀM BÀI QUIZ
                                    </a>


                                    @php
                                        $quizResult = \App\Models\QuizResult::where('user_id', auth()->id())
                                            ->where('quiz_id', $lesson->quiz_id)
                                            ->latest()
                                            ->first();
                                    @endphp
                                    @if ($quizResult)
                                        <div class="mt-4 p-3 rounded style="background: rgba(255,255,255,0.1)">
                                            <p class="text-success mb-0">Kết quả gần nhất: {{ $quizResult->score }}đ
                                                ({{ $quizResult->status }})</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                @if ($isYoutube && $youtubeId)
                                    <div id="youtube-player" style="width: 100%; height: 450px;"></div>
                                @elseif($videoUrl)
                                    <video id="player" controls autoplay style="width:100%; max-height: 450px;">
                                        <source src="{{ asset($videoUrl) }}" type="video/mp4">
                                    </video>
                                @endif
                            @endif
                        @else
                            <div class="text-white text-center">
                                <h4>Vui lòng đăng ký để xem nội dung</h4>
                            </div>
                        @endif
                    </div>

                    <div class="lesson-info shadow-sm bg-white p-4 mt-4 rounded">
                        <h2 class="h4 font-weight-bold">{{ $lesson->lecture_title }}</h2>
                        <hr>
                        <div class="mt-3 text-muted">{!! $lesson->content !!}</div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="course-sidebar shadow-sm bg-white rounded">
                        <div class="sidebar-title p-3 border-bottom font-weight-bold">Nội dung khóa học</div>

                        <div class="p-3 bg-light border-bottom">
                            <div class="d-flex justify-content-between mb-1">
                                <p class="fs-14">Tiến độ bài học: {{ $completed_lessons_count }}/{{ $total_lessons }} Video
                                </p>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $percentage }}%">{{ $percentage }}%</div>
                                </div>
                            </div>
                            <div class="progress" style="height: 10px; border-radius: 5px;">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                    role="progressbar" style="width: {{ $percentage ?? 0 }}%"></div>
                            </div>
                        </div>

                        <div class="sidebar-sections">
                            @php
                                $canNext = true;
                                $progressData = \DB::table('lesson_progress')
                                    ->where('user_id', Auth::id())
                                    ->where('course_id', $course->id)
                                    ->pluck('is_completed', 'lesson_id')
                                    ->toArray();
                            @endphp

                            @foreach ($course_content as $section)
                                <div class="section-header bg-light p-2 font-weight-bold">
                                    <span>{{ $section->title }}</span>
                                </div>
                                <div class="lesson-list">

                                    @php
                                        $canNext = true; 
                                    @endphp

                                    @foreach ($section->lesson as $l)
                                        @php
                                            
                                            $isDone = isset($progressData[$l->id]) && $progressData[$l->id] == 1;

                                           
                                            $isLocked = !$canNext && $l->is_preview != 1;
                                        @endphp

                                        <a href="{{ $isLocked ? 'javascript:void(0)' : route('frontend.lesson.show', $l->id) }}"
                                            class="lesson-item-row {{ $l->id == $lesson->id ? 'active' : '' }} {{ $isLocked ? 'locked' : '' }} d-flex align-items-center p-2"
                                            @if ($isLocked) onclick="alert('Bạn cần hoàn thành bài học trước đó!')" @endif>
                                            <i
                                                class="la {{ $isDone ? 'la-check-circle text-success' : ($isLocked ? 'la-lock text-muted' : 'la-play-circle text-primary') }} me-2"></i>
                                            <span>{{ $l->lecture_title }}</span>
                                        </a>

                                        @php
                                            
                                            if (!$isDone) {
                                                $canNext = false;
                                            }
                                        @endphp
                                    @endforeach


                                    @foreach ($section->quizzes as $quiz)
                                        @php
                                            $quizLesson = \App\Models\Lesson::where('quiz_id', $quiz->id)->first();
                                            $quizDone = false;
                                            if ($quizLesson) {
                                                $quizDone =
                                                    isset($progressData[$quizLesson->id]) &&
                                                    $progressData[$quizLesson->id] == 1;
                                            }
                                            $quizLocked = !$canNext;
                                        @endphp

                                        <a href="{{ $quizLocked ? 'javascript:void(0)' : route('quiz.take', $quiz->id) }}"
                                            class="lesson-item-row d-flex align-items-center p-2 mb-1 rounded {{ $quizLocked ? 'opacity-50' : '' }} {{ $quizDone ? 'bg-light' : '' }}"
                                            style="text-decoration: none; color: #333; border-bottom: 1px solid #eee;"
                                            @if ($quizLocked) onclick="alert('Hoàn thành bài học trước để làm bài kiểm tra!')" @endif>

                                            <div class="flex-shrink-0 me-2">
                                                @if ($quizDone)
                                                    <i class="fas fa-check-circle text-success"></i>
                                                @elseif($quizLocked)
                                                    <i class="la la-lock text-muted"></i>
                                                @else
                                                    <i class="la la-question-circle text-primary"></i>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <span
                                                    style="font-size: 14px; font-weight: {{ $quizDone ? '400' : '500' }}">
                                                    Quiz: {{ $quiz->title }}
                                                </span>
                                            </div>
                                        </a>

                                        @php

                                            if (!$quizDone) {
                                                $canNext = false;
                                            }
                                        @endphp
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var youtubePlayer;


        function triggerSaveProgress() {
            console.log("Đang kích hoạt lưu tiến độ...");
            $.ajax({
                url: "{{ route('mark.watched', $lesson->id) }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    is_completed: 1
                },
                success: function(response) {
                    if (response.ok) {
                        console.log("Thành công: Dữ liệu đã vào DB");
                        location.reload();
                    }
                },
                error: function(xhr) {
                    console.error("Lỗi Server:", xhr.responseText);
                }
            });
        }


        function onYouTubeIframeAPIReady() {
            @if ($isYoutube && $youtubeId)
                youtubePlayer = new YT.Player('youtube-player', {
                    height: '100%',
                    width: '100%',
                    videoId: '{{ $youtubeId }}',
                    playerVars: {
                        'autoplay': 1,
                        'rel': 0
                    },
                    events: {
                        'onStateChange': function(event) {

                            if (event.data == YT.PlayerState.ENDED) {
                                triggerSaveProgress();
                            }
                        }
                    }
                });
            @endif
        }


        document.addEventListener('DOMContentLoaded', function() {
            var mp4Player = document.getElementById('player');
            if (mp4Player) {
                mp4Player.onended = function() {
                    triggerSaveProgress();
                };
            }
        });
    </script>
@endpush
