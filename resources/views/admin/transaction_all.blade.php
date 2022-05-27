@php
$page_type = 'Admin';
$page_title = 'Transactions';
@endphp
@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section">
            <div class="card card-primary">
                <div class="card-header" style="border-bottom-color: #d0d0d0">
                    <h4>Transactions</h4>

                </div>
                <div class="card-body" style="overflow-x: auto">
                    {{ $dataTable->table() }}
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header" style="border-bottom-color: #d0d0d0">
                    <h4>Report</h4>

                </div>
                <div class="card-body" style="overflow-x: auto">

                    <form action="{{ route('report') }}" method="get">
                        <div class="row">

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">User Type</label>
                                    <select class="form-control" name="user-type" id="">

                                        <option value="">All</option>
                                        <option value="medic">Medic</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="agent">Agent</option>
                                        <option value="user">User</option>
                                        <option value="hospital">Hospital</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Transaction Type</label>
                                    <select class="form-control" name="transaction-type" id="">
                                        <option value="">All</option>
                                        <option value="-">Debit</option>
                                        <option value="+">Credit</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input class="form-control" type="date" name="start-date" id="">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input class="form-control" type="date" name="end-date" id="">
                                </div>
                            </div>

                            <div class="col-2">
                                <button type="submit" class="btn btn-primary w-100 mt-4"><i class="fas fa-search"></i>
                                    Submit</button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>


        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    @include('admin.partials.sweetalert-delete')
@endpush
