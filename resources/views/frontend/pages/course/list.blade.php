@extends('frontend.master')

@section('content')
<style>
    /* Tổng thể nền và font */
    .course-area { background-color: #f9fbff; }
    
    /* Sidebar thiết kế tối giản hiện đại */
    .filter-sidebar {
        background: #fff;
        padding: 25px;
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        position: sticky;
        top: 30px;
    }
    .filter-title {
        font-size: 1.2rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: #1e293b;
        position: relative;
    }
    .filter-title::after {
        content: '';
        display: block;
        width: 30px;
        height: 3px;
        background: #ff6600;
        margin-top: 8px;
        border-radius: 10px;
    }
    .filter-item {
        transition: all 0.2s;
        padding: 5px 0;
    }
    .filter-item:hover { color: #ff6600; }
    .filter-item input[type="checkbox"] {
        accent-color: #ff6600;
        transform: scale(1.1);
    }
    .filter-count {
        background: #f1f5f9;
        color: #64748b;
        padding: 2px 8px;
        border-radius: 12px;
        font-weight: 600;
    }

    /* Card Khóa học thiết kế lại hoàn toàn */
    .course-card-modern {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .course-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
    .img-box {
        position: relative;
        height: 180px;
        overflow: hidden;
    }
    .img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s;
    }
    .course-card-modern:hover .img-box img { transform: scale(1.1); }
    
    .badge-modern {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        z-index: 2;
    }
    .badge-bestseller { background: #fef3c7; color: #92400e; }
    .badge-discount { background: #fee2e2; color: #991b1b; }

    .card-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .course-cat-tag {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .course-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.5;
        margin-bottom: 12px;
        height: 3.3rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .course-name a { color: inherit; text-decoration: none; }
    .course-name a:hover { color: #ff6600; }

    .course-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 0.85rem;
        color: #94a3b8;
        margin-bottom: 15px;
    }

    .card-footer-modern {
        padding: 15px 20px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fafafa;
    }
    .price-wrap .now { font-size: 1.25rem; font-weight: 800; color: #1e293b; }
    .price-wrap .old { font-size: 0.9rem; color: #94a3b8; text-decoration: line-through; margin-left: 5px; }
    
    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #fff;
        color: #64748b;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: all 0.2s;
    }
    .action-btn:hover { background: #ff6600; color: #fff; }

    /* Custom Radio cho Price giống hình mẫu */
    .custom-radio-box {
        display: block;
        padding: 10px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: 0.3s;
    }
    .custom-radio-box:hover { background: #fff7ed; border-color: #ffedd5; }
    .custom-control-input:checked ~ .custom-radio-box {
        background: #fff7ed;
        border-color: #ff6600;
        color: #ff6600;
        font-weight: 700;
    }
</style>

<section class="course-area py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    @forelse($courses as $course)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="course-card-modern course-tooltip-trigger" data-id="{{ $course->course_name_slug }}">
                                <div class="img-box">
                                    <a href="{{ route('course-details', $course->course_name_slug) }}">
                                        <img src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
                                    </a>
                                    @if($course->bestseller == 'yes')
                                        <span class="badge-modern badge-bestseller">Bán chạy nhất</span>
                                    @endif
                                    @if($course->discount_price > 0)
                                        <span class="badge-modern badge-discount" style="left: auto; right: 15px;">-{{ round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100) }}%</span>
                                    @endif
                                </div>

                                <div class="card-content">
                                    <div class="course-cat-tag">{{ $course->category->name ?? 'Course' }}</div>
                                    <h5 class="course-name">
                                        <a href="{{ route('course-details', $course->course_name_slug) }}">{{ $course->course_name }}</a>
                                    </h5>
                                    
                                    <div class="rating-stars text-warning small mb-3">
                                        <i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i><i class="la la-star"></i>
                                        <span class="text-muted ml-1">(4.8)</span>
                                    </div>

                                    <div class="course-meta">
                                        <span><i class="la la-user-circle"></i> {{ Str::limit($course->user->name, 15) }}</span>
                                        <span><i class="la la-file-text"></i> 12 Lessons</span>
                                    </div>
                                </div>

                                <div class="card-footer-modern">
                                    <div class="price-wrap">
                                        @if($course->discount_price > 0)
                                            <span class="now">{{ number_format($course->discount_price, 0, ',', '.') }}đ</span>
                                            <span class="old">{{ number_format($course->selling_price, 0, ',', '.') }}đ</span>
                                        @else
                                            <span class="now">{{ $course->selling_price > 0 ? number_format($course->selling_price, 0, ',', '.') . 'đ' : 'Miễn phí' }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button onclick="addToWishlist({{ $course->id }})" class="action-btn" title="Yêu thích"><i class="la la-heart-o"></i></button>
                                        <button onclick="addToCart({{ $course->id }})" class="action-btn" title="Thêm giỏ hàng"><i class="la la-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <img src="{{ asset('frontend/images/empty.png') }}" alt="Empty" style="width: 150px; opacity: 0.5;">
                            <p class="text-muted mt-3 font-weight-bold">Chúng tôi không tìm thấy khóa học nào khớp với lựa chọn của bạn.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $courses->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <div class="col-lg-3">
                <div class="filter-sidebar">
                    <form action="{{ route('frontend.courses') }}" method="GET">
                        <div class="filter-widget">
                            <h5 class="filter-title">Danh mục</h5>
                            <ul class="filter-list">
                                @foreach ($categories as $cat)
                                    <li class="filter-item d-flex justify-content-between">
                                        <label class="mb-0 cursor-pointer d-flex align-items-center">
                                            <input type="checkbox" name="category[]" value="{{ $cat->id }}" 
                                                class="mr-2" {{ is_array(request('category')) && in_array($cat->id, request('category')) ? 'checked' : '' }}>
                                            {{ $cat->name }}
                                        </label>
                                        <span class="filter-count">{{ $cat->course_count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="filter-widget">
                            <h5 class="filter-title">Giảng viên</h5>
                            <ul class="filter-list">
                                @foreach ($instructors as $ins)
                                    <li class="filter-item d-flex justify-content-between">
                                        <label class="mb-0 cursor-pointer d-flex align-items-center">
                                            <input type="checkbox" name="instructor[]" value="{{ $ins->id }}" 
                                                class="mr-2" {{ is_array(request('instructor')) && in_array($ins->id, request('instructor')) ? 'checked' : '' }}>
                                            {{ $ins->name }}
                                        </label>
                                        <span class="filter-count">{{ $ins->courses_count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="filter-widget">
                            <h5 class="filter-title">Giá tiền</h5>
                            <div class="mb-2">
                                <input type="radio" id="pFree" name="price" value="free" class="custom-control-input d-none" {{ request('price') == 'free' ? 'checked' : '' }}>
                                <label for="pFree" class="custom-radio-box mb-1">Miễn phí</label>
                            </div>
                            <div class="mb-2">
                                <input type="radio" id="pPaid" name="price" value="paid" class="custom-control-input d-none" {{ request('price') == 'paid' ? 'checked' : '' }}>
                                <label for="pPaid" class="custom-radio-box">Có phí</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 font-weight-bold shadow-sm" style="background: #ff6600; border: none;">Áp dụng bộ lọc</button>
                        <a href="{{ route('frontend.courses') }}" class="btn btn-link btn-block btn-sm text-muted mt-3">Làm mới bộ lọc</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


    @include('frontend.section.tooltip')
@endsection



@push('scripts')
    {{-- Thêm thư viện Tippy nếu master chưa có --}}
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <script type="text/javascript">
        // Khởi tạo Tooltip
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof tippy !== 'undefined') {
                tippy('.course-tooltip-trigger', {
                    content(reference) {
                        const id = reference.getAttribute('data-id');
                        const template = document.getElementById(id);
                        return template ? template.innerHTML : "Loading...";
                    },
                    allowHTML: true,
                    theme: 'light-border',
                    placement: 'right',
                    interactive: true,
                    maxWidth: 350,
                });
            }
        });


        function addToCart(course_id) {
            $.ajax({
                type: "POST",
                url: "/cart/data/store/" + course_id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        alert(data.success);
                    }
                }
            });
        }


        function addToWishlist(course_id) {
            $.ajax({
                type: "POST",
                url: "/wishlist/add",
                data: {
                    _token: '{{ csrf_token() }}',
                    course_id: course_id
                },
                success: function(data) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        alert(data.success);
                    }
                }
            });
        }
    </script>
@endpush
