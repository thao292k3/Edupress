<section class="course-area pb-120px">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Chọn các khóa học bạn mong muốn</h5>
            <h2 class="section__title">Bộ sưu tập khóa học lớn nhất thế giới</h2>
            <span class="section-divider"></span>
        </div>
       

        <ul class="nav nav-tabs generic-tab justify-content-center pb-4" id="myTab" role="tablist">

            @foreach ($categories as $index => $item)
                <li class="nav-item">
                    <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="{{ $item->slug }}-tab" data-toggle="tab"
                        href="#{{ $item->slug }}" role="tab" aria-controls="{{ $item->slug }}"
                        aria-selected="true">{{ $item->name }}</a>
                </li>
            @endforeach

        </ul>
    </div>
    <div class="card-content-wrapper bg-gray pt-50px pb-120px">
        <div class="container">
            <div class="tab-content" id="myTabContent">

                @foreach ($course_category as $index => $data)
                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="{{ $data->slug }}"
                        role="tabpanel" aria-labelledby="{{ $data->slug }}-tab">
                        <div class="row">

                            @foreach ($data->course ?? [] as $course)
                                <div class="col-lg-4 responsive-column-half">
                                    <div class="card card-item card-preview"
                                        data-tooltip-content="#{{ $course->course_name_slug }}">
                                        <div class="card-image">
                                            <a href="{{ route('course-details', $course->course_name_slug) }}"
                                                class="d-block">

                                                <img class="card-img-top lazy" width="240" height="240"
                                                    src="{{ asset($course->course_image) }}"
                                                    data-src="{{ asset($course->course_image) }}" alt="Card image cap">

                                            </a>
                                            <div class="course-badge-labels">
                                                @if ($course->bestseller == 'yes' || $course->featured == 'yes' || $course->highestrated == 'yes')
                                                    <div class="course-badge">
                                                        @if ($course->bestseller == 'yes')
                                                            Bán chạy nhất
                                                        @elseif($course->featured == 'yes')
                                                            Nổi bật
                                                        @else
                                                            Đánh giá cao nhất
                                                        @endif
                                                    </div>
                                                @endif


                                                @php
                                                    $selling_price = $course->selling_price;
                                                    $discount_price = $course->discount_price;
                                                    $discount_percent = 0;

                                                   
                                                    if ($course->is_free != 1) {
                                                        
                                                        if (
                                                            !empty($selling_price) &&
                                                            $selling_price > 0 &&
                                                            !empty($discount_price) &&
                                                            $discount_price > 0 &&
                                                            $discount_price < $selling_price
                                                        ) {
                                                            $discount_percent = round(
                                                                (($selling_price - $discount_price) / $selling_price) *
                                                                    100,
                                                            );
                                                        }

                                                        
                                                    }
                                                    
                                                @endphp

                                              
                                                @if ($discount_percent > 0)
                                                    <div class="course-badge blue">
                                                        -{{ $discount_percent }}%
                                                    </div>
                                                @endif

                                               
                                                @if ($course->is_free == 1)
                                                    <div class="course-badge green">
                                                        Miễn phí
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                                                {{ $course->course_level }}
                                            </h6>

                                            <h5 class="card-title">
                                                <a href="{{ route('course-details', $course->course_name_slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($course->course_name, 50) }}
                                                </a>
                                            </h5>

                                            <p class="card-text">
                                                <a href="#">
                                                    {{ $course['user']['name'] }}
                                                </a>
                                            </p>
                                            <div class="rating-wrap d-flex align-items-center py-2">
                                                <div class="review-stars">
                                                    <span class="rating-number">4.4</span>
                                                    <span class="la la-star"></span>
                                                    <span class="la la-star"></span>
                                                    <span class="la la-star"></span>
                                                    <span class="la la-star"></span>
                                                    <span class="la la-star-o"></span>
                                                </div>
                                                <span class="rating-total pl-1">(20,230)</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">

                                                @if ($course->is_free == 1 || ($course->selling_price == 0 && $course->discount_price == 0))
                                                    <p class="card-price text-black font-weight-bold">
                                                        Miễn phí
                                                    </p>
                                                @else
                                                    <p class="card-price text-black font-weight-bold">

                                                        @php
                                                            $display_price =
                                                                $course->discount_price > 0
                                                                    ? $course->discount_price_vn
                                                                    : $course->selling_price_vn;
                                                            $before_price =
                                                                $course->discount_price > 0
                                                                    ? $course->selling_price_vn
                                                                    : '';
                                                        @endphp

                                                        {{ $display_price }}

                                                        @if ($before_price)
                                                            <span
                                                                class="before-price font-weight-medium">{{ $before_price }}</span>
                                                        @endif
                                                    </p>
                                                @endif


                                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer wishlist-icon"
                                                    title="Add to Wishlist" data-course-id="{{ $course->id }}">

                                                    <?php
                                                    
                                                    if (auth()->check()) {
                                                        $user_id = auth()->user()->id;
                                                    
                                                        $isWishlisted = \App\Models\Wishlist::where('user_id', $user_id)->where('course_id', $course->id)->first();
                                                    } else {
                                                        $isWishlisted = null;
                                                    }
                                                    ?>

                                                    @if ($isWishlisted)
                                                        <i class="la la-heart"></i>
                                                    @else
                                                        <i class="la la-heart-o"></i>
                                                    @endif

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
            <div class="more-btn-box mt-4 text-center">
                <a href={{ route('frontend.courses') }} class="btn theme-btn">Xem tất cả các khóa học <i
                        class="la la-arrow-right icon ml-1"></i></a>
            </div>
        </div>
    </div>

</section>
