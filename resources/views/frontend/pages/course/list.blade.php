@extends('frontend.master')

@section('content')

<style>
    
    .card-item { transition: all 0.3s ease; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-radius: 12px; overflow: hidden; }
    .card-item:hover { transform: translateY(-8px); box-shadow: 0 12px 25px rgba(0,0,0,0.1); }
    .card-image img { height: 200px; object-fit: cover; width: 100%; }
    .price-box { display: flex; align-items: center; gap: 10px; border-top: 1px solid #eee; pt-3; }
    .current-price { font-size: 18px; font-weight: 800; color: #ec5252; }
    
    .tooltip_templates { display: none; }
</style>
<section class="course-area section-padding">
    <div class="container">
        <div class="row">
            @forelse($courses as $course)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card card-item course-tooltip-trigger" data-id="{{ $course->course_name_slug }}">
                        <div class="card-image">
                            <a href="{{ route('course-details', $course->course_name_slug) }}" class="d-block">
                                <img class="card-img-top" src="{{ asset($course->course_image) }}" alt="Card image cap">
                            </a>
                            <div class="course-badge-labels">
                                
                                @if(!empty($course->selling_price) && $course->selling_price > 0 && !empty($course->discount_price) && $course->selling_price > $course->discount_price)
                                    <div class="course-badge blue">
                                        -{{ round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100) }}%
                                    </div>
                                @endif
                                @if($course->bestseller == 'yes')
                                    <div class="course-badge orange">Bestseller</div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                                    {{ Str::limit($course->course_name, 40) }}
                                </a>
                            </h5>
                            <p class="card-text">Giảng viên: <a href="#">{{ $course->user->name }}</a></p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                
                                <p class="card-price text-black font-weight-bold">
                                    @if(!empty($course->discount_price) && $course->discount_price > 0)
                                        {{ number_format($course->discount_price, 0, ',', '.') }}đ
                                        @if(!empty($course->selling_price) && $course->selling_price > $course->discount_price)
                                            <span class="before-price ml-1" style="text-decoration: line-through; color: gray; font-size: 0.8rem;">
                                                {{ number_format($course->selling_price, 0, ',', '.') }}đ
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-success">Miễn phí</span>
                                    @endif
                                </p>

                                
                                <div class="icon-element-wrap d-flex">
                                    <button onclick="addToWishlist({{ $course->id }})" class="icon-element icon-element-sm shadow-sm border-0 mr-1" title="Yêu thích">
                                        <i class="la la-heart-o"></i>
                                    </button>
                                    <button onclick="addToCart({{ $course->id }})" class="icon-element icon-element-sm shadow-sm border-0" title="Thêm giỏ hàng">
                                        <i class="la la-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Không tìm thấy khóa học nào.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Nhúng file tooltip của bạn --}}
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
            data: { _token: '{{ csrf_token() }}' },
            success: function(data) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'success', title: data.success, showConfirmButton: false, timer: 2000 });
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
            data: { _token: '{{ csrf_token() }}', course_id: course_id },
            success: function(data) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'success', title: data.success, showConfirmButton: false, timer: 2000 });
                } else {
                    alert(data.success);
                }
            }
        });
    }
</script>
@endpush