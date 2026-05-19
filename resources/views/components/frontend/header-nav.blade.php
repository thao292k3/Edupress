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
