@extends('frontend.master')
@section('content')

<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Danh mục: {{ $category->name }}</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white d-flex align-items-center">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li>{{ $category->name }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="course-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar mb-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Tất cả danh mục</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                                @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('category.course', $cat->id) }}" 
                                       class="{{ $cat->id == $category->id ? 'text-primary font-weight-bold' : '' }}">
                                        <i class="la la-arrow-right mr-1"></i> {{ $cat->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    @forelse($courses as $course)
                    <div class="col-lg-6 responsive-column-half">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                                    <img class="card-img-top" src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
                                </a>
                                @if($course->discount_price)
                                    <div class="course-badge blue">-{{ round((($course->selling_price - $course->discount_price)/$course->selling_price)*100) }}%</div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a>
                                </h5>
                                <p class="card-text">Giảng viên: <a href="#">{{ $course->user->name ?? 'Admin' }}</a></p>
                                
                                <div class="d-flex align-items-center justify-content-between py-2">
                                    @if($course->discount_price)
                                        <p class="card-price text-primary">{{ number_format($course->discount_price, 0, ',', '.') }}đ 
                                            <span class="before-price">{{ number_format($course->selling_price, 0, ',', '.') }}đ</span>
                                        </p>
                                    @else
                                        <p class="card-price text-primary">{{ $course->selling_price > 0 ? number_format($course->selling_price, 0, ',', '.') . 'đ' : 'Miễn phí' }}</p>
                                    @endif
                                </div>
                                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="btn theme-btn theme-btn-sm w-100">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-lg-12">
                        <div class="alert alert-warning text-center">
                            Hiện chưa có khóa học nào thuộc danh mục này.
                        </div>
                    </div>
                    @endforelse
                </div>

                <div class="text-center pt-3">
                    {{ $courses->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection