@php
$page_type = 'Admin';
$page_title = 'Report';
@endphp
@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section">
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
                                    <select class="form-control" name="user-type" id="" required>

                                        <option value="all" @if (request('user-type') == 'all') selected @endif>All</option>
                                        <option value="medic" @if (request('user-type') == 'medic') selected @endif>Medic
                                        </option>
                                        <option value="doctor" @if (request('user-type') == 'doctor') selected @endif>Doctor
                                        </option>
                                        <option value="agent" @if (request('user-type') == 'agent') selected @endif>Agent
                                        </option>
                                        <option value="user" @if (request('user-type') == 'user') selected @endif>User</option>
                                        <option value="hospital" @if (request('user-type') == 'hospital') selected @endif>Hospital
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Transaction Type</label>
                                    <select class="form-control" name="transaction-type" id="" required>
                                        <option value="all" @if (request('transaction-type') == 'all') selected @endif>All</option>
                                        <option value="debit" @if (request('transaction-type') == 'debit') selected @endif>Debit
                                        </option>
                                        <option value="credit" @if (request('transaction-type') == 'credit') selected @endif>Credit
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input class="form-control" value="{{ request('start-date') }}" type="date" name="start-date" id="" required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input class="form-control" value="{{ request('end-date') }}" type="date" name="end-date" id="" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <button type="submit" class="btn btn-primary w-100 mt-4"><i class="fas fa-search"></i>
                                    Submit</button>
                            </div>
                        </div>
                    </form>



                </div>
                <div class="card-body" style="overflow-x: auto">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    @include('admin.partials.sweetalert-delete')
@endpush
