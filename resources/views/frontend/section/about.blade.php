<section class="about-area pt-0 pb-120px overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-img-wrap-custom pos-relative">
                    <img src="{{ asset('frontend/images/img14.jpg') }}" alt="about image" class="img-fluid main-img">
                    
                    <div class="stat-badge badge-top-right shadow-lg animate-bounce">
                        <div class="stat-icon bg-warning">
                            <i class="la la-users"></i>
                        </div>
                        <div class="stat-text">
                            <h4 class="fs-20 font-weight-bold">250k+</h4>
                            <p class="fs-13">Học viên tích cực</p>
                        </div>
                    </div>

                    <div class="stat-badge badge-bottom-left shadow-lg">
                        <div class="stat-icon bg-info">
                            <i class="la la-play-circle"></i>
                        </div>
                        <div class="stat-text">
                            <h4 class="fs-20 font-weight-bold">1000+</h4>
                            <p class="fs-13">Video bài giảng</p>
                        </div>
                    </div>

                    <div class="shape-circle"></div>
                </div>
            </div><div class="col-lg-6">
                <div class="about-content-box pl-lg-5">
                    <div class="section-heading">
                        <h5 class="ribbon ribbon-lg mb-2">Về chúng tôi</h5>
                        <h2 class="section__title">Nâng tầm kỹ năng của bạn cùng Edupress</h2>
                        <span class="section-divider"></span>
                        <p class="section__desc">
                            Chúng tôi mang đến môi trường học tập trực tuyến hiện đại, kết nối bạn với những giảng viên hàng đầu để chinh phục mọi mục tiêu nghề nghiệp.
                        </p>
                    </div>
                    
                    <ul class="generic-list-item pt-4">
                        <li class="d-flex align-items-center mb-3">
                            <i class="la la-check-circle mr-2 text-success fs-20"></i>
                            <span>Học liệu độc quyền và cập nhật liên tục.</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="la la-check-circle mr-2 text-success fs-20"></i>
                            <span>Hỗ trợ giải đáp thắc mắc 24/7 từ chuyên gia.</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="la la-check-circle mr-2 text-success fs-20"></i>
                            <span>Cộng đồng học viên đông đảo, năng động.</span>
                        </li>
                    </ul>

                    <div class="btn-box pt-40px">
                        <a href="#" class="btn theme-btn">Tìm hiểu thêm <i class="la la-arrow-right icon ml-1"></i></a>
                    </div>
                </div>
            </div></div></div></section>

<style>
    /* Wrapper cho ảnh */
    .about-img-wrap-custom {
        position: relative;
        padding: 40px;
    }

    .main-img {
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        z-index: 2;
        position: relative;
    }

    /* Style chung cho các Badge thông số */
    .stat-badge {
        position: absolute;
        background: #fff;
        padding: 15px 25px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        z-index: 3;
        min-width: 180px;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: #fff;
        font-size: 20px;
    }

    /* Vị trí các Badge */
    .badge-top-right {
        top: 10%;
        right: 0;
    }

    .badge-bottom-left {
        bottom: 10%;
        left: 0;
    }

    /* Vòng tròn trang trí phía sau */
    .shape-circle {
        position: absolute;
        top: 0;
        left: 0;
        width: 150px;
        height: 150px;
        background: #7079e7;
        opacity: 0.1;
        border-radius: 50%;
        z-index: 1;
    }

    /* Hiệu ứng trồi sụt nhẹ nhàng */
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce {
        animation: bounce 3s infinite ease-in-out;
    }

    /* Mobile responsive */
    @media (max-width: 767px) {
        .stat-badge {
            min-width: 150px;
            padding: 10px;
        }
        .badge-top-right { top: 0; }
        .badge-bottom-left { bottom: 0; }
    }
</style>