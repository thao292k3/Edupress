@if(isset($instructors) && $instructors->count() > 0)
<section class="instructor-section pt-80px pb-80px bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-heading text-center mb-50px">
                    <h5 class="ribbon ribbon-lg mb-2">Đội ngũ giảng viên</h5>
                    <h2 class="section__title">Học từ chuyên gia</h2>
                    <p class="section__desc">Gặp gỡ đội ngũ giảng viên giàu kinh nghiệm của chúng tôi</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($instructors as $instructor)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="instructor-card">
                    <div class="instructor-card-img">
                        @if($instructor->photo)
                            <img src="{{ asset($instructor->photo) }}" alt="{{ $instructor->name }}" loading="lazy">
                        @else
                            <img src="{{ asset('frontend/images/default-avatar.png') }}" alt="{{ $instructor->name }}" loading="lazy">
                        @endif
                        <div class="instructor-card-social">
                            @if($instructor->facebook)
                            <a href="{{ $instructor->facebook }}" target="_blank"><i class="la la-facebook"></i></a>
                            @endif
                            @if($instructor->twitter)
                            <a href="{{ $instructor->twitter }}" target="_blank"><i class="la la-twitter"></i></a>
                            @endif
                            @if($instructor->linkedin)
                            <a href="{{ $instructor->linkedin }}" target="_blank"><i class="la la-linkedin"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="instructor-card-content">
                        <h3 class="instructor-name">
                            <a href="#">{{ $instructor->name }}</a>
                        </h3>
                        <p class="instructor-title">{{ $instructor->headline ?? 'Giảng viên' }}</p>
                        <div class="instructor-meta">
                            <span><i class="la la-book"></i> {{ $instructor->courses_count ?? 0 }} khóa học</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-lg-12 text-center">
                <a href="{{ route('register') }}" class="btn theme-btn">Trở thành giảng viên <i class="la la-arrow-right icon ml-1"></i></a>
            </div>
        </div>
    </div>
</section>
@endif

<style>
.instructor-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s;
    margin-bottom: 30px;
}

.instructor-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.instructor-card-img {
    position: relative;
    overflow: hidden;
    aspect-ratio: 1;
}

.instructor-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.instructor-card:hover .instructor-card-img img {
    transform: scale(1.05);
}

.instructor-card-social {
    position: absolute;
    bottom: -50px;
    left: 0;
    right: 0;
    background: rgba(231, 76, 60, 0.9);
    padding: 10px;
    display: flex;
    justify-content: center;
    gap: 15px;
    transition: bottom 0.3s;
}

.instructor-card:hover .instructor-card-social {
    bottom: 0;
}

.instructor-card-social a {
    color: white;
    font-size: 18px;
    transition: transform 0.2s;
}

.instructor-card-social a:hover {
    transform: scale(1.2);
}

.instructor-card-content {
    padding: 20px;
    text-align: center;
}

.instructor-name {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
}

.instructor-name a {
    color: #333;
    text-decoration: none;
}

.instructor-title {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.instructor-meta {
    font-size: 13px;
    color: #999;
}

.instructor-meta i {
    margin-right: 5px;
    color: #e74c3c;
}
</style>
