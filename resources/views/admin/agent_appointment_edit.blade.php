@php
    $page_type = 'Admin';
        $page_title = 'Edit Appointment';
@endphp
@extends('admin.layouts.master')

@section('content')

<div class="main-content">
    <div class="section">
       <div class="row">
           <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header" style="border-bottom-color: #d0d0d0">
                    <h4>Edit Appointment</h4>

                </div>
                <div class="card-body" style="overflow-x: auto">

                    <form action="{{ route('agent-appointment.update', $appointment) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                          <label for="">Doctor Name</label>
                          <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="{{$appointment->getDoctor->name}}" disabled>

                        </div>



                        <div class="form-group mb-2">
                          <label for="">Patient Name</label>
                          <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="{{$appointment->getPatient->name}}" disabled>

                        </div>


                        <div class="form-group mb-3">
                          <label for="">Appointment Date</label>
                          <input type="datetime-local" class="form-control" name="appointment_date" value="{{  date('Y-m-d\TH:i', strtotime($appointment->appointment_date)) }}" aria-describedby="helpId" placeholder="">
                        </div>


                        <div class="form-group">
                          <label for="">Status</label>
                          <select class="form-control" name="status_id" id="">
                              @foreach (App\Models\AppointmentStatus::get() as $item)
                              <option value="{{ $item->id }}" @if ($item->id == $appointment->status_id)
                                  selected
                              @endif> {{ $item->status }} </option>
                              @endforeach
                          </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>
                </div>
            </div>
           </div>
       </div>
    </div>
</div>

@endsection

@push('scripts')
    @include('admin.partials.sweetalert-delete')
@endpush
