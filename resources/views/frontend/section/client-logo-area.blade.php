<section class="client-logo-area section-padding position-relative overflow-hidden text-center">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="section-heading">
            <h5 class="ribbon ribbon-lg mb-2">Our partners</h5>
            <h2 class="section__title">Top companies choose <a href="for-business.html"
                    class="text-color hover-underline">Aduca for Business</a> to build
                <br> in-demand career skills
            </h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
        <div class="client-logo-carousel pt-4">
            @foreach ($partners as $item)
                <a href="#" class="client-logo-item">
                    {{-- Helper asset sẽ trỏ vào thư mục public --}}
                    <img src="{{ asset($item->image) }}" alt="brand image">
                </a>
            @endforeach
        </div><!-- end client-logo-carousel -->
    </div><!-- end container -->
</section>
