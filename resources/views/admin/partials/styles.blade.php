{{-- Common styles --}}
<!-- General CSS Files -->
<link rel="stylesheet" href="{{url('assets/admin/css/app.min.css')}}">
<!-- Template CSS -->

<link rel="stylesheet" href="{{url('assets/admin/css/style.css')}}">
<link rel="stylesheet" href="{{url('assets/admin/css/components.css')}}">
<!-- Custom style CSS -->
<link rel="stylesheet" href="{{url('assets/admin/css/custom.css')}}">
<!-- Jquery Datatable css -->
<link rel="stylesheet" href="{{ url('assets/admin/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/admin/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
{{-- Dependent styles --}}
@stack('styles')
