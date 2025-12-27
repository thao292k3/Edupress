<div class="card card-item">
    <div class="card-body">
        <div class="preview-course-video">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal">
                <img src="{{ asset($course->course_image) }}" data-src="{{ asset($course->course_image) }}"
                    alt="course-img" class="w-100 rounded lazy">

                <div class="preview-course-video-content">
                    <div class="overlay"></div>
                    <div class="play-button">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            viewBox="-307.4 338.8 91.8 91.8" style=" enable-background:new -307.4 338.8 91.8 91.8;"
                            xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #ffffff;
                                    border-radius: 100px;
                                }

                                .st1 {
                                    fill: #000000;
                                }
                            </style>
                            <g>
                                <circle class="st0" cx="-261.5" cy="384.7" r="45.9"></circle>
                                <path class="st1"
                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <p class="fs-15 font-weight-bold text-white pt-3">Preview this course</p>
                </div>
            </a>
        </div><!-- end preview-course-video -->
        <div class="preview-course-feature-content pt-40px">
            <div class="preview-course-pricing mb-3">
                @if ($course->selling_price <= 0 || $course->is_free)
                    <p class="preview-course__price">Miễn phí</p>
                @else
                    <div class="d-flex align-items-center">
                        <span class="preview-course__price">
                            {{ $course->discount_price > 0 ? number_format($course->discount_price) : number_format($course->selling_price) }}đ
                        </span>
                        @if ($course->discount_price > 0)
                            <span class="before-price mx-2"
                                style="text-decoration: line-through; color: #7f8c8d; font-size: 18px;">
                                {{ number_format($course->selling_price) }}đ
                            </span>
                            <span
                                class="price-discount badge badge-danger text-white">-{{ round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100) }}%
                                off</span>
                        @endif
                    </div>
                @endif
            </div>

            <p class="preview-price-discount-text pb-3">
                <span class="text-color-3 font-weight-bold">Còn 4 ngày</span> với mức giá này!
            </p>

            <div class="preview-course-action">
                @auth
                    @php
                        
                        $isEnrolled = \App\Models\CourseEnrollment::where('course_id', $course->id)
                            ->where('user_id', auth()->id())
                            ->exists();
                    @endphp

                    @if ($isEnrolled)
                       
                        <a href="{{ route('frontend.my.courses') }}" class="btn theme-btn w-100">
                            <i class="la la-play-circle mr-1"></i> Tiếp tục học tập
                        </a>
                    @else
                        @if ($course->selling_price <= 0)
                            
                            <form action="{{ route('enroll.course', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn theme-btn w-100">
                                    <i class="la la-graduation-cap mr-1"></i> Đăng ký học ngay (Free)
                                </button>
                            </form>
                        @else
                          
                            <div class="buy-btns">
                                <button type="button" class="btn theme-btn w-100 mb-2"
                                    onclick="addToCart({{ $course->id }})">
                                    <i class="la la-shopping-cart mr-1"></i> Thêm vào giỏ hàng
                                </button>
                                <a href="{{ route('checkout.index', $course->id) }}"
                                    class="btn theme-btn theme-btn-transparent w-100">
                                    Mua ngay
                                </a>
                            </div>
                        @endif
                    @endif
                @else
                   
                    <a href="{{ route('login') }}" class="btn theme-btn w-100">
                        <i class="la la-lock mr-1"></i> Đăng nhập để học
                    </a>
                    <p class="fs-13 text-center pt-2 text-muted">Bắt đầu học ngay sau khi đăng nhập</p>
                @endauth
            </div>

            <p class="fs-14 text-center py-3">Cam kết hoàn tiền trong 30 ngày</p>

            <div class="preview-course-incentives">
                <h3 class="card-title fs-18 pb-2">Khóa học này bao gồm:</h3>
                <ul class="generic-list-item pb-3">
                    <li><i class="la la-play-circle-o mr-2 text-color"></i>2.5 giờ video bài giảng</li>
                    <li><i class="la la-file mr-2 text-color"></i>34 bài viết chi tiết</li>
                    <li><i class="la la-file-text mr-2 text-color"></i>12 tài liệu có thể tải xuống</li>
                    <li><i class="la la-key mr-2 text-color"></i>Quyền truy cập trọn đời</li>
                    <li><i class="la la-television mr-2 text-color"></i>Học trên điện thoại và TV</li>
                    <li><i class="la la-certificate mr-2 text-color"></i>Giấy chứng nhận hoàn thành</li>
                </ul>

                <div class="section-block"></div>

                <div class="buy-for-team-container pt-4">
                    <h3 class="fs-18 font-weight-semi-bold pb-2">Đào tạo cho đội nhóm?</h3>
                    <p class="lh-24 pb-3">Cấp quyền truy cập cho hơn 5 người trong tổ chức của bạn.</p>
                    <a href="#" class="btn theme-btn theme-btn-sm theme-btn-transparent w-100">Thử cho doanh
                        nghiệp</a>
                </div>
            </div>
        </div><!-- end preview-course-content -->
    </div>
</div><!-- end card -->
