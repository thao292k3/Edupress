<!-- jQuery MUST load first -->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>

<!-- Vectormap -->
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('backend/assets/plugins/chartjs/js/chart.js') }}"></script>


@stack('dashboard-scripts')
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

<!-- Password show/hide -->
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            let input = $('#show_hide_password input');
            let icon = $('#show_hide_password i');

            if (input.attr("type") == "text") {
                input.attr('type', 'password');
                icon.addClass("bx-hide").removeClass("bx-show");
            } else {
                input.attr('type', 'text');
                icon.addClass("bx-show").removeClass("bx-hide");
            }
        });
    });
</script>

<script>
    new PerfectScrollbar(".app-container")
</script>

<!-- Photo preview -->
<script>
    $(document).ready(function() {
        $('#Photo').on('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                $('#photoPreview')
                    .attr('src', URL.createObjectURL(file))
                    .css('display', 'block');
            }
        });
    });
</script>

<!-- Froala Editor -->
<script src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
<script>
    new FroalaEditor('.editor', { height: 200 });
</script>

<!-- DataTables Init -->
<script>
    $(document).ready(function() {
        if ($('#example').length) {
            $('#example').DataTable();
        }

        if ($('#example2').length) {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        }
    });
</script>

<!-- Global App -->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>

<!-- Toast Messages -->
<script>
    @if (session('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    @elseif (session('error'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    @endif
</script>

@stack('scripts')
