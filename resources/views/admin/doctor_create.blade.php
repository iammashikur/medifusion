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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

             <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Profile Picture</label>
                  <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview" style="background-image: url(); background-size: cover; background-position: center center;">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="avatar" id="image-upload" required/>
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" name="name" class="form-control" required>
                  </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gender</label>
                    <div class="col-sm-12 col-md-7">
                      <select class="form-control selectric" name="gender" required>
                        <option value="">select gender</option>
                        @foreach ($gender as $genders)
                        <option value="{{ $genders->id }}">{{ $genders->gender }}</option>
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
                      <option value="{{ $category->id }}">{{ $category->specialization }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                 <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Qualification</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="qualification" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">BMDC Registration Number</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="registration" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone Number</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="phone" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Commission (<span id="commission">0</span>%)</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="range" name="commission" class="form-control" min="0" max="100" value="0" onInput="$('#commission').html($(this).val())" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Discount (<span id="discount">0</span>%)</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="range" name="discount" class="form-control" min="0" max="100" value="0" onInput="$('#discount').html($(this).val())" required>
                    </div>
                  </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button class="btn btn-primary">Add Doctor</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>

    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.location').select2();
});

</script>

@endpush
