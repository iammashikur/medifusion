@php
    $page_type = 'Admin';
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


        <div class="card card-primary">
            <div class="card-header" style="border-bottom-color: #d0d0d0">
                <h4>Add Test Subcategory</h4>
                <div class="card-header-action">
                    <a href="{{ route('test-subcategory.index') }}" class="btn btn-warning">Go Back</a>
                </div>
            </div>

            <div class="card-body">

             <form action="{{ route('test-subcategory.update', $category->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview"
                        style="background-image: url({{ asset("/uploads/images/$category->image") }}); background-size: cover; background-position: center center;">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload" />
                    </div>
                </div>
            </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                  </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                    <div class="col-sm-12 col-md-7">
                      <select class="form-control selectric" name="category_id" required>
                        <option value="">select category</option>
                        @foreach ($categories as $categoryx)
                        <option @if ($categoryx->id == $category->category_id)
                            selected
                        @endif value="{{ $categoryx->id }}">{{ $categoryx->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>




                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button class="btn btn-primary">Add Test Subcategory</button>
                  </div>
                </div>
             </form>
            </div>
        </div>
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
