@extends('backend.admin.master')

@section('title', 'Quản lý bình luận chờ duyệt')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Bình luận chờ duyệt</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý Blog</a></li>
                            <li class="breadcrumb-item active">Bình luận</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title">Danh sách bình luận cần xác thực</h5>
                            <span class="badge badge-soft-warning font-size-12">{{ $comments->count() }} bình luận mới</span>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-all me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">ID</th>
                                        <th style="width: 200px;">Người gửi</th>
                                        <th>Nội dung bình luận</th>
                                        <th style="width: 150px;">Thời gian</th>
                                        <th style="width: 150px;" class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($comments as $comment)
                                    <tr id="comment-row-{{ $comment->id }}" class="transition-row">
                                        <td class="text-muted fw-bold">#{{ $comment->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-12">
                                                        {{ strtoupper(substr($comment->user->name ?? 'G', 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <h5 class="font-size-14 mb-1">{{ $comment->user->name ?? 'Guest' }}</h5>
                                                    <p class="text-muted font-size-12 mb-0 text-truncate" style="max-width: 150px;">
                                                        Bài viết: <a href="{{ route('admin.blog.edit', $comment->blog_id) }}" class="text-primary">{{ $comment->blog->title ?? '—' }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="p-2 bg-light rounded" style="white-space: normal; min-width: 250px;">
                                                <i class="bx bxs-quote-alt-left text-muted me-1"></i>
                                                {{ $comment->content }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted"><i class="bx bx-time-five me-1"></i>{{ $comment->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="btn btn-sm btn-success waves-effect waves-light btn-approve px-3" data-id="{{ $comment->id }}">
                                                    <i class="bx bx-check font-size-16 align-middle me-1"></i> Duyệt
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger waves-effect waves-light btn-reject px-3" data-id="{{ $comment->id }}">
                                                    <i class="bx bx-trash font-size-16 align-middle me-1"></i> Xóa
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bx bx-file-blank display-4"></i>
                                            <p class="mt-2">Không có bình luận nào đang chờ duyệt.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-row { transition: all 0.4s ease; }
    .bg-soft-primary { background-color: rgba(85, 110, 230, 0.25); }
    .bg-soft-warning { background-color: rgba(241, 180, 76, 0.25); color: #f1b44c; }
    .avatar-xs { height: 2rem; width: 2rem; }
    .avatar-title { align-items: center; display: flex; font-weight: 500; height: 100%; justify-content: center; width: 100%; }
    /* Hiệu ứng khi xóa dòng */
    .row-fade-out { opacity: 0; transform: translateX(30px); }
</style>
@endsection

@push('scripts')
<script>
    (function(){
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function postAction(url, id, btn, onSuccess){
            // Disable nút để tránh bấm nhiều lần
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            }).then(res => res.json()).then(data => {
                if(data.status === 'ok'){
                    onSuccess();
                } else {
                    alert('Lỗi: ' + (data.message || 'Không xác định'));
                    btn.disabled = false;
                }
            }).catch(err => {
                console.error(err);
                alert('Yêu cầu thất bại');
                btn.disabled = false;
            });
        }

        document.addEventListener('click', function(e){
            // Duyệt bình luận
            if(e.target.closest('.btn-approve')){
                const btn = e.target.closest('.btn-approve');
                const id = btn.dataset.id;
                postAction("{{ url('/admin/comments') }}/"+id+"/approve", id, btn, function(){
                    const row = document.getElementById('comment-row-'+id);
                    if(row) {
                        row.classList.add('row-fade-out');
                        setTimeout(() => row.remove(), 400);
                    }
                });
            }

            // Từ chối/Xóa bình luận
            if(e.target.closest('.btn-reject')){
                const btn = e.target.closest('.btn-reject');
                const id = btn.dataset.id;
                if(!confirm('Bạn có chắc chắn muốn xóa bình luận này?')) return;
                postAction("{{ url('/admin/comments') }}/"+id+"/reject", id, btn, function(){
                    const row = document.getElementById('comment-row-'+id);
                    if(row) {
                        row.classList.add('row-fade-out');
                        setTimeout(() => row.remove(), 400);
                    }
                });
            }
        });
    })();
</script>
@endpush