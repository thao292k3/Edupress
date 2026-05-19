@extends('frontend.master')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    
    * { font-family: 'Inter', sans-serif; }
    
    .course-area { 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 0;
    }
    
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 20s infinite linear;
    }
    @keyframes float {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: white;
    }
    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }
    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 30px;
    }
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 30px;
    }
    .stat-item {
        text-align: center;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
    }
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    /* Main Content */
    .main-content {
        background: #f8fafc;
        padding: 40px 0;
        min-height: calc(100vh - 300px);
    }
    
    .filter-sidebar {
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        position: sticky;
        top: 30px;
    }
    .filter-title {
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 25px;
        color: #1e293b;
        position: relative;
        padding-bottom: 12px;
    }
    .filter-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 10px;
    }
    .filter-item {
        transition: all 0.3s;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .filter-item:last-child { border-bottom: none; }
    .filter-item:hover { 
        color: #667eea; 
        padding-left: 10px;
    }
    .filter-item input[type="checkbox"] {
        accent-color: #667eea;
        transform: scale(1.2);
        margin-right: 12px;
    }
    .filter-count {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.8rem;
    }

    /* Card Khóa học thiết kế lại hoàn toàn */
    .course-card-modern {
        background: #fff;
        border-radius: 20px;
        border: none;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }
    .course-card-modern:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 25px 50px rgba(102, 126, 234, 0.2);
    }
    .img-box {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .course-card-modern:hover .img-box img { transform: scale(1.15); }
    
    .img-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        opacity: 0;
        transition: opacity 0.4s;
    }
    .course-card-modern:hover .img-overlay { opacity: 1; }
    
    .badge-modern {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .badge-bestseller { 
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #fff;
    }
    .badge-discount { 
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #fff;
        left: auto;
        right: 15px;
    }
    .badge-featured {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: #fff;
    }

    .card-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .course-cat-tag {
        font-size: 0.8rem;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-block;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        padding: 6px 14px;
        border-radius: 20px;
    }
    .course-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.6;
        margin-bottom: 15px;
        height: 3.6rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .course-name a { color: inherit; text-decoration: none; }
    .course-name a:hover { color: #667eea; }

    .course-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
    }
    .course-meta i {
        color: #667eea;
        margin-right: 6px;
    }

    .card-footer-modern {
        padding: 20px 25px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #fafbff, #f8fafc);
    }
    .price-wrap .now { 
        font-size: 1.4rem; 
        font-weight: 800; 
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .price-wrap .old { 
        font-size: 0.95rem; 
        color: #94a3b8; 
        text-decoration: line-through; 
        margin-left: 8px;
    }
    
    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        transition: all 0.3s;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .action-btn:hover { 
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: transparent;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    /* Custom Radio cho Price */
    .custom-radio-box {
        display: block;
        padding: 14px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
        color: #64748b;
    }
    .custom-radio-box:hover { 
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        border-color: #667eea;
        color: #667eea;
    }
    .custom-control-input:checked ~ .custom-radio-box {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }
    
    /* Pagination */
    .pagination .page-link {
        border: none;
        color: #64748b;
        font-weight: 600;
        padding: 10px 16px;
        border-radius: 10px;
        margin: 0 4px;
        transition: all 0.3s;
    }
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    .pagination .page-link:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        color: #667eea;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }
    .empty-state img {
        width: 180px;
        opacity: 0.6;
        margin-bottom: 20px;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Khám Phá Khóa Học</h1>
            <p class="hero-subtitle">Học từ các chuyên gia hàng đầu và nâng cao kỹ năng của bạn</p>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Khóa học</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Học viên</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Giảng viên</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="main-content">
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
                                    <div class="img-overlay"></div>
                                    @if($course->bestseller == 'yes')
                                        <span class="badge-modern badge-bestseller">Bán chạy nhất</span>
                                    @elseif($course->featured == 'yes')
                                        <span class="badge-modern badge-featured">Nổi bật</span>
                                    @endif
                                    @if($course->discount_price > 0)
                                        <span class="badge-modern badge-discount">-{{ round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100) }}%</span>
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
                                    <div class="d-flex gap-4">
                                        <button onclick="addToWishlist({{ $course->id }})" class="action-btn" title="Yêu thích"><i class="la la-heart-o"></i></button>
                                        <button onclick="addToCart({{ $course->id }})" class="action-btn" title="Thêm giỏ hàng"><i class="la la-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <img src="{{ asset('frontend/images/empty.png') }}" alt="Empty">
                                <p class="text-muted mt-3 font-weight-bold">Chúng tôi không tìm thấy khóa học nào khớp với lựa chọn của bạn.</p>
                            </div>
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
                            <ul class="filter-list" style="list-style: none; padding: 0;">
                                @foreach ($categories as $cat)
                                    <li class="filter-item d-flex justify-content-between">
                                        <label class="mb-0 cursor-pointer d-flex align-items-center" style="flex: 1;">
                                            <input type="checkbox" name="category[]" value="{{ $cat->id }}" 
                                                {{ is_array(request('category')) && in_array($cat->id, request('category')) ? 'checked' : '' }}>
                                            {{ $cat->name }}
                                        </label>
                                        <span class="filter-count">{{ $cat->course_count }}</span>
                                    </li>
                                    @if($cat->subcategories && $cat->subcategories->count() > 0)
                                        <ul class="subcategory-list-{{ $cat->id }}" style="list-style: none; padding-left: 25px; margin-top: 8px;">
                                            @foreach ($cat->subcategories as $index => $subcat)
                                                <li class="filter-item d-flex justify-content-between subcategory-item-{{ $cat->id }} {{ $index >= 3 ? 'subcategory-hidden-' . $cat->id : '' }}" style="padding: 8px 0; border-bottom: 1px solid #f1f5f9; {{ $index >= 3 ? 'display: none;' : '' }}">
                                                    <label class="mb-0 cursor-pointer d-flex align-items-center" style="flex: 1; font-size: 0.9rem; color: #64748b;">
                                                        <input type="checkbox" name="subcategory[]" value="{{ $subcat->id }}" 
                                                            {{ is_array(request('subcategory')) && in_array($subcat->id, request('subcategory')) ? 'checked' : '' }}>
                                                        {{ $subcat->name }}
                                                    </label>
                                                    <span class="filter-count" style="font-size: 0.75rem;">{{ $subcat->courses()->where('status', 1)->count() }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        @if($cat->subcategories->count() > 3)
                                            <button type="button" class="btn btn-link btn-sm text-muted p-0 mt-2 toggle-subcategories" data-category-id="{{ $cat->id }}" style="font-size: 0.85rem; color: #667eea;">
                                                <i class="la la-angle-down"></i> Xem thêm ({{ $cat->subcategories->count() - 3 }})
                                            </button>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="filter-widget" style="margin-top: 30px;">
                            <h5 class="filter-title">Giảng viên</h5>
                            <ul class="filter-list" style="list-style: none; padding: 0;">
                                @foreach ($instructors as $ins)
                                    <li class="filter-item d-flex justify-content-between">
                                        <label class="mb-0 cursor-pointer d-flex align-items-center" style="flex: 1;">
                                            <input type="checkbox" name="instructor[]" value="{{ $ins->id }}" 
                                                {{ is_array(request('instructor')) && in_array($ins->id, request('instructor')) ? 'checked' : '' }}>
                                            {{ $ins->name }}
                                        </label>
                                        <span class="filter-count">{{ $ins->courses_count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="filter-widget" style="margin-top: 30px;">
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

                        <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 font-weight-bold shadow-sm mt-4" style="background: linear-gradient(135deg, #667eea, #764ba2); border: none;">Áp dụng bộ lọc</button>
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
                url: "{{ route('cart.add') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    course_id: course_id
                },
                success: function(data) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: data.success || 'Đã thêm vào giỏ hàng!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        alert(data.success || 'Đã thêm vào giỏ hàng!');
                    }
                    // Refresh cart count if exists
                    if (typeof fetchCart === 'function') {
                        fetchCart();
                    }
                },
                error: function(xhr) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: xhr.responseJSON?.message || 'Không thể thêm vào giỏ hàng',
                            showConfirmButton: true
                        });
                    } else {
                        alert('Lỗi: ' + (xhr.responseJSON?.message || 'Không thể thêm vào giỏ hàng'));
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
                            title: data.success || 'Đã thêm vào danh sách yêu thích!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        alert(data.success || 'Đã thêm vào danh sách yêu thích!');
                    }
                    // Toggle heart icon
                    const btn = event.target.closest('.action-btn');
                    const icon = btn.querySelector('i');
                    if (icon.classList.contains('la-heart-o')) {
                        icon.classList.remove('la-heart-o');
                        icon.classList.add('la-heart');
                    } else {
                        icon.classList.remove('la-heart');
                        icon.classList.add('la-heart-o');
                    }
                },
                error: function(xhr) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: xhr.responseJSON?.message || 'Không thể thêm vào danh sách yêu thích',
                            showConfirmButton: true
                        });
                    } else {
                        alert('Lỗi: ' + (xhr.responseJSON?.message || 'Không thể thêm vào danh sách yêu thích'));
                    }
                }
            });
        }

        // Toggle subcategories
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-subcategories');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-category-id');
                    const hiddenItems = document.querySelectorAll('.subcategory-hidden-' + categoryId);
                    const icon = this.querySelector('i');
                    const isExpanded = this.getAttribute('data-expanded') === 'true';

                    hiddenItems.forEach(item => {
                        item.style.display = isExpanded ? 'none' : 'block';
                    });

                    if (isExpanded) {
                        this.setAttribute('data-expanded', 'false');
                        this.innerHTML = '<i class="la la-angle-down"></i> Xem thêm (' + hiddenItems.length + ')';
                        icon.classList.remove('la-angle-up');
                        icon.classList.add('la-angle-down');
                    } else {
                        this.setAttribute('data-expanded', 'true');
                        this.innerHTML = '<i class="la la-angle-up"></i> Thu gọn';
                        icon.classList.remove('la-angle-down');
                        icon.classList.add('la-angle-up');
                    }
                });
            });
        });
    </script>
@endpush
