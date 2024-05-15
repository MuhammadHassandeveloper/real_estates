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
                <a class="nav-brand" href="#"><img src="assets/img/logo.png" class="logo" alt="" /></a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">

                    <li class="active">
                        <a href="{{ url('/') }}">Home<span class="submenu-indicator"></span></a>
                    </li>


                    @if (!Sentinel::check()) {
                    <li>
                        <a href="{{ url('login') }}">
                            <i class="fas fa-user-circle mr-1"></i>Login
                        </a>
                    </li>
                    @endif

                </ul>

                <ul class="nav-menu nav-menu-social align-to-right">
                    <li class="add-listing theme-bg">
                        <a href="submit-property.html">Add Property</a>
                    </li>
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

