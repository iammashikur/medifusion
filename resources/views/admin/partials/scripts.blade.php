{{-- Common Scripts --}}

{{-- ajax csrf header --}}
{{-- <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script> --}}

<!-- General JS Scripts -->
<script src="{{ url('/assets/admin/js/app.min.js') }}"></script>
<!-- Template JS File -->
<script src="{{ url('/assets/admin/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="{{ url('/assets/admin/js/custom.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('sweetalert::alert')
<!-- Datatable -->
<script src="{{ url('assets/admin/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ url('assets/admin/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
{{-- Dependent Scripts --}}
@stack('scripts')
