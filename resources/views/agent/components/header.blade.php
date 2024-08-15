@php
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
@endphp
<div class="vertical-overlay"></div>
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->


                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ url('agent/dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ App\Helpers\AppHelper::dashboard_logo() }}" alt="" height="22">
                            </span>
                        <span class="logo-lg">
                            <img src="{{ App\Helpers\AppHelper::dashboard_logo() }}" alt="" height="22">
                        </span>
                    </a>

                    <a href="{{ url('agent/dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ App\Helpers\AppHelper::dashboard_logo() }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ App\Helpers\AppHelper::dashboard_logo() }}" alt="" height="22">
                        </span>
                    </a>
                </div>



                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle" data-toggle="fullscreen">
                        <i class='bi bi-arrows-fullscreen fs-lg'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle mode-layout" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-sun align-middle fs-3xl"></i>
                    </button>
                    <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                        <a href="#!" class="dropdown-item" data-mode="light"><i class="bi bi-sun align-middle me-2"></i> Default (light mode)</a>
                        <a href="#!" class="dropdown-item" data-mode="dark"><i class="bi bi-moon align-middle me-2"></i> Dark</a>
                        <a href="#!" class="dropdown-item" data-mode="auto"><i class="bi bi-moon-stars align-middle me-2"></i> Auto (system default)</a>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    @if(Sentinel::getUser()->photo)
                                    <img class="rounded-circle header-profile-user" src="{{ asset('uploads/'.Sentinel::getUser()->photo) }}" alt="Header Avatar">
                                    @else
                                        <img class="rounded-circle header-profile-user" src="{{ asset('admin/assets/images/users/32/avatar-1.jpg') }}" alt="Header Avatar">
                                    @endif
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Sentinel::getUser()->first_name .' '.Sentinel::getUser()->last_name }}</span>
                                        <span class="d-none d-xl-block ms-1 fs-sm user-name-sub-text">Welcome</span>
                                    </span>
                                </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ \Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->first_name }}!</h6>
                        <a class="dropdown-item" href="{{ route('agent.profile') }}">
                            <i class="mdi mdi-account-circle text-muted fs-lg align-middle me-1"></i>
                            <span class="align-middle">Profile</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('agent.profile') }}">
                            <span class="badge bg-success-subtle text-success mt-1 float-end">New</span>
                            <i class="mdi mdi-cog-outline text-muted fs-lg align-middle me-1"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('agent.activities') }}">
                                <i class="mdi mdi-walk text-muted fs-lg align-middle me-1"></i>
                                <span class="align-middle">Activities</span>
                        </a>

                        <a class="dropdown-item" href="{{ url('logout') }}">
                            <i class="mdi mdi-logout text-muted fs-lg align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
