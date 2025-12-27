<div class="course-overview-card pt-4">
    <h3 class="fs-24 font-weight-semi-bold pb-4">Để lại đánh giá</h3>

    @php
        $user = auth()->user();
        $isFree = $course->selling_price <= 0;
        $hasBought = $user
            ? \App\Models\Order::where('user_id', $user->id)->where('course_id', $course->id)->exists()
            : false;
    @endphp

    @if (!$user)
        <div class="alert alert-warning">
            Vui lòng <a href="{{ route('login') }}" class="text-primary font-weight-bold">đăng nhập</a> để đánh giá khóa
            học này.
        </div>
    @elseif(!$isFree && !$hasBought)
        <div class="alert alert-info">
            <i class="la la-info-circle mr-2"></i>
            Bạn cần <strong>mua khóa học</strong> này để có thể để lại đánh giá về nội dung.
        </div>
    @else
        <form action="{{ route('user.store.review') }}" method="post" class="row">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">

            <div class="input-box col-lg-12">
                <label class="label-text">Xếp hạng của bạn</label>
                <div class="form-group">
                    <div class="rating-stars-selection" style="cursor: pointer; font-size: 24px;">
                        <span class="la la-star star-rating" data-value="1"></span>
                        <span class="la la-star star-rating" data-value="2"></span>
                        <span class="la la-star star-rating" data-value="3"></span>
                        <span class="la la-star star-rating" data-value="4"></span>
                        <span class="la la-star star-rating" data-value="5"></span>
                    </div>
                    <input type="hidden" name="rating" id="selected-rating" value="5" required>
                </div>
            </div>

            <style>
                /* Sao mặc định (chưa chọn hoặc sao xám) */
                .star-rating {
                    color: #ccc;
                    /* Màu xám khi chưa chọn */
                    transition: color 0.2s;
                }

                /* Sao khi được chọn hoặc hover vào */
                .star-rating.active,
                .star-rating:hover {
                    color: #f68c09;
                    /* Màu vàng cam giống template Aduca */
                }
            </style>

            <div class="input-box col-lg-12">
                <label class="label-text">Nội dung đánh giá</label>
                <div class="form-group">
                    <textarea class="form-control form--control pl-3" name="message" placeholder="Viết cảm nghĩ của bạn về khóa học..."
                        rows="5" required></textarea>
                </div>
            </div>

            <div class="btn-box col-lg-12">
                <button class="btn theme-btn" type="submit">Gửi đánh giá</button>
            </div>
        </form>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star-rating');
    const ratingInput = document.getElementById('selected-rating');

    // Mặc định cho 5 sao màu vàng khi mới load (nếu bạn muốn)
    updateStars(5);

    stars.forEach(star => {
        // Sự kiện khi click vào sao
        star.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;
            updateStars(value);
        });

        // Hiệu ứng hover (tùy chọn)
        star.addEventListener('mouseover', function () {
            const value = this.getAttribute('data-value');
            highlightStars(value);
        });

        // Khi di chuột ra ngoài thì trả về đúng giá trị đã chọn
        star.addEventListener('mouseout', function () {
            updateStars(ratingInput.value);
        });
    });

    function updateStars(value) {
        stars.forEach(s => {
            if (s.getAttribute('data-value') <= value) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });
    }

    function highlightStars(value) {
        stars.forEach(s => {
            if (s.getAttribute('data-value') <= value) {
                s.style.color = '#f68c09';
            } else {
                s.style.color = '#ccc';
            }
        });
    }
});
</script>
