@php
    $page_type = 'Admin';
        $page_title = 'Edit Test Price';
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
                    <h4>Edit Test Price</h4>
                    <div class="card-header-action">
                        <a href="{{ route('test-price.index') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('test-price.update',  $testPrice->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @method('PUT')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hospital</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control" name="hospital" id="" disabled>


                                    @foreach (App\Models\Hospital::all() as $item)

                                        <option @if ($item->id == $testPrice->hospital_id)
                                            selected
                                        @endif value="{{ $item->id }}">{{ $item->name }} </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">District</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control" name="category" disabled>
                                    <option value="">---Category---</option>
                                    @foreach (App\Models\TestCategory::all() as $item)
                                        <option @if ($item->id == App\Models\TestSubCategory::find($testPrice->id)->getParent->id) selected @endif
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thana</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control" name="test" disabled>
                                    <option selected value="{{ $testPrice->thana_id }}">
                                        {{ App\Models\TestSubCategory::find($testPrice->id)->name }}</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" name="price" class="form-control" value="{{ $testPrice->price }}" required>
                            </div>
                        </div>

                        {{-- <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Discount Price</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" name="discount_price" class="form-control"  value="{{ $testPrice->discount_price }}"  required>
                            </div>
                        </div> --}}


                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Update Test Price</button>
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

    <script>


        $(document).ready(function() {
            var categoryID = $('select[name="category"] option:selected').val();
            $.ajax({
                url: '{{ url('test-by-category') }}/' + categoryID,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('select[name="test"]').empty();
                    $.each(data, function(key, value) {
                        var selected = value.id == {{$testPrice->id}} ? 'selected' : '';
                        $('select[name="test"]').append('<option '+ selected +' value="' + value.id +
                            '">' +
                            value.name + '</option>');
                    });
                }
            });

        });



        $('select[name="category"]').on('change', function() {
            var categoryID = $(this).val();
            if (categoryID) {
                $.ajax({
                    url: '{{ url('test-by-category') }}/' + categoryID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        console.log(data);

                        $('select[name="test"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="test"]').append('<option value="' + value.id +
                                '">' +
                                value.name + '</option>');
                        });


                    }
                });
            } else {
                $('select[name="test"]').empty();
            }
        });
    </script>



@endpush
