<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mb-4">
            <a href="{{ url('/') }}"> <img style="
                width: 75px;
                height: 75px;
            " alt="image" src="{{ url('/') }}/assets/admin/img/logo.png" class="header-logo mt-4" />
            </a>
        </div>


        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ MenuActive('', 1) }}">
                <a href="{{ url('/') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            @can('specialization-list')
                <li class="dropdown {{ MenuActive('specialization', 1) }}">
                    <a href="{{ route('specialization.index') }}" class="nav-link">
                        <i data-feather="grid"></i>
                        <span>Specializations</span></a>
                </li>
            @endcan




            @can('doctor-list')
                <li class="dropdown {{ MenuActive('doctor', 1) }}">
                    <a href="{{ route('doctor.index') }}" class="nav-link">
                        <i data-feather="user-check"></i>
                        <span>Doctors</span></a>
                </li>
            @endcan

            @can('doctor-location-list')
                <li class="dropdown {{ MenuActive('doctor-location', 1) }}">
                    <a href="{{ route('doctor-location.index') }}" class="nav-link">


                        <i data-feather="map"></i>

                        <span>Doctor Locations</span>
                    </a>
                </li>
            @endcan



            @can('appointment-list')
                <li class="dropdown {{ MenuActive('appointment', 1) }}">
                    <a href="{{ route('appointment.index') }}" class="nav-link">
                        <i data-feather="calendar"></i>
                        <span>Appointments</span></a>
                </li>
            @endcan


            @can('registered-users-list')
                <li class="dropdown {{ MenuActive('patient', 1) }}">
                    <a href="{{ route('patient.index') }}" class="nav-link">
                        <i data-feather="user"></i>
                        <span>Registered Users</span></a>
                </li>
            @endcan




            @can('hospital-list')
                <li class="dropdown {{ MenuActive('hospital', 1) }}">
                    <a href="{{ route('hospital.index') }}" class="nav-link">
                        <i data-feather="hexagon"></i>
                        <span>Hospitals</span></a>
                </li>
            @endcan




            @canany(['test-category-list', 'test-category-create', 'test-category-edit', 'test-category-delete',
                'test-list', 'test-create', 'test-edit', 'test-delete', 'hospital-test-list', 'hospital-test-create',
                'hospital-test-edit', 'hospital-test-delete'])
                <li
                    class="dropdown {{ MenuActive('test', 1) }} {{ MenuActive('test-category', 1) }} {{ MenuActive('test-subcategory', 1) }}">
                    <a href="#" class="menu-toggle nav-link has-dropdown "><i data-feather="list"></i><span>Tests</span></a>
                    <ul class="dropdown-menu">
                        @can('test-category-list')
                            <li><a class="nav-link {{ MenuActive('test', 1) }}"
                                    href="{{ route('test-category.index') }}">Add Test Category</a></li>
                        @endcan
                        @can('test-list')
                            <li><a class="nav-link" href="{{ route('test-subcategory.index') }}">Add Test Name</a></li>
                        @endcan

                        @can('hospital-test-list')
                            <li><a class="nav-link" href="{{ route('test-price.index') }}">Add Hospital Test</a></li>
                        @endcan

                    </ul>
                </li>
            @endcanany




            @can('patient-test-list')
                <li class="dropdown {{ MenuActive('patient-test', 1) }}">
                    <a href="{{ route('patient-test.index') }}" class="nav-link">
                        <i data-feather="check-square"></i>
                        <span>Patient Tests</span></a>
                </li>
            @endcan




            @can('compounder-list')
                <li class="dropdown {{ MenuActive('compounder', 1) }}">
                    <a href="{{ route('compounder.index') }}" class="nav-link">
                        <i data-feather="users"></i>
                        <span>Compounders</span></a>
                </li>
            @endcan


            @can('agent-list')
                <li class="dropdown {{ MenuActive('agent', 1) }}">
                    <a href="{{ route('agent.index') }}" class="nav-link">
                        <i data-feather="users"></i>
                        <span>Agents</span></a>
                </li>
            @endcan



            @can('agent-appointment-list')
                <li class="dropdown {{ MenuActive('agent-appointment', 1) }}">
                    <a href="{{ route('agent-appointment.index') }}" class="nav-link">
                        <i data-feather="calendar"></i>
                        <span>Agents Appointments</span></a>
                </li>
            @endcan


            @can('agent-test-list')
                <li class="dropdown {{ MenuActive('agent-test', 1) }}">
                    <a href="{{ route('agent-test.index') }}" class="nav-link">
                        <i data-feather="check-square"></i>
                        <span>Agents Tests</span></a>
                </li>
            @endcan



            @can('referred-patients-list')
                <li class="dropdown {{ MenuActive('referred-patient', 1) }}">
                    <a href="{{ route('referred-patient.index') }}" class="nav-link">
                        <i data-feather="user"></i>
                        <span>Referred Patients</span></a>
                </li>
            @endcan



            @can('transaction-list')
                <li class="dropdown {{ MenuActive('transaction', 1) }}">
                    <a href="{{ route('transaction.index') }}" class="nav-link">
                        <i data-feather="percent"></i>
                        <span>Transactions</span></a>
                </li>
            @endcan


            @can('agent-withdraw-list')
                <li class="dropdown {{ MenuActive('agent-withdraw', 1) }}">
                    <a href="{{ route('agent-withdraw.index') }}" class="nav-link">
                        <i data-feather="percent"></i>
                        <span>Agent Withdraw</span></a>
                </li>
            @endcan




            @canany(['agent-pay-list', 'patient-pay-list', 'doctor-receive-list', 'hospital-receive-list'])

                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="dollar-sign"></i><span>Payments</span></a>
                    <ul class="dropdown-menu">

                        @can('agent-pay-list')
                            <li><a class="nav-link" href="{{ route('agent-pay.index') }}">Agent Pay</a></li>
                        @endcan

                        @can('patient-pay-list')
                            <li><a class="nav-link" href="{{ route('client-pay.index') }}">Patient Pay</a></li>
                        @endcan

                        @can('doctor-receive-list')
                            <li><a class="nav-link" href="{{ route('doctor-receive.index') }}">Doctor Receive</a></li>
                        @endcan

                        @can('hospital-receive-list')
                            <li><a class="nav-link" href="{{ route('hospital-receive.index') }}">Hospital Receive</a>
                            @endcan

                        </li>
                    </ul>
                </li>

            @endcanany



            @can('push-notification-list')
                <li class="dropdown">
                    <a href="{{ route('push-notification.index') }}" class="nav-link">
                        <i data-feather="bell"></i>
                        <span>Push Notification</span></a>
                </li>
            @endcan




            @canany(['user-list', 'user-create', 'user-edit', 'user-delete', 'role-list', 'role-create', 'role-edit',
                'role-delete'])
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="key"></i><span>Roles &
                            Permission</span></a>
                    <ul class="dropdown-menu">
                        @can('role-list')
                            <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                        @endcan
                        @can('user-list')
                            <li><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany


            @can('settings-edit')
                <li class="dropdown">
                    <a href="" class="nav-link">
                        <i data-feather="settings"></i>
                        <span>Settings</span></a>
                </li>
            @endcan



        </ul>
    </aside>
</div>
