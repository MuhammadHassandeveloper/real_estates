<!-- ============================ Footer Start ================================== -->

@php
    use App\Helpers\AppHelper;
@endphp
<footer class="dark-footer skin-dark-footer">
    <div>
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <img src="{{ AppHelper::site_logo() }}" class="img-footer" alt="" />

                        <div class="footer-add">
                            <p>{{ AppHelper::contact_address() }}</p>
                            <p>+{{ AppHelper::phone() }}</p>
                            <p>{{ AppHelper::email() }}</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Navigations</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('contact-us') }}">Contact</a></li>
                            <li><a href="{{ url('agents') }}">Agents</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">The Highlights</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ url('properties') }}">Apartment</a></li>
                            <li><a href="{{ url('/') }}">My Houses</a></li>
                            <li><a href="{{ url('properties') }}">Restaurant</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ url('login') }}">My Profile</a></li>
                            <li><a href="{{ url('login') }}">My account</a></li>
                            <li><a href="{{ url('login') }}">Favorites</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <p class="mb-0">© {{ date('Y') }} {{ AppHelper::site_name() }}. Designd By <a href="https://codeflex.org">CodeFlex</a> All Rights Reserved</p>
                </div>

                <div class="col-lg-6 col-md-6 text-right">
                    <ul class="footer-bottom-social">
                        <li><a href="{{ AppHelper::facebook_url() }}"><i class="lni-facebook"></i></a></li>
                        <li><a href="{{ AppHelper::instagram_url() }}"><i class="lni-instagram"></i></a></li>
                        <li><a href="{{ AppHelper::twitter_url() }}"><i class="lni-twitter"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->

