@php
    $page_type  = 'Admin';
    $page_title = 'Dashboard';
@endphp

@push('styles')
    {{-- Styles Goes Here --}}
@endpush


@extends('admin.layouts.master')

@section('content')

      <!-- Main Content -->
      <div class="main-content">


        {{-- Library section --}}
        <section class="section">
            <div class="row ">
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <a href="">
                      <div class="card">
                          <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                              <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                  <div class="card-content">
                                    <h5 class="font-12">Doctors</h5>
                                    <h2 class="mb-3 font-18">{{ $doctor->count() }}</h2>
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                  <div class="banner-img">
                                    <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/stethoscope.png') }}" alt="">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </a>
              </div>


              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Agents</h5>
                                  <h2 class="mb-3 font-18">{{ App\Models\Agent::count() }}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/agent.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Hospital</h5>
                                  <h2 class="mb-3 font-18">{{ App\Models\Hospital::count() }}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/hospital.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>

              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <a href="">
                      <div class="card">
                          <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                              <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                  <div class="card-content">
                                    <h5 class="font-12">Registered Users</h5>
                                    <h2 class="mb-3 font-18">{{ App\Models\Patient::where('referred_by_id' , null)->count() }}</h2>
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                  <div class="banner-img">
                                    <img style="max-width: 65px" class="" src="{{ asset('uploads/icons/patient.png') }}" alt="">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Referred Patients</h5>
                                  <h2 class="mb-3 font-18">{{ App\Models\Patient::whereNotNull('referred_by_id')->count() }}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 65px" class="" src="{{ asset('uploads/icons/patient.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Patients</h5>

                                  @php
                                  $patient = 0;
                                  foreach (App\Models\Patient::where('referred_by_id' , null)->get() as $user) {
                                      if (App\Models\Appointment::where(['status_id' => 5, 'patient_id' => $user->id])->count() >= 1 ) {
                                          $patient += 1;
                                      }else if (App\Models\PatientTest::where(['status_id' => 2, 'patient_id' => $user->id])->count() >= 1 )
                                      {
                                        $patient += 1;
                                      }
                                  }
                                  @endphp


                                  <h2 class="mb-3 font-18">{{ $patient}}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 65px" class="" src="{{ asset('uploads/icons/patient.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>



              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <a href="">
                      <div class="card">
                          <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                              <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                  <div class="card-content">
                                    <h5 class="font-12">Appointments</h5>
                                    <h2 class="mb-3 font-18">{{ App\Models\Appointment::where(['status_id'=> 5, 'by_agent' => 0])->count() }}</h2>
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                  <div class="banner-img">
                                    <img style="max-width: 65px" class="" src="{{ asset('uploads/icons/date.png') }}" alt="">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Agent Appointments</h5>
                                  <h2 class="mb-3 font-18">{{ App\Models\Appointment::where(['status_id' => 5, 'by_agent' => 1])->count() }}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 65px" class="" src="{{ asset('uploads/icons/date.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>


              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <a href="">
                      <div class="card">
                          <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                              <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                  <div class="card-content">
                                    <h5 class="font-12">User Tests</h5>
                                    <h2 class="mb-3 font-18">{{ App\Models\PatientTest::where(['status_id' => 2, 'by_agent' => 1])->count() }}</h2>
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                  <div class="banner-img">
                                    <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/check-list.png') }}" alt="">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Agent Tests</h5>
                                  <h2 class="mb-3 font-18">{{ App\Models\PatientTest::where(['status_id' => 2, 'by_agent' => 1])->count() }}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/check-list.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>



              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Medic Revenue</h5>
                                  <h2 class="mb-3 font-18">৳ {{ round(medicBalance(), 2)}}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/revenue.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Doctor Revenue</h5>
                                  <h2 class="mb-3 font-18">৳ {{ round(doctorRevenue(), 2) }}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/revenue.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Hospital Revenue</h5>
                                  <h2 class="mb-3 font-18">৳ {{ round(hospitalRevenue(), 2) }}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/revenue.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="">
                    <div class="card">
                        <div class="card-statistic-4">
                          <div class="align-items-center justify-content-between">
                            <div class="row ">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                  <h5 class="font-12">Agent Revenue</h5>
                                  <h2 class="mb-3 font-18">৳ {{ round(agentRevenue(), 2) }}</h2>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center justify-content-center text-center">
                                <div class="banner-img">
                                  <img style="max-width: 55px" class="" src="{{ asset('uploads/icons/revenue.png') }}" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>




            </div>
        </section>




        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection

@push('scripts')
    {{-- Scripts Goes Here --}}
@endpush
