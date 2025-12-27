<script>
$(function(){
    // CSRF header setup (uses meta tag if available)
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '{{ csrf_token() }}';

    if (window.jQuery) {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' } });
    }

    const debounceMap = new Map();

    function sendStatus($input){
        if($input.data('processing')) return;
        $input.data('processing', true);
        const userId = $input.data('user-id');
        const status = $input.is(':checked') ? 1 : 0;
        const row = $input.closest('tr');
        const statusBadge = row.find('.status-badge');

        // ensure UI stays responsive
        $input.prop('disabled', true);

        $.post('{{ route('admin.instructor.status') }}', { user_id: userId, status: status })
            .done(function(response){
                if(response && response.success){
                    if(status === 1){
                        statusBadge.removeClass('bg-danger').addClass('bg-primary').text('Active');
                    } else {
                        statusBadge.removeClass('bg-primary').addClass('bg-danger').text('Inactive');
                    }

                    const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true });
                    Toast.fire({ icon: 'success', title: response.message });
                } else {
                    // rollback
                    $input.prop('checked', !status);
                    Swal.fire({ icon: 'error', title: 'Error', text: (response && response.message) ? response.message : 'Server error' });
                }
            })
            .fail(function(){
                $input.prop('checked', !status);
                Swal.fire({ icon: 'error', title: 'Thất bại', text: 'Không thể kết nối đến máy chủ.' });
            })
            .always(function(){
                $input.prop('disabled', false);
                $input.data('processing', false);
            });
    }

    // Attach handler with debounce per element
    $(document).on('change', '.form-check-input', function(){
        const $this = $(this);
        // cancel pending timer for this element
        if(debounceMap.has(this)){
            clearTimeout(debounceMap.get(this));
        }
        // set a debounce timer
        const t = setTimeout(function(){ sendStatus($this); debounceMap.delete($this.get(0)); }, 300);
        debounceMap.set(this, t);
        // disable immediately to prevent accidental double click until request is processed
        $this.prop('disabled', true);
    });
});
</script>
