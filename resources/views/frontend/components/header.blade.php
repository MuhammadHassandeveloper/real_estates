<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="top-header">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6">
                <div class="cn-info">
                    <ul>
                        <li><i class="lni-phone-handset"></i>91 256 584 5748</li>
                        <li><i class="ti-email"></i>support@Rikada.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <ul class="top-social">
                    <li><a href="#"><i class="lni-facebook"></i></a></li>
                    <li><a href="#"><i class="lni-linkedin"></i></a></li>
                    <li><a href="#"><i class="lni-instagram"></i></a></li>
                    <li><a href="#"><i class="lni-twitter"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<div class="header header-light">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="" />
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">

                    <li class="@yield('home-page')">
                        <a href="{{ url('/') }}">Home<span class="submenu-indicator"></span></a>
                    </li>

                    <li class="@yield('properties-page')">
                        <a href="{{ url('/properties') }}">Properties<span class="submenu-indicator"></span></a>
                    </li>

                    <li class="@yield('agencies-page')">
                        <a href="{{ url('/agencies') }}">Agencies<span class="submenu-indicator"></span></a>
                    </li>

                    <li class="@yield('agents-page')">
                        <a href="{{ url('/agents') }}">Agents<span class="submenu-indicator"></span></a>
                    </li>

                    <li class="@yield('about-us-page')">
                        <a href="{{ url('/agents') }}">About Us<span class="submenu-indicator"></span></a>
                    </li>

                    <li class="@yield('contact-us-page')">
                        <a href="{{ url('/contact-us') }}">Agents<span class="submenu-indicator"></span></a>
                    </li>

                    @if (!Sentinel::check())
                    <li class="active">
                        <a href="{{ url('login') }}">
                            <i class="fas fa-user-circle mr-1"></i>Login
                        </a>
                    </li>
                    @else
                        @php $user = Sentinel::getUser();@endphp
                        @if ($user->inRole('admin'))
                            <li class="@yield('login-page')">
                                <a href="{{ url('/admin/dashboard') }}">
                                    <i class="fas fa-user-circle mr-1"></i>Dashboard
                                </a>
                            </li>

                            @elseif ($user->inRole('agent'))
                             <li class="active">
                                <a href="{{ url('/agent/dashboard') }}">
                                    <i class="fas fa-user-circle mr-1"></i>Dashboard
                                </a>
                            </li>

                            @elseif ($user->inRole('agency'))
                            <li class="active">
                                <a href="{{ url('/agency/dashboard') }}">
                                    <i class="fas fa-user-circle mr-1"></i>Dashboard
                                </a>
                            </li>

                            @elseif ($user->inRole('user'))
                            <li class="active">
                                <a href="{{ url('/user/dashboard') }}">
                                    <i class="fas fa-user-circle mr-1"></i>Dashboard
                                </a>
                            </li>
                        @endif
                        @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->

