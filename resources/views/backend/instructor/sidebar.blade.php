<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('instructor.dashboard') }}" class="has-arrow">
                <div class="parent-icon"><i class='fadeIn animated bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>

        @if (isApprovedUser())
            <li class="{{ setSidebar(['instructor.course*', 'instructor.course.section*']) }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-clipboard"></i>
                    </div>
                    <div class="menu-title">Quản lý khóa học </div>
                </a>

                <ul>

                    <li
                        class="{{ setSidebar(['instructor.course*', 'instructor.course.content', 'instructor.course-section', 'instructor.lessons*', 'instructor.videos*']) }}">
                        <a href="{{ route('instructor.course.index') }}">
                            <div class="parent-icon"><i class='bx bx-book-content'></i></div>
                            <div class="menu-title"> Khóa học</div>
                        </a>
                    </li>

                </ul>

                <li class="menu-label text-truncate mb-2" data-bs-toggle="tooltip" data-bs-placement="right"
                    title="Quiz & Questions">Quản lý Bài kiểm tra</li>

                <li class="nav-item">
                    <a href="{{ route('instructor.quizzes.index') }}"
                        class="nav-link @if (Route::is('instructor.quizzes.*')) active @endif">
                        <i class="fas fa-question-circle"></i>
                        <span class="text-truncate"> Quản lý Quiz</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('instructor.live-sessions.index') }}"
                        class="nav-link @if (Route::is('instructor.live-sessions.*')) active @endif">
                        <i class="fadeIn animated bx bx-video-recording"></i>
                        <span class="text-truncate"> Quản lý Buổi dạy Trực tiếp</span>
                    </a>
                </li>

                </li>



                <li class="{{ setSidebar(['instructor.coupon*']) }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-credit-card"></i>
                    </div>
                    <div class="menu-title">Phiếu giảm giá </div>
                </a>
                <ul>
                    <li class="{{ setSidebar(['instructor.coupon*']) }}">
                        <a href="{{route('instructor.coupon.index')}}"><i class='fas fa-'></i>Tất cả mã giảm giá </a>
                    </li>

                </ul>
        </li>
        @endif


    </ul>
    <!--end navigation-->
</div>
