<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url('admin/dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ App\Helpers\AppHelper::dashboard_logo() }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ App\Helpers\AppHelper::dashboard_logo() }}" alt="" height="22">
            </span>
        </a>
        <a href="{{ url('admin/dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ App\Helpers\AppHelper::dashboard_logo() }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ App\Helpers\AppHelper::dashboard_logo() }}" alt="" height="22">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link menu-link">
                        <i class="ph-gauge"></i>
                        <span data-key="t-calendar">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @yield('countries')" href="{{ route('admin.countries') }}">
                        <i class="bi bi-flag"></i>
                        <span data-key="t-widgets">Manage Countries</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @yield('states')" href="{{ route('admin.states') }}">
                        <i class="bi bi-geo-alt"></i>
                        <span data-key="t-widgets">Manage States</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @yield('cities')" href="{{ route('admin.cities') }}">
                        <i class="bi bi-building"></i>
                        <span data-key="t-widgets">Manage Cities</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#users" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRealeEstate">
                        <i class="ph-user-circle-fill"></i>
                        <span data-key="t-real-estate">Manage Users</span>
                    </a>
                    <div class="collapse menu-dropdown @yield('users-drops')" id="users">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.agents') }}" class="nav-link @yield('agents')">Agents List</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.customers') }}" class="nav-link @yield('customers')">Customers</a>
                            </li>

                        </ul>
                    </div>
                </li>



                <li class="nav-item">
                    <a href="#sidebarRealeEstate" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRealeEstate">
                        <i class="ph-buildings"></i>
                        <span data-key="t-real-estate">Manage Properties</span>
                    </a>
                    <div class="collapse menu-dropdown @yield('properties-drops')" id="sidebarRealeEstate">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.property_types') }}" class="nav-link @yield('property_types')">Property Types</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.property_features') }}" class="nav-link @yield('property_features')">Property Features</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.properties') }}" class="nav-link @yield('properties')">Pending Properties</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#CustomerProperties" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRealeEstate">
                        <i class="ph-buildings"></i>
                        <span data-key="t-real-estate">Customer Properties</span>
                    </a>
                    <div class="collapse menu-dropdown @yield('customer-properties-drops')" id="CustomerProperties">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{ route('admin.customer.purchased.properties') }}" class="nav-link @yield('purchased-properties')">Purchased Properties</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.customer.rent.properties') }}" class="nav-link @yield('rental-properties')">Rental Properties</a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('admin.customer.favourite.properties') }}" class="nav-link @yield('favourite-properties')">Favourite Properties</a>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
