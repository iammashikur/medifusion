@php
$page_type = 'Admin';
@endphp
@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header" style="border-bottom-color: #d0d0d0">
                            <h4>Edit Patient Test</h4>
                        </div>
                        <div class="card-body" style="overflow-x: auto">

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Patient name : {{ $test->getPatient->name }}</td>
                                        <td>Date of birth : {{ Carbon\Carbon::parse($test->getPatient->birth_date)->format('d F Y') }}
                                        </td>

                                    </tr>

                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Tests</td>
                                        <td>Hospital</td>
                                        <td>Price</td>
                                        <td>Discount Price</td>
                                    </tr>
                                    @foreach ($test->getItems as $item)
                                        <tr>
                                            <td>{{$item->test_name}}</td>
                                            <td>
                                                {{$item->hospital_name}}
                                            </td>
                                            <td>
                                                {{App\Models\TestPrice::where(['hospital_id' => $item->hospital_id, 'test_id' => $item->id])->first()->price}} ৳
                                            </td>
                                            <td>
                                                {{$item->price->patient_paid}} ৳
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <form action="{{ route('patient-test.update', $test->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  <label for=""></label>
                                  <select class="form-control" name="status">

                                    <option value="">--- Status ---</option>

                                    @foreach (App\Models\PatientTestStatus::get() as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == $test->status_id) selected @endif>{{$item->status}}</option>
                                    @endforeach



                                  </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Update</button>
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
