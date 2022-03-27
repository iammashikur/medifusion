@php
$page_type = 'Admin';
$page_title = 'Agent Withdraw Update';
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
                    <h4>Agent Withdraw Update</h4>
                    <div class="card-header-action">
                        <a href="{{ route('agent-withdraw.index') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('agent-withdraw.update', $request->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                            <table class="table table-bordered table-inverse table-responsive">
                                <thead>

                                <tbody>


                                  <tr>
                                    <th scope="row">Name</th>
                                    <td>{{ $agent->name }}</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">Withdraw Amount</th>
                                    <td>{{ $request->amount }}</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">Withdraw Method</th>
                                    <td>{{ $request->withdraw_method }}</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">Account Details</th>
                                    <td>{{ $request->account_details }}</td>
                                  </tr>




                                </tbody>
                              </table>



                              <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Transaction ID</label>
                                <div class="col-sm-12 col-md-7">
                                   <input type="text" class="form-control" name="trx_id" value="{{ $request->trx_id }}" required>
                                </div>
                            </div>




                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="status" required>
                                    <option value="">---Select---</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Denied</option>
                                        <option value="3">Completed</option>
                                        <option value="4">Cancelled</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Update Request</button>
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
