@section('sidebar')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        {{-- <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('public/storage/img/logo-2.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">PBS Digital</span>
        </a> --}}

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <span class="d-block ms-5 text-white">Hello {{ Auth::user()->name }}</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                               with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ route('viewUserTable') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>
                                    All Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewAdminTable') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>
                                    All Dasboard User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewAgentLeadlTable') }}" class="nav-link">
                                <i class="nav-icon fa-regular fa-user"></i>
                                <p>
                                    All Agent Lead Reports
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewAgentSaleTable') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-dollar-sign"></i>
                                <p>
                                    All Agent Sales Reports
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewAgentMeeting') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-handshake-angle"></i>
                                <p>
                                    All Agent Meeting
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewAgentSaleTable') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-handshake-angle"></i>
                                <p>
                                    All Agent Meeting Done
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('viewAgentTrialTable') }}" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                All Agent Trial Reports
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('viewHelpRequestTableDashboard') }}" class="nav-link">
                            {{-- <i class="nav-icon far fa-image"></i> --}}
                            <i class="nav-icon fa-solid fa-handshake-angle"></i>
                            <p>
                                Help Request
                            </p>
                        </a>
                    </li>

                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ route('viewCustomerNumber') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-phone"></i>
                                <p>
                                   Customer Respons
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewNumbersTable') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-phone"></i>
                                <p>
                                   Numbers
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-gear"></i>
                                <p>
                                    Settings
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('viewAdminUpdatePasswordForm') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Change Password</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endsection
