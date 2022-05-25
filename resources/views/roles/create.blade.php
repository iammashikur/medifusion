




@php
$page_type = 'Admin';
$page_title = 'Add Hospital Test';
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
                    <h4>Add Hospital Test</h4>
                    <div class="card-header-action">
                        <a href="{{ route('test-price.index') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>

                <div class="card-body">

                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permission:</strong>
                                <br/>
                                @foreach($permission as $value)
                                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br/>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

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
