// Global AJAX error handler
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        Accept: 'application/json',
    },
    error: function (xhr, status, error) {
        let message = 'Đã xảy ra lỗi. Vui lòng thử lại!'

        if (xhr.responseJSON) {
            if (xhr.responseJSON.message) {
                message = xhr.responseJSON.message
            }
            if (xhr.status === 401) {
                message = 'Vui lòng đăng nhập để tiếp tục!'
                window.location.href = '/login'
            } else if (xhr.status === 403) {
                message = 'Bạn không có quyền thực hiện hành động này!'
            } else if (xhr.status === 404) {
                message = 'Không tìm thấy dữ liệu!'
            } else if (xhr.status === 422) {
                message = 'Dữ liệu không hợp lệ!'
                if (xhr.responseJSON.errors) {
                    message = Object.values(xhr.responseJSON.errors).flat().join('\n')
                }
            } else if (xhr.status >= 500) {
                message = 'Lỗi server. Vui lòng thử lại sau!'
            }
        }

        // Hiển thị thông báo lỗi
        if (typeof showToast === 'function') {
            showToast(message, 'error')
        } else {
            alert(message)
        }

        console.error('AJAX Error:', { xhr, status, error })
    },
})

// Helper function cho AJAX requests
function ajaxRequest(url, method = 'GET', data = {}) {
    return $.ajax({
        url: url,
        type: method,
        data: data,
    })
}

// Toast notification helper (nếu chưa có)
function showToast(message, type = 'info') {
    // Tạo toast element
    const toast = $(`
        <div class="toast-notification toast-${type}">
            <span>${message}</span>
        </div>
    `)

    $('body').append(toast)

    // Hiển thị toast
    setTimeout(() => toast.addClass('show'), 100)

    // Ẩn sau 3 giây
    setTimeout(() => {
        toast.removeClass('show')
        setTimeout(() => toast.remove(), 300)
    }, 3000)
}
