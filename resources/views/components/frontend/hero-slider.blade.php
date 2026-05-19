<section class="hero-section hero-section-gradients pt-20px pb-50px position-relative overflow-hidden">
    @if(isset($sliders) && $sliders->count() > 0)
    <div class="hero-slider-wrap position-relative">
        <div class="hero-slider owl-carousel owl-theme">
            @foreach($sliders as $slider)
            <div class="hero-slide-item" style="background-image: url('{{ asset($slider->slider_image) }}');">
                <div class="container">
                    <div class="hero-content text-center">
                        <span class="hero-badge">{{ $slider->sub_title ?? 'Học tập trực tuyến' }}</span>
                        <h1 class="hero-title">{{ $slider->title }}</h1>
                        <p class="hero-desc">{{ $slider->description }}</p>
                        <div class="hero-btns">
                            <a href="{{ $slider->link ?? route('frontend.courses') }}" class="btn theme-btn mr-2">Xem khóa học <i class="la la-arrow-right icon ml-1"></i></a>
                            <a href="{{ route('register') }}" class="btn theme-btn-outline">Đăng ký ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="hero-nav">
            <button class="hero-nav-btn hero-prev"><i class="la la-angle-left"></i></button>
            <button class="hero-nav-btn hero-next"><i class="la la-angle-right"></i></button>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <span class="hero-badge">Chào mừng đến với EduPress</span>
                    <h1 class="hero-title">Học tập thông minh,<br>Phát triển tương lai</h1>
                    <p class="hero-desc">Khám phá hàng ngàn khóa học chất lượng cao từ các giảng viên uy tín. Bắt đầu hành trình học tập của bạn ngay hôm nay!</p>
                    <div class="hero-btns">
                        <a href="{{ route('frontend.courses') }}" class="btn theme-btn mr-2">Xem khóa học <i class="la la-arrow-right icon ml-1"></i></a>
                        <a href="{{ route('register') }}" class="btn theme-btn-outline">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-wrap text-center">
                    <img src="{{ asset('frontend/images/hero-image.png') }}" alt="Học tập trực tuyến" class="img-fluid hero-img" loading="lazy">
                </div>
            </div>
        </div>
    </div>
    @endif
</section>

<style>
.hero-section-gradients {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ec 100%);
}

.hero-slide-item {
    background-size: cover;
    background-position: center;
    padding: 80px 0;
    position: relative;
}

.hero-slide-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
}

.hero-slide-item .hero-content {
    position: relative;
    z-index: 1;
    color: white;
}

.hero-badge {
    display: inline-block;
    background: var(--primary-color, #e74c3c);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 20px;
}

.hero-title {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
    line-height: 1.2;
}

.hero-desc {
    font-size: 18px;
    margin-bottom: 30px;
    opacity: 0.9;
}

.hero-btns .btn {
    padding: 14px 30px;
}

.hero-btns .btn-outline {
    border: 2px solid white;
    background: transparent;
    color: white;
}

.hero-btns .btn-outline:hover {
    background: white;
    color: #333;
}

.hero-img {
    max-width: 100%;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

.hero-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    border: none;
    background: white;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s;
}

.hero-nav-btn:hover {
    background: var(--primary-color, #e74c3c);
    color: white;
}

.hero-prev { left: 20px; }
.hero-next { right: 20px; }

@media (max-width: 768px) {
    .hero-title { font-size: 32px; }
    .hero-desc { font-size: 16px; }
    .hero-btns { flex-direction: column; }
    .hero-btns .btn { margin-bottom: 10px; }
}
</style>
