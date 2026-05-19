@extends('frontend.master')

@section('content')

<style>
    /* General improvements */
    .course-details-area {
        padding-bottom: 40px !important;
    }
    
    .course-overview-card {
        margin-bottom: 20px;
        padding: 20px;
    }

    .preview-course-video {
        min-height: 200px;
    }

    /* Mobile Responsive Improvements */
    @media (max-width: 767px) {
        .course-details-area {
            padding-bottom: 30px !important;
        }
        
        .course-details-content-wrap {
            padding-top: 15px !important;
        }

        .course-overview-card {
            margin-bottom: 15px;
            padding: 15px;
        }

        .preview-course-video {
            min-height: 180px;
        }

        .btn-lg {
            padding: 0.6rem 0.8rem !important;
            font-size: 13px !important;
        }

        .rating-wrap {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .rating-wrap > span {
            margin-top: 5px !important;
            margin-left: 0 !important;
            padding-left: 0 !important;
        }

        .sidebar {
            margin-top: 20px;
        }

        .card-body {
            padding: 0.8rem !important;
        }

        h2.section__title {
            font-size: 20px !important;
            line-height: 1.3;
        }

        h3.fs-24 {
            font-size: 18px !important;
        }

        .instructor-wrap .media {
            flex-direction: column;
            text-align: center;
        }

        .instructor-img {
            margin-bottom: 15px;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .d-flex.flex-wrap {
            gap: 5px;
        }

        .btn-lg {
            padding: 0.5rem 0.6rem !important;
            font-size: 12px !important;
        }

        .preview-course-feature-content {
            padding-top: 15px !important;
        }

        h2.section__title {
            font-size: 18px !important;
        }

        h3.fs-24 {
            font-size: 16px !important;
        }
    }

    /* Performance improvements */
    img.lazy {
        display: block;
        width: 100%;
        height: auto;
    }

    .sidebar-negative {
        position: relative;
    }

    /* CTA Button Emphasis */
    .btn-lg {
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 0.7rem 1rem;
    }

    .btn-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn.theme-btn.btn-lg {
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

    @include('frontend.pages.course-details.breadcrumb')

    <!--======================================
        START COURSE DETAILS AREA
======================================-->
    <section class="course-details-area pb-10px">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 pb-4">
                    <div class="course-details-content-wrap pt-3 pt-md-4">

                        @include('frontend.pages.course-details.learn-section')


                        @include('frontend.pages.course-details.course-content')

                        @include('frontend.pages.course-details.student-bought')

                        @include('frontend.pages.course-details.instructor-about')

                        @include('frontend.pages.course-details.student-feedback')


                        @include('frontend.pages.course-details.review')


                    </div><!-- end course-details-content-wrap -->
                </div><!-- end col-lg-8 -->

                <div class="col-12 col-lg-4">
                    @include('frontend.pages.course-details.right-sidebar')
                </div><!-- end col-lg-4 -->

            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </section><!-- end course-details-area -->

    <!-- Modal -->
    @include('frontend.pages.course-details.course-preview-modal')

    @include('frontend.pages.course-details.related-course')


    @include('frontend.pages.course-details.become-teacher')




    <div class="section-block"></div>






@endsection

@push('scripts')

<script>
    // Wishlist Handler
    document.addEventListener('DOMContentLoaded', function() {
        const wishlistBtn = document.querySelector('.wishlist-btn');
        
        if (wishlistBtn) {
            wishlistBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                @auth
                    const courseId = this.getAttribute('data-course-id');
                    const icon = this.querySelector('i');
                    const text = this.querySelector('.swapping-btn');
                    
                    // Add to wishlist
                    fetch('/wishlist/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ course_id: courseId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            icon.classList.remove('la-heart-o');
                            icon.classList.add('la-heart');
                            icon.style.color = '#e74c3c';
                            text.textContent = 'Đã yêu thích';
                            wishlistBtn.style.color = '#e74c3c';
                            alert('✓ Đã thêm vào yêu thích!');
                        } else if (data.status === 'error') {
                            if (data.message.includes('already')) {
                                alert('Khóa học đã có trong danh sách yêu thích!');
                                icon.classList.remove('la-heart-o');
                                icon.classList.add('la-heart');
                                icon.style.color = '#e74c3c';
                                text.textContent = 'Đã yêu thích';
                                wishlistBtn.style.color = '#e74c3c';
                            } else {
                                alert('Lỗi: ' + data.message);
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    });
                @else
                    window.location.href = '{{ route("login") }}';
                @endauth
            });
        }
    });

    
    function addToCart(courseId) {
        @auth
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ course_id: courseId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Khóa học đã được thêm vào giỏ hàng!');
                   
                } else {
                    alert('Lỗi: ' + (data.message || 'Không thể thêm vào giỏ hàng'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            });
        @else
            window.location.href = '{{ route("login") }}';
        @endauth
    }
</script>

@endpush
