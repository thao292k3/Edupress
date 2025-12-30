<section class="course-area pb-90px">
    <div class="course-wrapper">
        <div class="container">
            <div class="section-heading text-center">
                <h5 class="ribbon ribbon-lg mb-2">Học theo lộ trình của bạn</h5>
                <h2 class="section__title">Khóa học theo danh mục</h2>
                <span class="section-divider"></span>
            </div>
            <ul class="nav nav-tabs generic-tab justify-content-center py-4" id="myTab" role="tablist">
                @foreach ($course_category as $index => $category)
                    <li class="nav-item">
                        <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="{{ $category->slug }}-tab"
                            data-toggle="tab" href="#category-{{ $category->id }}" role="tab"
                            aria-controls="category-{{ $category->id }}"
                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                            {{ $category->category_name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="">
                <div class="container">
                    <div class="tab-content" id="myTabContent">
                        @foreach ($course_category as $index => $data)
                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                id="category-{{ $data->id }}" role="tabpanel"
                                aria-labelledby="{{ $data->slug }}-tab">
                                <div class="row">
                                    @foreach ($data->course ?? [] as $course)
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item card-preview"
                                                data-tooltip-content="#{{ $course->course_name_slug }}">
                                                <div class="card-image">
                                                    <a href="{{ url('course/details/' . $course->id . '/' . $course->course_name_slug) }}"
                                                        class="d-block">
                                                        <img class="card-img-top lazy"
                                                            src="{{ asset($course->course_image) }}"
                                                            alt="{{ $course->course_name }}">
                                                    </a>

                                                    <div class="course-badge-labels">
                                                        <div class="course-badge">
                                                            @if ($course->bestseller == 'yes' || $course->bestseller == 1)
                                                                Bán chạy nhất
                                                            @elseif($course->featured == 'yes' || $course->featured == 1)
                                                                Nổi bật
                                                            @else
                                                                Đánh giá cao
                                                            @endif
                                                        </div>

                                                        @php
                                                            $selling_price = $course->selling_price;
                                                            $discount_price = $course->discount_price;
                                                            $discount_percent = 0;
                                                            if (
                                                                $course->is_free != 1 &&
                                                                $selling_price > 0 &&
                                                                $discount_price < $selling_price &&
                                                                $discount_price > 0
                                                            ) {
                                                                $discount_percent = round(
                                                                    (($selling_price - $discount_price) /
                                                                        $selling_price) *
                                                                        100,
                                                                );
                                                            }
                                                        @endphp

                                                        @if ($discount_percent > 0)
                                                            <div class="course-badge blue">-{{ $discount_percent }}%
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                                                        {{ $course->course_level }}</h6>
                                                    <h5 class="card-title">
                                                        <a
                                                            href="{{ url('course/details/' . $course->id . '/' . $course->course_name_slug) }}">
                                                            {{ \Illuminate\Support\Str::limit($course->course_name, 45) }}
                                                        </a>
                                                    </h5>
                                                    <p class="card-text">
                                                        <a href="#">{{ $course['user']['name'] }}</a>
                                                    </p>

                                                    <div class="rating-wrap d-flex align-items-center py-2">
                                                        <div class="review-stars">
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <span class="rating-total pl-1">(4.4)</span>
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        @if ($course->is_free == 1 || $course->selling_price == 0)
                                                            <p class="card-price text-black font-weight-bold">Miễn phí
                                                            </p>
                                                        @else
                                                            <p class="card-price text-black font-weight-bold">
                                                                @if ($course->discount_price > 0)
                                                                    {{ number_format($course->discount_price) }}đ
                                                                    <span
                                                                        class="before-price font-weight-medium text-muted"
                                                                        style="text-decoration: line-through; font-size: 13px;">
                                                                        {{ number_format($course->selling_price) }}đ
                                                                    </span>
                                                                @else
                                                                    {{ number_format($course->selling_price) }}đ
                                                                @endif
                                                            </p>
                                                        @endif

                                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer wishlist-icon"
                                                            data-course-id="{{ $course->id }}" title="Yêu thích">
                                                            @auth
                                                                @php
                                                                    $isWishlisted = \App\Models\Wishlist::where(
                                                                        'user_id',
                                                                        auth()->id(),
                                                                    )
                                                                        ->where('course_id', $course->id)
                                                                        ->exists();
                                                                @endphp
                                                                <i
                                                                    class="la {{ $isWishlisted ? 'la-heart' : 'la-heart-o' }}"></i>
                                                            @else
                                                                <i class="la la-heart-o"></i>
                                                            @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="more-btn-box mt-4 text-center">
                <a href="{{ route('course-details', $course->course_name_slug) }" class="btn theme-btn">Xem tất cả khóa học <i
                        class="la la-arrow-right icon ml-1"></i></a>
            </div>
        </div>
    </div>
</section>
