<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
@php
use App\Helpers\AppHelper;
@endphp
<div class="top-header">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6">
                <div class="cn-info">
                    <ul>
                        <li><i class="lni-phone-handset"></i>{{ AppHelper::phone() }}</li>
                        <li><i class="ti-email"></i>{{ AppHelper::email() }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <ul class="top-social">
                    <li><a href="https://wa.me/{{ AppHelper::phone() }}"><i class="lni-whatsapp"></i></a></li>
                    <li><a href="{{ AppHelper::facebook_url() }}"><i class="lni-facebook"></i></a></li>
                    <li><a href="{{ AppHelper::instagram_url() }}"><i class="lni-instagram"></i></a></li>
                    <li><a href="{{ AppHelper::twitter_url() }}"><i class="lni-twitter"></i></a></li>
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
                    <img src="{{ AppHelper::site_logo() }}" class="logo" alt="" />
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

                    <li class="@yield('agents-page')">
                        <a href="{{ url('/agents') }}">Agents<span class="submenu-indicator"></span></a>
                    </li>


                    <li class="@yield('contact-us-page')">
                        <a href="{{ url('/contact-us') }}">Contact Us<span class="submenu-indicator"></span></a>
                    </li>

                    <li class="@yield('about-us-page')">
                        <a href="{{ route('frontend.about-us') }}">About Us<span class="submenu-indicator"></span></a>
                    </li>

                        <ul class="nav-menu nav-menu-social align-to-right">

                            @if (!Sentinel::check())
                            <li>
                                <a href="{{ url('login') }}">
                                    <i class="fas fa-user-circle mr-1"></i>Login
                                </a>
                            </li>
                            @else
                                @php $user = Sentinel::getUser();@endphp
                                @if ($user->inRole('agent'))
                                <li class="add-listing theme-bg">
                                    <a href="{{ route('agent.create_property') }}">Add Property</a>
                                </li>
                                @endif
                            @endif
                        </ul>
                    @if (Sentinel::check())
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

                            @elseif ($user->inRole('customer'))
                            <li class="active">
                                <a href="{{ url('/customer/dashboard') }}">
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

