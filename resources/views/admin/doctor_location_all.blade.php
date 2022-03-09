@php
    $page_type = 'Admin';
        $page_title = 'Doctor Locations';
@endphp
@extends('admin.layouts.master')

@section('content')

<div class="main-content">
    <div class="section">
        <div class="card card-primary">
            <div class="card-header" style="border-bottom-color: #d0d0d0">
                <h4>Doctor Locations</h4>
                <div class="card-header-action">
                    <a href="{{ route('doctor.create') }}" class="btn btn-primary">Add Doctor</a>
                </div>
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
