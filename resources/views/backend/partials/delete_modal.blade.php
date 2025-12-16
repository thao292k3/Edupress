<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận Xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa mục này không? Thao tác này không thể hoàn tác.
            </div>
            
            <div class="modal-footer">
                {{-- Form này sẽ được gán action động bằng JavaScript --}}
                <form id="deleteForm" method="POST" action=""> 
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa bỏ</button>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- **Lưu ý:** Nếu bạn đang gọi modal này thông qua một nút bấm, 
    bạn cần đảm bảo đã có script JavaScript để gán action cho form #deleteForm 
    khi modal được mở (ví dụ: hàm confirmDelete(url) như ở các trang index khác). --}}