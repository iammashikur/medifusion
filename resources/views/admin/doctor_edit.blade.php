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
                <h4>Edit Doctor</h4>
                <div class="card-header-action">
                    <a href="{{ route('doctor.index') }}" class="btn btn-warning">Go Back</a>
                </div>
            </div>

            <div class="card-body">

             <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
              @csrf

              @method("PUT")

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Profile Picture</label>
                  <div class="col-sm-12 col-md-7">



                    <div id="image-preview" class="image-preview" style="background-image: url({{ asset("/uploads/images/$doctor->avatar") }}); background-size: cover; background-position: center center;">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="avatar" id="image-upload"/>
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" name="name" value="{{ $doctor->name }}" class="form-control" required>
                  </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gender</label>
                    <div class="col-sm-12 col-md-7">
                      <select class="form-control selectric" name="gender" required>
                        <option value="">select gender</option>
                        @foreach ($gender as $genders)
                        <option  @if ($doctor->gender ==  $genders->id) selected @endif value="{{ $genders->id }}">{{ $genders->gender }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Specialization</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric" name="specialization" required>
                      <option value="">select specialization</option>
                      @foreach ($specialization as $category)
                      <option  @if ($doctor->specialization ==  $category->id) selected @endif value="{{ $category->id }}">{{ $category->specialization }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                 <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Qualification</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="qualification" value="{{ $doctor->qualification }}" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">BMDC Registration Numer</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="registration" value="{{ $doctor->registration }}" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone Number</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="phone" value="{{ $doctor->phone }}" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Consultation Fee</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="consultationfee" value="{{ $doctor->consultationfee }}" class="form-control" required>
                    </div>
                  </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button class="btn btn-primary">Save</button>
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
