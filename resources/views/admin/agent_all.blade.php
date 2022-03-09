@php
    $page_type = 'Admin';
        $page_title = 'Agents';
@endphp
@extends('admin.layouts.master')

@section('content')

<div class="main-content">
    <div class="section">
        <div class="card card-primary">
            <div class="card-header" style="border-bottom-color: #d0d0d0">
                <h4>Agents</h4>
            </div>
            <div class="card-body" style="overflow-x: auto">
                {{ $dataTable->table() }}
            </div>
        </div>


        <div class="card card-primary">
            <div class="card-header" style="border-bottom-color: #d0d0d0">
                <h4>Settings</h4>
            </div>
            <div class="card-body" style="overflow-x: auto">
               <form action="{{route('agent-settings.store')}}" method="POST">
                @csrf
                   <div class="form-group">
                     <label for="">Default Commission</label>
                     <input type="text"
                       class="form-control" name="default_commission" value="{{ App\Models\AgentSetting::first() ? App\Models\AgentSetting::first()->default_commission : 0}}">
                   </div>
                   <button type="submit" class="btn btn-primary"> Update </button>
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
