<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <i class='bx bx-arrow-back'></i>
        </div>
    </div>

    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('instructor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Bảng điều khiển</div>
            </a>
        </li>

        @if (isApprovedUser())

            <li class="menu-label">Nội dung đào tạo</li>

            {{-- Quản lý khóa học --}}
            <li class="{{ Request::is('instructor/course*') ? 'mm-active' : '' }}">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-book"></i></div>
                    <div class="menu-title">Quản lý khóa học</div>
                </a>
                <ul>
                    <li class="{{ Route::is('instructor.course.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('instructor.course.index') }}">
                            <i class='bx bx-radio-circle'></i>
                            Tất cả khóa học
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Quản lý kiểm tra --}}
            <li class="{{ Request::is('instructor/quizzes*') || Request::is('instructor/assessments*') ? 'mm-active' : '' }}">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-edit'></i></div>
                    <div class="menu-title">Quản lý kiểm tra</div>
                </a>
                <ul>
                    <li class="{{ Route::is('instructor.quizzes.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('instructor.quizzes.index') }}">
                            <i class='bx bx-radio-circle'></i>
                            Quản lý Quiz
                        </a>
                    </li>
                    <li class="{{ Route::is('instructor.assessments.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('instructor.assessments.index') }}">
                            <i class='bx bx-radio-circle'></i>
                            Đánh giá năng lực
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Live --}}
            <li class="{{ Route::is('instructor.live-sessions.*') ? 'mm-active' : '' }}">
                <a href="{{ route('instructor.live-sessions.index') }}">
                    <div class="parent-icon"><i class='bx bx-video-recording'></i></div>
                    <div class="menu-title">Buổi dạy trực tiếp</div>
                </a>
            </li>

            <li class="menu-label">Marketing & Ưu đãi</li>

            {{-- Coupon --}}
            <li class="{{ Request::is('instructor/coupon*') ? 'mm-active' : '' }}">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-purchase-tag-alt'></i></div>
                    <div class="menu-title">Phiếu giảm giá</div>
                </a>
                <ul>
                    <li class="{{ Route::is('instructor.coupon.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('instructor.coupon.index') }}">
                            <i class='bx bx-radio-circle'></i>
                            Tất cả mã giảm giá
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-label">Tài chính & Thu nhập</li>

            {{-- Payroll --}}
            <li class="{{ Request::is('instructor/payroll*') ? 'mm-active' : '' }}">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-wallet'></i></div>
                    <div class="menu-title">Quản lý lương</div>
                </a>
                <ul>
                    <li class="{{ Route::is('instructor.payroll.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('instructor.payroll.index') }}">
                            <i class='bx bx-radio-circle'></i>
                            Lịch sử nhận lương
                        </a>
                    </li>
                </ul>
            </li>

        @endif
    </ul>
</div>
