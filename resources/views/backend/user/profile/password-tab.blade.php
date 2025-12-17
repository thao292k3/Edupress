<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
    <div class="setting-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>
        <form method="post" class="row" action="{{route('user.passwordSetting')}}">
            @csrf
            <div class="input-box col-lg-4">
                <label class="label-text">Old Password</label>
                <div class="form-group">
                    <input class="form-control form--control" name="current_password" type="password" placeholder="Old Password">
                    <span class="la la-lock input-icon"></span>
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">New Password</label>
                <div class="form-group">
                    <input class="form-control form--control" type="password" name="new_password" placeholder="New Password">
                    <span class="la la-lock input-icon"></span>
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">Confirm New Password</label>
                <div class="form-group">
                    <input class="form-control form--control" type="password" name="new_password_confirmation" placeholder="Confirm New Password">
                    <span class="la la-lock input-icon"></span>
                </div>
            </div>
            <div class="input-box col-lg-12 py-2">
                <button type="submit" class="btn theme-btn">Change Password</button>
            </div>
        </form>

        <div class="section-block mb-4 mt-5"></div>
        <div class="danger-zone-box p-4 border-radius-6 shadow-sm border border-danger bg-light">
            <div class="d-flex align-items-center pb-3">
                <div class="icon-element icon-element-sm bg-danger text-white mr-3">
                    <i class="la la-exclamation-triangle"></i>
                </div>
                <h3 class="fs-18 font-weight-semi-bold text-danger">Khu vực nguy hiểm</h3>
            </div>
            <div class="text-secondary mb-3">
                <p class="pb-1">Khi bạn nhấn nút xóa, tài khoản của bạn sẽ bị đóng vĩnh viễn.</p>
                <ul class="generic-list-item generic-list-item-bullet fs-14">
                    <li>Tất cả các khóa học đã mua/đăng tải sẽ không thể truy cập.</li>
                    <li>Thông tin cá nhân và chứng chỉ sẽ bị xóa khỏi hệ thống.</li>
                    <li>Hành động này <strong>không thể hoàn tác</strong>.</li>
                </ul>
            </div>
            
            <form action="{{ route('user.account.delete') }}" method="POST" onsubmit="return confirm('CẢNH BÁO: Bạn có chắc chắn muốn xóa tài khoản vĩnh viễn không? Mọi dữ liệu sẽ bị mất!');">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm px-4 shadow-none">
                    <i class="la la-user-times mr-1"></i> Xóa tài khoản của tôi
                </button>
            </form>
        </div>
        </div></div>```

