<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mb-4">
            <a href="{{ url('/') }}"> <img style="
                width: 155px;
                height: 75px;
            " alt="image" src="{{url('/')}}/assets/admin/img/logo.png" class="header-logo" />
            </a>
        </div>


        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ MenuActive('', 1) }}">
                <a href="{{ url('/') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>


            <li class="dropdown {{ MenuActive('specialization', 1) }}">
                <a href="{{ route('specialization.index') }}" class="nav-link">
                    <i data-feather="grid"></i>
                    <span>Specializations</span></a>
            </li>



            <li class="dropdown {{ MenuActive('location', 1) }}">
                <a href="{{ route('location.index') }}" class="nav-link">
                   <i data-feather="map"></i>
                    <span>Locations</span></a>
            </li>

            <li class="dropdown {{ MenuActive('doctor', 1) }}">
                <a href="{{ route('doctor.index') }}" class="nav-link">
                    <i class="fa fa-stethoscope"></i>
                    <span>Doctors</span></a>
            </li>

            <li class="dropdown {{ MenuActive('appointment', 1) }}">
                <a href="{{ route('appointment.index') }}" class="nav-link">
                    <i
                    data-feather="calendar"></i>
                    <span>Appointments</span></a>
            </li>

            <li class="dropdown {{ MenuActive('patient', 1) }}">
                <a href="{{ route('patient.index') }}" class="nav-link">
                    <i class="fa fa-diagnoses"></i>
                    <span>Patients</span></a>
            </li>

            <li class="dropdown {{ MenuActive('hospital', 1) }}">
                <a href="{{ route('hospital.index') }}" class="nav-link">
                    <i
                    data-feather="hexagon"></i>
                    <span>Hospitals</span></a>
            </li>


            <li class="dropdown {{ MenuActive('test', 1) }} {{ MenuActive('test-category', 1) }} {{ MenuActive('test-subcategory', 1) }}">
                <a href="#" class=" nav-link has-dropdown "><i
                    data-feather="list"></i><span>Tests</span></a>
                <ul class="dropdown-menu">

                    <li><a class="nav-link {{ MenuActive('test', 1) }}" href="{{ route('test-category.index') }}">Category</a></li>
                    <li><a class="nav-link" href="{{ route('test-subcategory.index') }}">Test</a></li>
                    <li><a class="nav-link" href="{{ route('test-price.index') }}">Price</a></li>

                </ul>
            </li>

            <li class="dropdown {{ MenuActive('patient-test', 1) }}">
                <a href="{{ route('patient-test.index') }}" class="nav-link">
                    <i
                    data-feather="check-square"></i>
                    <span>Patient Tests</span></a>
            </li>





            <li class="dropdown {{ MenuActive('agent', 1) }}">
                <a href="{{ route('agent.index') }}" class="nav-link">
                    <i
                    data-feather="users"></i>
                    <span>Agents</span></a>
            </li>

            <li class="dropdown {{ MenuActive('agent-appointment', 1) }}">
                <a href="{{ route('agent-appointment.index') }}" class="nav-link">
                    <i
                    data-feather="calendar"></i>
                    <span>Agents Appointments</span></a>
            </li>

            <li class="dropdown {{ MenuActive('agent-test', 1) }}">
                <a href="{{ route('agent-test.index') }}" class="nav-link">
                    <i
                    data-feather="check-square"></i>
                    <span>Agents Tests</span></a>
            </li>


            <li class="dropdown {{ MenuActive('referred-patient', 1) }}">
                <a href="{{ route('referred-patient.index') }}" class="nav-link">
                    <i class="fa fa-diagnoses"></i>
                    <span>Referred Patients</span></a>
            </li>

            {{-- <li class="dropdown {{ MenuActive('admin-and-role', 1) }}">
                <a href="" class="nav-link">
                    <i
                    data-feather="key"></i>
                    <span>Admin & Roles</span></a>
            </li> --}}


            {{-- <li class="dropdown {{ MenuActive('tests', 1) }}">
                <a href="{{ route('doctor.index') }}" class="nav-link">
                    <i
                    data-feather="dollar-sign"></i>
                    <span>Transactions</span></a>
            </li> --}}

            {{-- <li class="dropdown {{ MenuActive('tests', 1) }}">
                <a href="{{ route('doctor.index') }}" class="nav-link">
                    <i
                    data-feather="bar-chart-2"></i>
                    <span>Report</span></a>
            </li> --}}

            <li class="dropdown">
                <a href="" class="nav-link">
                    <i
                    data-feather="settings"></i>
                    <span>Settings</span></a>
            </li>


            {{-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Apps</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="chat.html">Chat</a></li>
                    <li><a class="nav-link" href="portfolio.html">Portfolio</a></li>
                    <li><a class="nav-link" href="blog.html">Blog</a></li>
                    <li><a class="nav-link" href="calendar.html">Calendar</a></li>
                </ul>
            </li> --}}

        </ul>
    </aside>
</div>
