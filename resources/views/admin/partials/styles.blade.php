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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
