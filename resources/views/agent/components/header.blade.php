<div class="vertical-overlay"></div>
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ url('admin/dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="22">
                        </span>
                    </a>

                    <a href="{{ url('admin/dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/images/logo-light.png')}}" alt="" height="22">
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

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bi bi-bell fs-2xl'></i>
                        <span class="position-absolute topbar-badge fs-3xs translate-middle badge rounded-pill bg-danger"><span class="notification-badge">4</span><span class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head rounded-top">
                            <div class="p-3 border-bottom border-bottom-dashed">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0 fs-lg fw-semibold"> Notifications <span class="badge bg-danger-subtle text-danger fs-sm notification-badge"> 4</span></h6>
                                        <p class="fs-md text-muted mt-1 mb-0">You have <span class="fw-semibold notification-unread">3</span> unread messages</p>
                                    </div>
                                    <div class="col-auto dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" class="link-secondary fs-md"><i class="bi bi-three-dots-vertical"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">All Clear</a></li>
                                            <li><a class="dropdown-item" href="#">Mark all as read</a></li>
                                            <li><a class="dropdown-item" href="#">Archive All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="py-2 ps-2" id="notificationItemsTabContent">
                            <div data-simplebar="" style="max-height: 300px;" class="pe-2">
                                <h6 class="text-overflow text-muted fs-sm my-2 text-uppercase notification-title">New</h6>
                                <div class="text-reset notification-item d-block dropdown-item position-relative unread-message">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3 flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle text-info rounded-circle fs-lg">
                                                        <i class="bx bx-badge-check"></i>
                                                    </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 fs-md mb-2 lh-base">Your <b>Elite</b> author Graphic
                                                    Optimization <span class="text-secondary">reward</span> is ready!
                                                </h6>
                                            </a>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-base">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check01">
                                                <label class="form-check-label" for="all-notification-check01"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-reset notification-item d-block dropdown-item position-relative unread-message">
                                    <div class="d-flex">
                                        <div class="position-relative me-3 flex-shrink-0">
                                            <img src="assets/images/users/32/avatar-2.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                            <span class="active-badge position-absolute start-100 translate-middle p-1 bg-success rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 mb-1 fs-md fw-semibold">Angela Bernier</h6>
                                            </a>
                                            <div class="fs-sm text-muted">
                                                <p class="mb-1">Answered to your comment on the cash flow forecast's graph 🔔.</p>
                                            </div>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-base">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                <label class="form-check-label" for="all-notification-check02"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-reset notification-item d-block dropdown-item position-relative unread-message">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3 flex-shrink-0">
                                                    <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-lg">
                                                        <i class='bx bx-message-square-dots'></i>
                                                    </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 mb-2 fs-md lh-base">You have received <b class="text-success">20</b> new messages in the conversation
                                                </h6>
                                            </a>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-base">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check03">
                                                <label class="form-check-label" for="all-notification-check03"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="text-overflow text-muted fs-sm my-2 text-uppercase notification-title">Read Before</h6>

                                <div class="text-reset notification-item d-block dropdown-item position-relative">
                                    <div class="d-flex">

                                        <div class="position-relative me-3 flex-shrink-0">
                                            <img src="assets/images/users/32/avatar-8.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                            <span class="active-badge position-absolute start-100 translate-middle p-1 bg-warning rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                                        </div>

                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 mb-1 fs-md fw-semibold">Maureen Gibson</h6>
                                            </a>
                                            <div class="fs-sm text-muted">
                                                <p class="mb-1">We talked about a project on linkedin.</p>
                                            </div>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i> 4 hrs ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-base">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check04">
                                                <label class="form-check-label" for="all-notification-check04"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="notification-actions" id="notification-actions">
                                <div class="d-flex text-muted justify-content-center align-items-center">
                                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-2" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="assets/images/users/32/avatar-1.jpg" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Richard Marshall</span>
                                        <span class="d-none d-xl-block ms-1 fs-sm user-name-sub-text">Founder</span>
                                    </span>
                                </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome Richard!</h6>
                        <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                        <a class="dropdown-item" href="apps-tickets-overview.html"><i class="mdi mdi-calendar-check-outline text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                        <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Help</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Balance : <b>$8451.36</b></span></a>
                        <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-success-subtle text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                        <a class="dropdown-item" href="auth-lockscreen.html"><i class="mdi mdi-lock text-muted fs-lg align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
                        <a class="dropdown-item" href="auth-logout.html"><i class="mdi mdi-logout text-muted fs-lg align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
