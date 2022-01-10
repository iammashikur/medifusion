@php
$page_type = 'Admin';
@endphp
@extends('admin.layouts.master')

@push('styles')

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


            <div class="card card-primary">
                <div class="card-header" style="border-bottom-color: #d0d0d0">
                    <h4>Add Doctor</h4>
                    <div class="card-header-action">
                        <a href="{{ route('doctor.index') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('test-price.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hospital</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control" name="hospital" id="">
                                    <option> -- select -- </option>

                                    @foreach (App\Models\Hospital::all() as $item)

                                        <option value="{{ $item->id }}">{{ $item->name }} </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Test</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control" name="test_id" id="">
                                    <option> -- select -- </option>

                                    @foreach (App\Models\TestSubcategory::all() as $item)

                                        <option value="{{ $item->id }}">{{ $item->getParent->name }}   &rarr;    {{ $item->name }} </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" name="price" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Discount Price</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" name="discount_price" class="form-control" required>
                            </div>
                        </div>






                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Add Test Price</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{ url('assets/admin/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ url('assets/admin/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ url('assets/admin/bundles/ckeditor/ckeditor.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ url('assets/admin/js/page/create-post.js') }}"></script>
    <script src="{{ url('assets/admin/js/page/ckeditor.js') }}"></script>



@endpush
