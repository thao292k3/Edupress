<header class="header-menu-area">
    <div class="header-menu-content dashboard-menu-content pr-30px pl-30px bg-white shadow-sm">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="logo-box logo--box">
                            <a href="index.html" class="logo">
                                <img src="{{asset('frontend/images/logo.png')}}" width="50" height="50" alt="logo">

                            </a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Category menu">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                    data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div><!-- end logo-box -->
                        <div class="menu-wrapper">
                            <form method="post" class="mr-auto ml-0">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control form--control-gray pl-3" type="text"
                                        name="search" placeholder="Search for anything">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                            <div class="nav-right-button d-flex align-items-center">
                                <div class="user-action-wrap d-flex align-items-center">
                                    <div>
                                        <a style="margin-right: 25px" href="/" target="_blank">Explore LMS</a>
                                    </div>
                                    <div class="shop-cart course-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>

                                            <li>
                                                <p class="shop-cart-btn d-flex align-items-center fs-16">
                                                    My Courses
                                                    <span class="la la-angle-down fs-13 ml-1"></span>
                                                </p>
                                                <ul class="cart-dropdown-menu after-none">
                                                    <li class="media media-card">
                                                        <a href="lesson-details.html" class="media-img">
                                                            <img class="mr-3" src="{{asset('frontend/images/small-img-3.jpg')}}"
                                                                alt="Course thumbnail image">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5><a href="lesson-details.html">The Complete
                                                                    JavaScript Course 2021: From Zero to Expert!</a>
                                                            </h5>
                                                            <div class="skillbar-box pt-3">
                                                                <div class="skillbar skillbar-skillbar"
                                                                    data-percent="36%">
                                                                    <div class="skillbar-bar skillbar--bar bg-1">
                                                                    </div>
                                                                </div><!-- End Skill Bar -->
                                                            </div><!-- End skillbar-box -->
                                                        </div>
                                                    </li>
                                                    <li class="media media-card">
                                                        <a href="lesson-details.html" class="media-img">
                                                            <img class="mr-3" src="{{asset('frontend/images/small-img-4.jpg')}}"
                                                                alt="Course thumbnail image">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5><a href="lesson-details.html">The Complete
                                                                    JavaScript Course 2021: From Zero to Expert!</a>
                                                            </h5>
                                                            <div class="skillbar-box pt-3">
                                                                <div class="skillbar skillbar-skillbar"
                                                                    data-percent="77%">
                                                                    <div class="skillbar-bar skillbar--bar bg-1">
                                                                    </div>
                                                                </div><!-- End Skill Bar -->
                                                            </div><!-- End skillbar-box -->
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="my-courses.html" class="btn theme-btn w-100">Got
                                                            to my course <i
                                                                class="la la-arrow-right icon ml-1"></i></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end course-cart -->


                                    <!-----Ajax cart Loading-->

                                    <div  class="shop-cart mr-4" id="cart">

                                    </div>

                                    <!---Ajax Wishlist data shown --->
                                    <div id="wishlist-course">

                                    </div>

                                    <div
                                        class="shop-cart notification-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <p class="shop-cart-btn">
                                                    <i class="la la-bell"></i>
                                                    <span class="dot-status bg-1"></span>
                                                </p>
                                                <ul
                                                    class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li
                                                        class="menu-heading-block d-flex align-items-center justify-content-between">
                                                        <h4>Notifications</h4>
                                                        <span class="ribbon fs-14">18</span>
                                                    </li>
                                                    <li>
                                                        <div class="notification-body">
                                                            <a href="dashboard.html"
                                                                class="media media-card align-items-center">
                                                                <div
                                                                    class="icon-element icon-element-sm flex-shrink-0 bg-1 mr-3 text-white">
                                                                    <i class="la la-bolt"></i>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>Your resume updated!</h5>
                                                                    <span
                                                                        class="d-block lh-18 pt-1 text-gray fs-13">1
                                                                        hour ago</span>
                                                                </div>
                                                            </a>
                                                            <a href="dashboard.html"
                                                                class="media media-card align-items-center">
                                                                <div
                                                                    class="icon-element icon-element-sm flex-shrink-0 bg-2 mr-3 text-white">
                                                                    <i class="la la-lock"></i>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>You changed password</h5>
                                                                    <span
                                                                        class="d-block lh-18 pt-1 text-gray fs-13">November
                                                                        12, 2019</span>
                                                                </div>
                                                            </a>
                                                            <a href="dashboard.html"
                                                                class="media media-card align-items-center">
                                                                <div
                                                                    class="icon-element icon-element-sm flex-shrink-0 bg-3 mr-3 text-white">
                                                                    <i class="la la-user"></i>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>Your account has been created successfully
                                                                    </h5>
                                                                    <span
                                                                        class="d-block lh-18 pt-1 text-gray fs-13">November
                                                                        12, 2019</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li class="menu-heading-block">
                                                        <a href="dashboard.html" class="btn theme-btn w-100">Show
                                                            All Notifications <i
                                                                class="la la-arrow-right icon ml-1"></i></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->

                                    <div class="shop-cart user-profile-cart">
                                        <ul>
                                            <li>
                                                <div class="shop-cart-btn">
                                                    <div class="avatar-xs">
                                                        <img class="rounded-full img-fluid"
                                                            src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('frontend/images/small-avatar-1.jpg')}}" alt="Avatar image">
                                                    </div>
                                                    <span class="dot-status bg-1"></span>
                                                </div>
                                                <ul
                                                    class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center">
                                                        <a href="teacher-detail.html"
                                                            class="avatar-sm flex-shrink-0 d-block">
                                                            <img class="rounded-full img-fluid"
                                                                src="{{auth()->user()->photo ? asset(auth()->user()->photo) : asset('frontend/images/small-avatar-1.jpg')}}"
                                                                alt="Avatar image">
                                                        </a>
                                                        <div class="ml-2">
                                                            <h4><a href="teacher-detail.html"
                                                                    class="text-black">{{auth()->user()->name}}</a></h4>
                                                            <span
                                                                class="d-block fs-14 lh-20">{{auth()->user()->email}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div
                                                            class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                            <button
                                                                class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                                title="Dark mode">
                                                                <svg class="mr-1" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                    <path
                                                                        d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z">
                                                                    </path>
                                                                </svg>
                                                                Dark Mode
                                                            </button>
                                                            <button
                                                                class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                                title="Light mode">
                                                                <svg class="mr-1" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                    <circle cx="12" cy="12" r="5">
                                                                    </circle>
                                                                    <line x1="12" y1="1"
                                                                        x2="12" y2="3"></line>
                                                                    <line x1="12" y1="21"
                                                                        x2="12" y2="23"></line>
                                                                    <line x1="4.22" y1="4.22"
                                                                        x2="5.64" y2="5.64"></line>
                                                                    <line x1="18.36" y1="18.36"
                                                                        x2="19.78" y2="19.78"></line>
                                                                    <line x1="1" y1="12"
                                                                        x2="3" y2="12"></line>
                                                                    <line x1="21" y1="12"
                                                                        x2="23" y2="12"></line>
                                                                    <line x1="4.22" y1="19.78"
                                                                        x2="5.64" y2="18.36"></line>
                                                                    <line x1="18.36" y1="5.64"
                                                                        x2="19.78" y2="4.22"></line>
                                                                </svg>
                                                                Light Mode
                                                            </button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <ul class="generic-list-item">

                                                            <li>
                                                                <a href="#">
                                                                    <i class="la la-file-video-o mr-1"></i> My
                                                                    courses
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="">
                                                                    <i class="la la-shopping-basket mr-1"></i> My
                                                                    cart
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#">
                                                                    <i class="la la-heart-o mr-1"></i> My wishlist
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <div class="section-block"></div>
                                                            </li>

                                                            <li>
                                                                <a href="{{ route('user.profile') }}">
                                                                    <i class="la la-edit mr-1"></i> Edit profile
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <div class="section-block"></div>
                                                            </li>

                                                            <li>
                                                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                    <i class="la la-power-off mr-1"></i> Logout
                                                                </a>
                                                            </li>

                                                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>

                                                            <li>
                                                                <div class="section-block"></div>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="position-relative">
                                                                    <span
                                                                        class="fs-17 font-weight-semi-bold d-block">Aduca
                                                                        for Business</span>
                                                                    <span
                                                                        class="lh-20 d-block fs-14 text-gray">Bring
                                                                        learning to your company</span>
                                                                    <span
                                                                        class="position-absolute top-0 right-0 mt-3 mr-3 fs-18 text-gray">
                                                                        <i class="la la-external-link"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->
                                </div>
                            </div><!-- end nav-right-button -->
                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->

</header><!-- end header-menu-area -->
