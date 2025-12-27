<div class="course-overview-card">
    <h3 class="fs-24 font-weight-semi-bold pb-3">Description</h3>

    <!-- Truncated Description -->
    <div class="">
        {!! $course->description !!}
    </div>


</div>


<div class="course-overview-card">
    <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
        <h3 class="fs-24 font-weight-semi-bold">Course content</h3>
        <div class="curriculum-duration fs-15">
            <span class="curriculum-total__text mr-2"><strong class="text-black font-weight-semi-bold">Total:</strong>
                {{ $total_lecture }} lesson</span>


            <span class="curriculum-total__hours"><strong class="text-black font-weight-semi-bold">Total hours:</strong>
                02:35:47</span>
        </div>
    </div>
    <div class="curriculum-content">
        <div id="accordion" class="generic-accordion">

            @foreach ($course_content as $index => $item)
                <div class="card">
                    <div class="card-header" id="heading-{{ $index }}">
                        <button class="btn btn-link d-flex align-items-center justify-content-between"
                            data-toggle="collapse" data-target="#collapse-{{ $index }}"
                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-controls="collapse-{{ $index }}">
                            <i class="la la-plus"></i>
                            <i class="la la-minus"></i>
                            {{ $item->section_title }}
                            <span class="fs-15 text-gray font-weight-medium">{{ $item['lesson']->count() }}
                                lesson</span>
                        </button>
                    </div><!-- end card-header -->
                    <div id="collapse-{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}"
                        aria-labelledby="heading-{{ $index }}" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="generic-list-item">

                                @foreach ($item['lesson'] as $lecture)
                                    @php
                                        $isLocked = true;

                                        
                                        if ($lecture->is_preview) {
                                            $isLocked = false;
                                        }
                                        
                                        elseif (auth()->check()) {
                                            $userProgress = \App\Models\LessonProgress::where('user_id', auth()->id())
                                                ->where('lesson_id', $lecture->id)
                                                ->first();

                                            if ($userProgress && $userProgress->is_completed) {
                                                $isLocked = false;
                                            }

                                            
                                            if (auth()->id() == $course->instructor_id) {
                                                $isLocked = false;
                                            }
                                        }
                                    @endphp
                                    <li>
                                        <div class="d-flex align-items-center justify-content-between py-2">
                                            <div>
                                                @if (!$isLocked)
                                                    
                                                    <a href="{{ route('frontend.lesson.show', $lecture->id) }}"
                                                        class="text-color">
                                                        <i class="la la-play-circle mr-1 text-primary"></i>
                                                        {{ $lecture->lecture_title }}
                                                        @if ($lecture->is_preview)
                                                            <span class="badge badge-info ml-1">Preview</span>
                                                        @endif
                                                    </a>
                                                @else
                                                  
                                                    <span class="text-muted"
                                                        title="Hãy mua khóa học hoặc hoàn thành bài trước đó">
                                                        <i class="la la-lock mr-1"></i> {{ $lecture->lecture_title }}
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <span class="fs-14 text-gray">{{ $lecture->duration }} min</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                                
                                @if ($item->quizzes && $item->quizzes->count() > 0)
                                    @foreach ($item->quizzes as $quiz)
                                        @php
                                            // Logic mở khóa Quiz: Nếu bài học cuối cùng của chương này đã xong
                                            $lastLesson = $item['lesson']->last();
                                            $canTakeQuiz = false;
                                            if ($lastLesson) {
                                                $lp = \App\Models\LessonProgress::where('user_id', auth()->id())
                                                    ->where('lesson_id', $lastLesson->id)
                                                    ->first();
                                                $canTakeQuiz = $lp && $lp->is_completed == 1;
                                            }
                                        @endphp
                                        <li class="bg-light p-2 mb-2 rounded border-left border-primary">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <i class="la la-question-circle mr-1 text-primary fs-18"></i>
                                                    <span class="font-weight-bold">Kiểm tra: {{ $quiz->title }}</span>
                                                </div>

                                                @if ($canTakeQuiz)
                                                    <a href="{{ route('quiz.take', $quiz->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        Làm bài ngay
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-secondary disabled"
                                                        onclick="alert('Hãy hoàn thành bài học cuối cùng để mở bài thi!')">
                                                        <i class="la la-lock"></i> Đang khóa
                                                    </button>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div><!-- end card-body -->
                    </div><!-- end collapse -->


                </div><!-- end card -->
            @endforeach



        </div><!-- end generic-accordion -->
    </div><!-- end curriculum-content -->

    
</div><!-- end course-overview-card -->

<div class="course-overview-card mt-4">
    <h3 class="fs-24 font-weight-semi-bold pb-3">Lớp học trực tuyến bổ sung</h3>

    @php
        $user = auth()->user();
        $isFree = $course->selling_price <= 0;
        $hasBought = $user
            ? \App\Models\Order::where('user_id', $user->id)->where('course_id', $course->id)->exists()
            : false;

        $canAccessCourse = $user && ($isFree || $hasBought || $user->id === $course->instructor_id);

        $liveSessions = \App\Models\LiveSessions::where('course_id', $course->id)->orderBy('start_at', 'asc')->get();
    @endphp

    <div class="live-list">
        @forelse($liveSessions as $session)
            @php

                $now = now();
                $startTime = \Carbon\Carbon::parse($session->start_at);
                $diffInMinutes = $now->diffInMinutes($startTime, false);

                $isTimeToGo = $diffInMinutes <= 15 && $now->lt($startTime->addMinutes($session->duration_minutes));
                $isInstructor = $user && $user->id === $course->instructor_id;
            @endphp

            <div class="card mb-3 border-gray"
                style="{{ !$canAccessCourse ? 'opacity: 0.5; filter: grayscale(1);' : '' }}">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <h5 class="fs-16 font-weight-bold mb-1">
                            <i class="la la-broadcast-tower {{ $isTimeToGo ? 'text-danger' : 'text-muted' }} mr-2"></i>
                            {{ $session->topic }}
                            @if ($isTimeToGo)
                                <span class="badge badge-danger ml-2 animate-pulse">ĐANG DIỄN RA</span>
                            @endif
                        </h5>
                        <p class="text-muted small mb-0">
                            <i class="la la-clock"></i> {{ $startTime->format('H:i d/m/Y') }}
                            ({{ $session->duration_minutes }} phút)
                        </p>
                    </div>

                    <div>
                        @if (!$canAccessCourse)
                            <button class="btn btn-sm btn-secondary"
                                onclick="alert('Vui lòng đăng ký khóa học để tham gia buổi này!')">
                                <i class="la la-lock"></i> Đã khóa
                            </button>
                        @elseif($isTimeToGo || $isInstructor)
                            <a href="{{ route('join.session', $session->id) }}"
                                class="btn btn-sm btn-success text-white">
                                Vào lớp ngay
                            </a>
                        @else
                            <button class="btn btn-sm btn-outline-secondary disabled"
                                title="Link sẽ mở trước giờ học 15 phút">
                                Chưa đến giờ
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted italic small">Chưa có lịch học trực tuyến.</p>
        @endforelse
    </div>
</div>

<style>
    @keyframes pulse {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }
    }

    .animate-pulse {
        animation: pulse 1.5s infinite;
    }
</style>
<script>
    // Thêm sự kiện cho các nút đã khóa
    document.querySelectorAll('.live-locked .btn-secondary').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            alert('Bạn không thuộc lớp này. Nếu muốn tham gia hãy đăng ký khóa học.');
        });
    });
</script>
