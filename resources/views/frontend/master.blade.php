<!DOCTYPE html>
<html lang="en">

<head>

    <title>Edupress</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontend/images/Logoo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- inject:css -->

    @include('frontend.section.link')

    <!-- end inject -->

    <style> 
.hero-slider:not(.owl-loaded) .hero-slider-item:not(:first-child) {
    display: none; /* Chỉ hiện ảnh đầu tiên, ẩn các ảnh còn lại khi Owl chưa load xong */
}

.hero-slider:not(.owl-loaded) {
    height: 500px; /* Khóa chiều cao cố định để tránh layout bị nhảy */
    overflow: hidden;
}

</style>

</head>

<body>

    <!-- start cssload-loader -->
   

    <!--START HEADER AREA-->
    @include('frontend.section.header')

    @yield('content')


    <!--START COURSE First AREA-->
 


    <!--START COURSE AREA-->



    <!--START FUNFACT AREA -->



    <!--START CTA AREA-->

    <!--START TESTIMONIAL AREA-->


    <div class="section-block"></div>

    <!--START ABOUT AREA-->



    <div class="section-block"></div>

    <!--START REGISTER AREA-->


    <div class="section-block"></div>

    <!--START CLIENT-LOGO AREA -->




    <!--START BLOG AREA -->




    <!----START GET STARTED AREA---->



    <!---subscribe-area------->



    <!---footer-area--->
    @include('frontend.section.footer')


    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>


    <!---tooltip--->

    @include('frontend.section.tooltip')


    <!-- template js files -->
    @include('frontend.section.script')
</body>

</html>