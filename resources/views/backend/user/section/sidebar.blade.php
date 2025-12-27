<ul class="generic-list-item off-canvas-menu-list off--canvas-menu-list pt-35px">

    {{-- Bảng điều khiển --}}
    <li class="{{ Route::currentRouteName() == 'user.dashboard' ? 'active' : '' }}">
        <a href="{{ route('user.dashboard') }}">
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
            </svg> Bảng điều khiển
        </a>
    </li>

    {{-- Hồ sơ cá nhân --}}
    <li class="{{ Route::currentRouteName() == 'user.profile' ? 'active' : '' }}">
        <a href="{{ route('user.profile') }}">
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1-2.1-.94-2.1-2.1.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
            </svg> Thông tin cá nhân
        </a>
    </li>

    {{-- Khóa học của tôi (Sử dụng route bạn vừa đưa) --}}
    <li class="{{ Route::currentRouteName() == 'frontend.my.courses' ? 'active' : '' }}">
        <a href="{{ route('frontend.my.courses') }}">
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M8 16h8v2H8zm0-4h8v2H8zm0-4h8v2H8zm6-4H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V10l-6-6zm2 16H5V6h7v5h5v9z" />
            </svg> Khóa học của tôi
        </a>
    </li>

    {{-- Danh sách yêu thích --}}
    <li class="{{ Route::currentRouteName() == 'user.wishlist.index' ? 'active' : '' }}">
        <a href="{{ route('user.wishlist.index') }}">
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg> Khóa học yêu thích
        </a>
    </li>

    

    {{-- Nút Đăng xuất --}}
    <li>
        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z" />
            </svg> Đăng xuất
        </a>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>