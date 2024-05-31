@extends('frontend.main')
@section('title',$title)
@section('home-page','active')
@section('style')
@stop
@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <!-- ============================ Hero Banner  Start================================== -->
    <div class="image-cover hero-banner" style="background:url('{{ asset('assets/img/a.jpg') }}') no-repeat;">
        <div class="container">
            <div class="hero-search-wrap">
                <div class="hero-search">
                    <h1>Find Your Dream</h1>
                </div>
                <div class="hero-search-content">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="Neighborhood">
                                    <i class="ti-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="Minimum">
                                    <i class="ti-money"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="Maximum">
                                    <i class="ti-money"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <select id="bedrooms" class="form-control">
                                        <option value="">&nbsp;</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <i class="fas fa-bed"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <select id="bathrooms" class="form-control">
                                        <option value="">&nbsp;</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <i class="fas fa-bath"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <select id="cities" class="form-control">
                                        <option value="">&nbsp;</option>
                                        <option value="1">Los Angeles, CA</option>
                                        <option value="2">New York City, NY</option>
                                        <option value="3">Chicago, IL</option>
                                        <option value="4">Houston, TX</option>
                                        <option value="5">Philadelphia, PA</option>
                                        <option value="6">San Antonio, TX</option>
                                        <option value="7">San Jose, CA</option>
                                    </select>
                                    <i class="ti-briefcase"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="hero-search-action">
                    <a href="#" class="btn search-btn">Search Result</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Hero Banner End ================================== -->

    <!-- ============================ Slide Property Start ================================== -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading2 center  mb-3">
                        <div class="sec-left">
                            <h3>New & featured Property</h3>
                            <p>Find new & featured property for you.</p>
                        </div>
                        <div class="sec-right">
                            <a href="{{ route('frontend.properties') }}">View All<i class="ti-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="property-slide">
                        @if($properties && $properties->count() > 0)
                            @foreach($properties as $property)
                                @php
                                    $pimages = App\Helpers\AppHelper::propertImages($property->id);
                                    $ptype = App\Helpers\AppHelper::propertyType($property->id);
                                    $created_at = Carbon::parse($property->created_at);
                                    $humanDiff = $created_at->diffForHumans();
                                @endphp
                                <!-- Single Property -->
                                <div class="single-items">
                            <div class="property_item classical-list">
                                <div class="image">
                                    <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                        <img src="{{ asset($pimages->first()->image_path) }}" alt="latest property" class="img-fluid">
                                    </a>

                                    <div class="sb-date">
                                        <span class="tag"><i class="ti-calendar"></i>{{ $humanDiff }}</span>
                                    </div>
                                    <span class="tag_t">{{ $property->property_category }}</span>
                                </div>
                                <div class="proerty_content">
                                    <div class="proerty_text">
                                        <h3 class="captlize">
                                            <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                {{ $property->title }}
                                            </a>
                                        </h3>
                                        <p class="proerty_price">{{ App\Helpers\AppHelper::appCurrencySign() }}{{ number_format($property->price) }}</p>
                                    </div>
                                    <p class="property_add">{{ $property->address }}, {{ $property->city }}</p>
                                    <div class="property_meta">
                                        <div class="list-fx-features">
                                            <div class="listing-card-info-icon">
                                                <span class="inc-fleat inc-bed">{{ $property->bedrooms }}</span>
                                            </div>
                                            <div class="listing-card-info-icon">
                                                <span class="inc-fleat inc-type">{{ $ptype->name }}</span>
                                            </div>
                                            <div class="listing-card-info-icon">
                                                <span class="inc-fleat inc-area">{{ $property->size_sqft }}</span>
                                            </div>
                                            <div class="listing-card-info-icon">
                                                <span class="inc-fleat inc-bath">{{ $property->bathrooms }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="property_links">
                                        <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}" class="btn btn-theme-light">Property Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @else
                            <p>No properties available.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ============================ Slide Property End ================================== -->

    <!-- ============================ Slide Location Start ================================== -->
    <section class="pt-0">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading2 center">
                        <div class="sec-left">
                            <h3>Find properties in these cities</h3>
                            <p>Find new & featured property for you.</p>
                        </div>
                        <div class="sec-right">
                            <a href="half-map.html">View All<i class="ti-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="location-slide">

                        <!-- Single location -->
                        <div class="single-items">
                            <a href="listings-list-with-sidebar.html" class="img-wrap">
                                <div class="img-wrap-content visible">
                                    <h4>New York City</h4>
                                    <span>24 Properties</span>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/img/city-1.jpg);"></div>
                            </a>
                        </div>

                        <!-- Single location -->
                        <div class="single-items">
                            <a href="listings-list-with-sidebar.html" class="img-wrap">
                                <div class="img-wrap-content visible">
                                    <h4>New York, USA</h4>
                                    <span>10 Properties</span>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/img/city-2.jpg);"></div>
                            </a>
                        </div>

                        <!-- Single location -->
                        <div class="single-items">
                            <a href="listings-list-with-sidebar.html" class="img-wrap">
                                <div class="img-wrap-content visible">
                                    <h4>Canada, Montrial</h4>
                                    <span>24 Properties</span>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/img/city-3.jpg);"></div>
                            </a>
                        </div>

                        <!-- Single location -->
                        <div class="single-items">
                            <a href="listings-list-with-sidebar.html" class="img-wrap">
                                <div class="img-wrap-content visible">
                                    <h4>New York City</h4>
                                    <span>24 Properties</span>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/img/city-4.jpg);"></div>
                            </a>
                        </div>

                        <!-- Single location -->
                        <div class="single-items">
                            <a href="listings-list-with-sidebar.html" class="img-wrap">
                                <div class="img-wrap-content visible">
                                    <h4>Los Angeles</h4>
                                    <span>04 Properties</span>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/img/city-5.jpg);"></div>
                            </a>
                        </div>

                        <!-- Single location -->
                        <div class="single-items">
                            <a href="listings-list-with-sidebar.html" class="img-wrap">
                                <div class="img-wrap-content visible">
                                    <h4>Las Vegas, Nevada</h4>
                                    <span>07 Properties</span>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/img/city-6.jpg);"></div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ============================ Slide Location End ================================== -->

    <!-- ============================ Browse Place ================================== -->
    <section class="image-cover" style="background:url(assets/img/new-banner-3.jpg) no-repeat;" data-overlay="3">
        <div class="ht-50"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <div class="home-slider-container">
                        <!-- Slide Title -->
                        <div class="home-slider-desc">
                            <div class="modern-pro-wrap">
                                <span class="property-type">For Sale</span>
                                <span class="property-featured theme-bg">Featured</span>
                            </div>
                            <div class="home-slider-title">
                                <h3><a href="single-property-1.html">Aashirvaad Apartment</a></h3>
                                <span><i class="lni-map-marker"></i> 778 Country St. Panama City, FL</span>
                            </div>

                            <div class="slide-property-info">
                                <ul>
                                    <li>Beds: 4</li>
                                    <li>Bath: 2</li>
                                    <li>sqft: 5270</li>
                                </ul>
                            </div>

                            <div class="listing-price-with-compare">
                                <h4 class="list-pr theme-cl">$2,580</h4>
                                <div class="lpc-right">
                                    <a href="compare-property.html" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="ti-control-shuffle"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="ti-heart"></i></a>
                                </div>
                            </div>

                            <a href="single-property-1.html" class="read-more">View Details <i class="fa fa-angle-right"></i></a>

                        </div>
                        <!-- Slide Title / End -->
                    </div>
                </div>
            </div>
        </div>
        <div class="ht-50"></div>
    </section>
    <!-- ============================ Browse Place End ================================== -->

    <!-- ============================ Featured Property Start ================================== -->
    <section class="pb-0">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading2 center">
                        <div class="sec-left">
                            <h3>Featured Properties</h3>
                            <p>Find new & featured property for you.</p>
                        </div>
                        <div class="sec-right">
                            <a href="half-map.html">View All<i class="ti-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="property-slide">
                        @if($fproperties && $properties->count() > 0)
                            @foreach($fproperties as $property)
                                @php
                                    $pimages = App\Helpers\AppHelper::propertImages($property->id);
                                    $ptype = App\Helpers\AppHelper::propertyType($property->id);
                                    $created_at = Carbon::parse($property->created_at);
                                    $humanDiff = $created_at->diffForHumans();
                                @endphp
                                    <!-- Single Property -->
                                <div class="single-items">
                                    <div class="property_item classical-list">
                                        <div class="image">
                                            <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                <img src="{{ asset($pimages->first()->image_path) }}" alt="latest property" class="img-fluid">
                                            </a>

                                            <div class="sb-date">
                                                <span class="tag"><i class="ti-calendar"></i>{{ $humanDiff }}</span>
                                            </div>
                                            <span class="tag_t">{{ $property->property_category }}</span>
                                        </div>
                                        <div class="proerty_content">
                                            <div class="proerty_text">
                                                <h3 class="captlize">
                                                    <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                        {{ $property->title }}
                                                    </a>
                                                </h3>
                                                <p class="proerty_price">{{ App\Helpers\AppHelper::appCurrencySign() }}{{ number_format($property->price) }}</p>
                                            </div>
                                            <p class="property_add">{{ $property->address }}, {{ $property->city }}</p>
                                            <div class="property_meta">
                                                <div class="list-fx-features">
                                                    <div class="listing-card-info-icon">
                                                        <span class="inc-fleat inc-bed">{{ $property->bedrooms }}</span>
                                                    </div>
                                                    <div class="listing-card-info-icon">
                                                        <span class="inc-fleat inc-type">{{ $ptype->name }}</span>
                                                    </div>
                                                    <div class="listing-card-info-icon">
                                                        <span class="inc-fleat inc-area">{{ $property->size_sqft }}</span>
                                                    </div>
                                                    <div class="listing-card-info-icon">
                                                        <span class="inc-fleat inc-bath">{{ $property->bathrooms }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="property_links">
                                                <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}" class="btn btn-theme-light">Property Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No properties available.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ============================ Featured Property End ================================== -->

    <!-- ============================ Agent Start ================================== -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading2 center">
                        <div class="sec-left">
                            <h3>Featured agents</h3>
                            <p>Find new & featured property for you.</p>
                        </div>
                        <div class="sec-right">
                            <a href="half-map.html">View All<i class="ti-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Single Agent -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="agents-grid">

                        <div class="jb-bookmark"><a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Bookmark"><i class="ti-bookmark"></i></a></div>
                        <div class="agent-call"><a href="#"><i class="lni-phone-handset"></i></a></div>
                        <div class="agents-grid-wrap">

                            <div class="fr-grid-thumb">
                                <a href="agent-page.html">
                                    <div class="overall-rate">4.5</div>
                                    <img src="assets/img/user-1.jpg" class="img-fluid mx-auto" alt="" />
                                </a>
                            </div>
                            <div class="fr-grid-deatil">
                                <h5 class="fr-can-name"><a href="agent-page.html">Colin H. Renda</a></h5>
                                <span class="fr-position"><i class="lni-map-marker"></i>3599 Huntz Lane</span>
                                <span class="agent-type theme-cl">Dealer</span>
                            </div>

                        </div>

                        <div class="fr-grid-footer">
                            <ul class="fr-grid-social">
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Single Agent -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="agents-grid">

                        <div class="jb-bookmark"><a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Bookmark"><i class="ti-bookmark"></i></a></div>
                        <div class="agent-call"><a href="#"><i class="lni-phone-handset"></i></a></div>
                        <div class="agents-grid-wrap">

                            <div class="fr-grid-thumb">
                                <a href="agent-page.html">
                                    <div class="overall-rate">4.7</div>
                                    <img src="assets/img/user-2.jpg" class="img-fluid mx-auto" alt="" />
                                </a>
                            </div>
                            <div class="fr-grid-deatil">
                                <h5 class="fr-can-name"><a href="agent-page.html">James N. Green</a></h5>
                                <span class="fr-position"><i class="lni-map-marker"></i>3940 Star Trek</span>
                                <span class="agent-type theme-cl">Agent</span>
                            </div>

                        </div>

                        <div class="fr-grid-footer">
                            <ul class="fr-grid-social">
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Single Agent -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="agents-grid">

                        <div class="jb-bookmark"><a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Bookmark"><i class="ti-bookmark"></i></a></div>
                        <div class="agent-call"><a href="#"><i class="lni-phone-handset"></i></a></div>
                        <div class="agents-grid-wrap">

                            <div class="fr-grid-thumb">
                                <a href="agent-page.html">
                                    <div class="overall-rate">4.9</div>
                                    <img src="assets/img/user-3.jpg" class="img-fluid mx-auto" alt="" />
                                </a>
                            </div>
                            <div class="fr-grid-deatil">
                                <h5 class="fr-can-name"><a href="agent-page.html">Colin H. Renda</a></h5>
                                <span class="fr-position"><i class="lni-map-marker"></i>34 Marion Street</span>
                                <span class="agent-type theme-cl">Dealer</span>
                            </div>

                        </div>

                        <div class="fr-grid-footer">
                            <ul class="fr-grid-social">
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Single Agent -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="agents-grid">

                        <div class="jb-bookmark"><a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Bookmark"><i class="ti-bookmark"></i></a></div>
                        <div class="agent-call"><a href="#"><i class="lni-phone-handset"></i></a></div>
                        <div class="agents-grid-wrap">

                            <div class="fr-grid-thumb">
                                <a href="agent-page.html">
                                    <div class="overall-rate">4.7</div>
                                    <img src="assets/img/user-8.jpg" class="img-fluid mx-auto" alt="" />
                                </a>
                            </div>
                            <div class="fr-grid-deatil">
                                <h5 class="fr-can-name"><a href="agent-page.html">Litha N. Wreek</a></h5>
                                <span class="fr-position"><i class="lni-map-marker"></i>1122 Flint Street</span>
                                <span class="agent-type theme-cl">Broker</span>
                            </div>

                        </div>

                        <div class="fr-grid-footer">
                            <ul class="fr-grid-social">
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- ============================ Agent End ================================== -->

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
@section('script')
@endsection

