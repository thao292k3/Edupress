<section class="client-logo-area section-padding position-relative overflow-hidden text-center">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="section-heading">
            <h5 class="ribbon ribbon-lg mb-2">Đối tác của chúng tôi</h5>
            <h2 class="section__title">
                Các doanh nghiệp hàng đầu lựa chọn
                <a href="for-business.html" class="text-color hover-underline">
                    Edupress
                </a>
                <br>
                để phát triển những kỹ năng nghề nghiệp đang được săn đón
            </h2>
            <span class="section-divider"></span>
        </div>
        <div class="client-logo-carousel pt-4">
            @foreach ($partners as $item)
                <a href="#" class="client-logo-item">
                   
                    <img src="{{ asset($item->image) }}" alt="logo đối tác">
                </a>
            @endforeach
        </div>
    </div>
</section>
