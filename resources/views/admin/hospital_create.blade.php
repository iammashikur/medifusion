@php
    $page_type = 'Admin';
        $page_title = 'Add Hospital';
@endphp
@extends('admin.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/admin/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/css/components.css') }}">
    <style>
        .col-form-label.text-md-right.col-12.col-md-3.col-lg-3 {
            font-size: 15px;
        }

    </style>
@endpush

@section('content')
    <div class="main-content">
        <div class="section">
            @include('admin.partials.error')


            <form action="{{ route('hospital.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card card-primary">
                    <div class="card-header" style="border-bottom-color: #d0d0d0">
                        <h4>Add Hospital</h4>
                        <div class="card-header-action">
                            <a href="{{ route('doctor.index') }}" class="btn btn-warning">Go Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hospital Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone Number</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header" style="border-bottom-color: #d0d0d0">
                        <h4>Test Commission & Discount</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Test Name</th>
                                    <th>Commission</th>
                                    <th>Discount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\TestCategory::all() as $item)
                                    <tr>
                                        <td scope="row">{{ $item->name }}</td>
                                        <td>
                                            <input type="number" class="form-control" name="test_commission_{{ $item->id }}" value="0" max="100" min="0">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="test_discount_{{ $item->id }}" value="0" max="100" min="0">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>


                <div class="card">

                  <div class="card-body">
                        <button class="btn btn-primary w-100">Add Hospital</button>
                  </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ url('assets/admin/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ url('assets/admin/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ url('assets/admin/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ url('assets/admin/bundles/ckeditor/ckeditor.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ url('assets/admin/js/page/create-post.js') }}"></script>
    <script src="{{ url('assets/admin/js/page/ckeditor.js') }}"></script>
@endpush
