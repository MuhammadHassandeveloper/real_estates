@extends('frontend.main')
@section('title', $title)
@section('about-us-page','active')
@section('content')
    @php
        use App\Helpers\AppHelper;
    @endphp
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2 class="ipt-title">{{ $title }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================ Our Story Start ================================== -->
    <section>

        <div class="container">

            <!-- row Start -->
            <div class="row align-items-center">

                <div class="col-lg-6 col-md-6">
                    <img src="assets/img/sb.png" class="img-fluid" alt="" />
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="story-wrap explore-content">

                        <h2>Our Story</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>

                    </div>
                </div>

            </div>
            <!-- /row -->

        </div>

    </section>
    <!-- ============================ Our Story End ================================== -->


    <!-- ================= Our Mission ================= -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading center">
                        <h2>Our Mission & Work Process</h2>
                        <p>Professional & Dedicated Team</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">

                <div class="col-lg-6 col-md-6">

                    <div class="icon-mi-left">
                        <i class="ti-lock theme-cl"></i>
                        <div class="icon-mi-left-content">
                            <h4>Fully Secure & 24x7 Dedicated Support</h4>
                            <p>If you are an individual client, or just a business startup looking for good backlinks for your website.</p>
                        </div>
                    </div>

                    <div class="icon-mi-left">
                        <i class="ti-twitter theme-cl"></i>
                        <div class="icon-mi-left-content">
                            <h4>Manage your Social & Busness Account Carefully</h4>
                            <p>If you are an individual client, or just a business startup looking for good backlinks for your website.</p>
                        </div>
                    </div>

                    <div class="icon-mi-left">
                        <i class="ti-layers theme-cl"></i>
                        <div class="icon-mi-left-content">
                            <h4>We are Very Hard Worker and loving</h4>
                            <p>If you are an individual client, or just a business startup looking for good backlinks for your website.</p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6">
                    <img src="assets/img/vec-2.png" class="img-fluid" alt="" />
                </div>

            </div>
        </div>
    </section>
    <!-- ================= Our Mission ================= -->


    <!-- ============================ Call To Action ================================== -->
    <section class="theme-bg call-to-act-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="call-to-act">
                        <div class="call-to-act-head">
                            <h3>Want to Become a Real Estate Agent?</h3>
                            <span>We'll help you to grow your career and growth.</span>
                        </div>
                        <a href="#" class="btn btn-call-to-act">SignUp Today</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Call To Action End ================================== -->


@stop
