<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center gap-1">



                    <li class="nav-item dark-mode d-none d-sm-flex">
                        <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown dropdown-app">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"
                            href="javascript:;"><i class='bx bx-grid-alt'></i></a>
                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <div class="app-container p-2 my-2">
                                <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
                                    <div class="col">
                                        <a href="javascript:;">
                                            <div class="app-box text-center">
                                                <div class="app-icon">
                                                    <img src="{{ asset('backend/assets/images/app/slack.png') }}"
                                                        width="30" alt="">
                                                </div>
                                                <div class="app-name">
                                                    <p class="mb-0 mt-1">Slack</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                </div><!--end row-->

                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            
                            @php
                                $pendingPayroll = \App\Models\Payroll::where('instructor_id', Auth::id())
                                    ->where('status', 'sent_to_instructor')
                                    ->count();
                            @endphp

                            @if ($pendingPayroll > 0)
                                <span class="alert-count">{{ $pendingPayroll }}</span>
                            @endif
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Thông báo lương</p>
                                    <p class="msg-header-clear ms-auto">Đánh dấu đã đọc</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                @php
                                    $payrolls = \App\Models\Payroll::where('instructor_id', Auth::id())
                                        ->where('status', 'sent_to_instructor')
                                        ->latest()
                                        ->take(5)
                                        ->get();
                                @endphp

                                @foreach ($payrolls as $pay)
                                    <a class="dropdown-item" href="{{ route('instructor.payroll.show', $pay->id) }}">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-warning text-warning"><i
                                                    class="bx bx-money"></i></div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Bảng lương tháng {{ $pay->payroll_month }} <span
                                                        class="msg-time float-end">Mới</span></h6>
                                                <p class="msg-info">Vui lòng đối soát và xác nhận lương</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <a href="{{ route('instructor.payroll.index') }}">
                                <div class="text-center msg-footer">Xem tất cả bảng lương</div>
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    @if (auth()->user()->photo)
                        <img src="{{ asset(auth()->user()->photo) }}" class="user-img" alt="user avatar">
                    @else
                        <img src="{{ asset('backend/assets/images/avatars/avatar-2.png') }}" class="user-img"
                            alt="user avatar">
                    @endif

                    <div class="user-info">
                        <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                        <p class="designattion mb-0">{{ auth()->user()->role }}</p>

                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('instructor.profile') }}"><i
                                class="bx bx-user fs-5"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('instructor.setting') }}"><i
                                class="bx bx-cog fs-5"></i><span>Settings</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('instructor.logout') }}">
                            @csrf
                            <button type="submit"
                                class="dropdown-item d-flex align-items-center border-0 bg-transparent">
                                <i class="bx bx-log-out fs-5"></i><span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
