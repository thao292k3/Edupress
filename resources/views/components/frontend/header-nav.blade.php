<?php
$categories = getCategories();
?>

<div class="menu-category">
    <ul>
        <li>
            <a href="#">Categories <i class="la la-angle-down fs-12"></i></a>
            <ul class="cat-dropdown-menu">
                @foreach ($categories as $item)
                    <li>
                        <a href="course-grid.html">{{ $item->name }} <i class="la la-angle-right"></i></a>
                        <ul class="sub-menu">
                            @foreach ($item['subcategory'] as $data)
                                <li><a href="#">{{ $data->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>

{{ $slot ?? '' }}

<nav class="main-menu">
    <ul>
        <li>
            <a href="/">Trang chủ</a>
        </li>
        <li>
            <a href="{{ route('frontend.courses') }}">Tất cả khóa học</a>
        </li>
        <li>
            <a href="#">Học sinh <i class="la la-angle-down fs-12"></i></a>
            <ul class="dropdown-menu-item">
                <li><a href="{{ route('assessment.show') }}">Đánh giá kỹ năng (Nhanh)</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Khóa học <i class="la la-angle-down fs-12"></i></a>
            <ul class="dropdown-menu-item">
                <li><a href="{{ route('frontend.courses') }}">Danh sách khóa học</a></li>
                <li><a href="{{ route('frontend.my.courses') }}">Khóa học của tôi</a></li>
            </ul>
        </li>
        <li class="mega-menu-has">
            <a href="#">Trang<i class="la la-angle-down fs-12"></i></a>
            <div class="dropdown-menu-item mega-menu">
                <ul class="row no-gutters">
                    <li class="col-lg-3">
                        <a href="dashboard.html">dashboard <span class="ribbon">Hot</span></a>
                        <a href="about.html">about</a>
                        <a href="teachers.html">Teachers</a>
                        <a href="teacher-detail.html">Teacher detail</a>
                        <a href="categories.html">categories</a>
                        <a href="terms-and-conditions.html">Terms & conditions</a>
                        <a href="privacy-policy.html">privacy policy</a>
                        <a href="invite.html">invite friend</a>
                    </li>
                    <li class="col-lg-3">
                        <a href="careers.html">careers</a>
                        <a href="career-details.html">career details</a>
                        <a href="become-a-teacher.html">become an instructor</a>
                        <a href="faq.html">FAQs</a>
                        <a href="admission.html">admission</a>
                        <a href="gallery.html">gallery</a>
                        <a href="pricing-table.html">pricing tables</a>
                        <a href="contact.html">contact</a>
                    </li>
                    <li class="col-lg-3">
                        <a href="for-business.html">for business</a>
                        <a href="sign-up.html">sign-up</a>
                        <a href="login.html">login</a>
                        <a href="recover.html">recover</a>
                        <a href="shopping-cart.html">cart</a>
                        <a href="checkout.html">checkout</a>
                        <a href="error.html">page 404</a>
                    </li>
                    <li class="col-lg-3">
                        <div class="menu-banner position-relative h-100">
                            <div class="overlay rounded-rounded opacity-4"></div>
                            <div class="menu-banner-content p-4 position-absolute bottom-0 left-0">
                                <h4 class="fs-20 font-weight-bold pb-3 text-white">30 days free trail for new users</h4>
                                <a href="sign-up.html" class="btn theme-btn theme-btn-sm theme-btn-white">Start Learning <i class="la la-arrow-right icon ml-1"></i></a>
                            </div>
                            <img src="images/menu-banner-img.jpg" alt="menu banner image" class="w-100 h-100 rounded-rounded">
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="{{ route('frontend.posts') }}">Bài viết<i class="la la-angle-down fs-12"></i></a>
            <ul class="dropdown-menu-item">
                <li><a href="{{ route('frontend.posts') }}">Tất cả bài viết</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('cart') }}">Giỏ hàng</a>
        </li>
    </ul>
</nav>
