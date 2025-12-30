<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-dai-hoc-vinh.jpg') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="{{ setSidebar(['admin.dashboard']) }}">
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Bảng điều khiển</div>
            </a>

        </li>

        <li class="{{ setSidebar(['admin.category*', 'admin.subcategory*']) }}">
            <a href="javascript:;" class="has-arrow">

                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Quản lý danh mục</div>
            </a>
            <ul>
                <li class="{{ setSidebar(['admin.category*']) }}">
                    <a href="{{ route('admin.category.index') }}"><i class='bx bx-radio-circle'></i>Tất cả danh mục</a>
                </li>
                <li class="{{ setSidebar(['admin.subcategory*']) }}">
                    <a href="{{ route('admin.subcategory.index') }}"><i class='bx bx-radio-circle'></i>Danh mục con</a>
                </li>

            </ul>
        </li>

        <li class="{{ setSidebar(['admin.instructor.index', 'admin.instructor.active']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Quản lý giảng viên</div>
            </a>
            <ul>
                <li class="{{ setSidebar(['admin.instructor.index']) }}">
                    <a href="{{ route('admin.instructor.index') }}"><i class='bx bx-radio-circle'></i>Danh sách giảng
                        viên</a>
                </li>
                <li class="{{ setSidebar(['admin.instructor.active']) }}">
                    <a href="{{ route('admin.instructor.active') }}"><i class='bx bx-radio-circle'></i>Giảng viên đang
                        hoạt động</a>
                </li>

            </ul>
        </li>


        <li class="{{ setSidebar(['admin.course*']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Quản lý khóa học</div>
            </a>
            <ul>
                <li class="{{ setSidebar(['admin.course*']) }}">
                    <a href="{{ route('admin.course.index') }}"><i class='bx bx-radio-circle'></i>Tất cả khóa học</a>
                </li>


            </ul>
        </li>

        <li class="{{ setSidebar(['admin.order*']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Quản lý đơn hàng</div>
            </a>
            <ul>
                <li class="{{ setSidebar(['admin.order*']) }}">
                    <a href="{{ route('admin.order.index') }}"><i class='bx bx-radio-circle'></i>Danh sách đơn hàng</a>
                </li>
            </ul>
        </li>


        <li
            class="{{ setSidebar(['admin.slider*', 'admin.info*', 'admin.partner*', 'admin.subscriber*', 'admin.site-setting*', 'admin.page-setting*']) }}">
            <a href="javascript:;" class="has-arrow">

                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Cài đặt ứng dụng</div>
            </a>
            <ul>

                <li class="{{ setSidebar(['admin.slider*']) }}">
                    <a href="{{ route('admin.slider.index') }}"><i class='bx bx-radio-circle'></i>Quản lý hình ảnh
                        trượt</a>
                </li>

                <li class="{{ setSidebar(['admin.info*']) }}">
                    <a href="{{ route('admin.info.index') }}"><i class='bx bx-radio-circle'></i>Quản lý thông tin cá
                        nhân </a>
                </li>

                <li class="{{ setSidebar(['admin.partner*']) }}">
                    <a href="{{ route('admin.partner.index') }}"><i class='bx bx-radio-circle'></i>Quản lý đối tác</a>
                </li>

                <li class="{{ setSidebar(['admin.site-setting*']) }}">
                    <a href="{{ route('admin.site-setting.index') }}"><i class='bx bx-radio-circle'></i>Cấu hình hệ
                        thống</a>
                </li>

            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-news'></i></div>
                <div class="menu-title">Quản lý bài viết</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.blog.index') }}"><i class='bx bx-radio-circle'></i>Tất cả bài viết</a>
                </li>
                <li>
                    <a href="{{ route('admin.blog.create') }}"><i class='bx bx-radio-circle'></i>Thêm bài viết</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-chat'></i></div>
                <div class="menu-title">Manage bình luận</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.comments.pending') }}"><i class='bx bx-radio-circle'></i>Bình luận đang
                        chờ xử lý</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-star'></i></div>
                <div class="menu-title">Quản lý đánh giá</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.review.pending') }}"><i class='bx bx-radio-circle'></i>Phê duyệt đánh
                        giá</a></li>
                <li> <a href="{{ route('admin.review.active') }}"><i class='bx bx-radio-circle'></i>Đánh giá đã được
                        phê duyệt</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-money'></i></div>
                <div class="menu-title">Quản lý tài chính</div>
            </a>
            <ul class="{{ Request::is('admin/payroll*') ? 'mm-show' : '' }}">

                <li class="{{ Route::is('admin.payroll.index') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.payroll.index') }}">
                        <i class='bx bx-radio-circle'></i>Danh sách quyết toán
                    </a>
                </li>


                <li class="{{ Route::is('admin.payroll.create') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.payroll.create') }}">
                        <i class='bx bx-radio-circle'></i>Tạo bảng lương tháng
                    </a>
                </li>

                <li class="{{ Route::is('admin.revenue.index') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.revenue.index') }}">
                        <i class='bx bx-radio-circle'></i>Báo cáo doanh thu
                    </a>
                </li>


            </ul>
        </li>






    </ul>
    <!--end navigation-->
</div>
