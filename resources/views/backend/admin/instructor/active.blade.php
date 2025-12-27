@extends('backend.admin.master')

<style>
    .form-check-input {
        width: 2.5rem;
        /* Adjust the width */
        height: 1.5rem;
        /* Adjust the height */
        transform: scale(1.3);
        /* Scale the entire switch */
    }
</style>

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Instructor</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Instructor</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div style="display: flex; align-items:center; justify-content:space-between">
            <h6 class="mb-0 text-uppercase">Tất cả giáo viên</h6>
            <a href="{{ route('admin.instructor.index') }}" class="btn btn-primary">Quay lại</a>

        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tên giáo viên</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Hiển thị</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($active_instructor as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($item->photo)
                                            <img src="{{ asset($item->photo) }}" width="70" height="70" />
                                        @else
                                            <span>Không tìm thấy hình ảnh</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-primary px-3 py-2 status-badge" style="font-weight: 200">Hoạt động</span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2 status-badge" style="font-weight: 200">không hoạt động</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch" >
                                            <input class="form-check-input" style="cursor: pointer" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault{{ $item->id }}"
                                                data-user-id="{{ $item->id }}"
                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    @include('backend.partials.status-toggle-script')
@endpush