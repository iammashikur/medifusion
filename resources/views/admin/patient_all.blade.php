@php
    $page_type = 'Admin';
        $page_title = 'Registered Users';
@endphp
@extends('admin.layouts.master')

@section('content')

<div class="main-content">
    <div class="section">
        <div class="card card-primary">
            <div class="card-header" style="border-bottom-color: #d0d0d0">
                <h4>Registered Users</h4>

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
