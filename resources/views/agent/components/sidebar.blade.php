<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="22">
            </span>
        </a>
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="22">
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
                    <a href="{{ url('agent/dashboard') }}" class="nav-link menu-link">
                        <i class="ph-gauge"></i>
                        <span data-key="t-calendar">Dashboard</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#sidebarRealeEstate" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRealeEstate">
                        <i class="ph-buildings"></i>
                        <span data-key="t-real-estate">Manage Properties</span>
                    </a>
                    <div class="collapse menu-dropdown @yield('properties-drops')" id="sidebarRealeEstate">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('agent.properties') }}" class="nav-link @yield('properties_list')">Properties</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('agent.create_property') }}" class="nav-link @yield('property_create')">Add Property</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets.html">
                        <i class="ph-paint-brush-broad"></i> <span data-key="t-widgets">Widgets</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
