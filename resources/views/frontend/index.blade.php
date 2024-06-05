@extends('frontend.main')
@section('title',$title)
@section('home-page','active')
@section('style')
@stop
@section('content')
    @php
        use Carbon\Carbon;
        use App\Helpers\AppHelper;
    @endphp
        <!-- ============================ Hero Banner  Start================================== -->
    <div class="image-cover hero-banner" style="background:url('{{ asset('assets/img/a.jpg') }}') no-repeat;">
        <div class="container">
            <div class="hero-search-wrap">
                <div class="hero-search">
                    <h1>Find Your Dream</h1>
                </div>
                <form action="{{ route('frontend.properties') }}" method="GET">
                    <div class="hero-search-content">

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="number" name="min_price" class="form-control"
                                               placeholder="Maximum Price" value="{{ request('min_price') }}">                                    <i class="ti-money"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="number" name="max_price" class="form-control"
                                               placeholder="Maximum Price" value="{{ request('max_price') }}">                                    <i class="ti-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <select name="bedrooms" class="form-control">
                                            <option value="">Bedrooms</option>
                                            @for ($i = 1; $i <= 15; $i++)
                                                <option
                                                    value="{{ $i }}" {{ request('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <i class="fas fa-bed"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <select name="bathrooms" class="form-control">
                                            <option value="">Bathrooms</option>
                                            @for ($i = 1; $i <= 15; $i++)
                                                <option
                                                    value="{{ $i }}" {{ request('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
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
                                        <select name="city" class="form-control">
                                            <option value="">--City--</option>
                                            @foreach($fproperties->unique('city') as $property)
                                                <option value="{{$property->city}}" {{ request('city') == $property->city ? 'selected' : '' }}>
                                                    {{ $property->city }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="ti-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="hero-search-action">
                        <button class="btn search-btn" type="submit">Search Result</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================ Hero Banner End ================================== -->

    <!-- ============================ Slide Property Start ================================== -->
    @if($properties && $properties->count() > 0)
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
                            <a href="{{ route('frontend.properties') }}">View All<i
                                    class="ti-angle-double-right ml-2"></i></a>
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
                                    $pimages = AppHelper::propertImages($property->id);
                                    $ptype = AppHelper::propertyType($property->id);
                                    $created_at = Carbon::parse($property->created_at);
                                    $humanDiff = $created_at->diffForHumans();
                                @endphp
                                    <!-- Single Property -->
                                <div class="single-items">
                                    <div class="property_item classical-list">
                                        <div class="image">
                                            <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                <img src="{{ asset($pimages->first()->image_path) }}"
                                                     alt="latest property" class="img-fluid">
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
                                                <p class="proerty_price">{{ AppHelper::appCurrencySign() }}{{ number_format($property->price) }}</p>
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
                                                        <span
                                                            class="inc-fleat inc-area">{{ $property->size_sqft }}</span>
                                                    </div>
                                                    <div class="listing-card-info-icon">
                                                        <span
                                                            class="inc-fleat inc-bath">{{ $property->bathrooms }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="property_links">
                                                <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}"
                                                   class="btn btn-theme-light">Property Detail</a>
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
    @endif
    <!-- ============================ Slide Property End ================================== -->

    <!-- ============================ Agencies Start ================================== -->
    @if($agencies->count() > 0)
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading2 center">
                        <div class="sec-left">
                            <h3>Featured agencies</h3>
                            <p>Find new & featured property for you.</p>
                        </div>
                        <div class="sec-right">
                            <a href="{{ url('agencies') }}">View All<i class="ti-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                    @foreach($agencies as $agency)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="agents-grid">
                                <div class="agent-call">
                                    <a href="https://wa.me/{{ $agency->whatsapp_phone }}">
                                        <i class="lni-whatsapp"></i>
                                    </a>
                                </div>
                                <div class="agents-grid-wrap">
                                    <div class="fr-grid-thumb">
                                        <a href="{{ route('frontend.agency',$agency->id) }}">
                                            <img src="{{ asset('uploads/'.$agency->agency_logo) }}" class="img-fluid mx-auto" alt=""/>
                                        </a>
                                    </div>
                                    <div class="fr-grid-deatil">
                                        <h5 class="fr-can-name font-14">
                                            <a href="{{ route('frontend.agency',$agency->id) }}">{{ $agency->first_name .' '. $agency->last_name }}</a>
                                        </h5>
                                        <span class="fr-position"><i class="lni-map-marker"></i>{{ $agency->city .' '. $agency->state }}</span>
                                        <span class="agent-type theme-cl">Agency</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- ============================ Agencies End ================================== -->

    <!-- ============================ Browse Place ================================== -->
    @php
        $pimages = AppHelper::propertImages($fproperty->id);
        $ptype = AppHelper::propertyType($fproperty->id);
        $created_at = Carbon::parse($fproperty->created_at);
        $humanDiff = $created_at->diffForHumans();
    @endphp
    <section class="image-cover" style="background:url({{ asset('assets/img/new-banner-3.jpg') }}) no-repeat;" data-overlay="3">
        <div class="ht-50"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <div class="home-slider-container">
                        <!-- Slide Title -->
                        <div class="home-slider-desc">
                            <div class="modern-pro-wrap">
                                <span class="property-type">{{ $fproperty->property_category }}</span>
                                <span class="property-featured theme-bg">Featured</span>
                            </div>
                            <div class="home-slider-title">
                                <h3><a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">{{ $fproperty->title }}</a></h3>
                                <span><i class="lni-map-marker"></i> {{ $property->address }}, {{ $property->city }}</span>
                            </div>

                            <div class="slide-property-info">
                                <ul>
                                    <li>Beds: {{ $property->bedrooms }}</li>
                                    <li>Bath: {{ $property->bathrooms }}</li>
                                    <li>sqft: {{ $property->size_sqft }}</li>
                                </ul>
                            </div>

                            <div class="listing-price-with-compare">
                                <h4 class="list-pr theme-cl">{{ AppHelper::appCurrencySign() }}{{ number_format($property->price) }}</h4>
                                <div class="lpc-right">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        <i class="ti-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}" class="read-more">View Details <i class="fa fa-angle-right"></i></a>

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
    @if($fproperties && $properties->count() > 0)
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
                            <a href="{{ url('properties') }}">View All<i class="ti-angle-double-right ml-2"></i></a>
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
                                    $pimages = AppHelper::propertImages($property->id);
                                    $ptype = AppHelper::propertyType($property->id);
                                    $created_at = Carbon::parse($property->created_at);
                                    $humanDiff = $created_at->diffForHumans();
                                @endphp
                                    <!-- Single Property -->
                                <div class="single-items">
                                    <div class="property_item classical-list">
                                        <div class="image">
                                            <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                <img src="{{ asset($pimages->first()->image_path) }}"
                                                     alt="latest property" class="img-fluid">
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
                                                <p class="proerty_price">{{ AppHelper::appCurrencySign() }}{{ number_format($property->price) }}</p>
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
                                                        <span
                                                            class="inc-fleat inc-area">{{ $property->size_sqft }}</span>
                                                    </div>
                                                    <div class="listing-card-info-icon">
                                                        <span
                                                            class="inc-fleat inc-bath">{{ $property->bathrooms }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="property_links">
                                                <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}"
                                                   class="btn btn-theme-light">Property Detail</a>
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
    @endif
    <!-- ============================ Featured Property End ================================== -->

    <!-- ============================ Agent Start ================================== -->
    @if($agents->count() > 0)
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
                            <a href="{{ url('agents') }}">View All<i class="ti-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @if($agents)
                    @foreach($agents as $agent)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="agents-grid">
                                <div class="agent-call">
                                    <a href="https://wa.me/{{ $agent->whatsapp_phone }}">
                                        <i class="lni-whatsapp"></i>
                                    </a>
                                </div>
                                <div class="agents-grid-wrap">
                                    <div class="fr-grid-thumb">
                                        <a href="{{ route('frontend.agency',$agency->id) }}">
                                            <img src="{{ asset('uploads/'.$agent->photo) }}" class="img-fluid mx-auto" alt=""/>
                                        </a>
                                    </div>
                                    <div class="fr-grid-deatil">
                                        <h5 class="fr-can-name font-14">
                                            <a href="{{ route('frontend.agency',$agency->id) }}">{{ $agent->first_name .' '. $agent->last_name }}</a>
                                        </h5>
                                        <span class="fr-position"><i class="lni-map-marker"></i>{{ $agent->city .' '. $agent->state }}</span>
                                        <span class="agent-type theme-cl">Agent</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
        </section>
    @endif
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
                        <a href="{{ url('signup') }}" class="btn btn-call-to-act">SignUp Today</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Call To Action End ================================== -->

@stop
@section('script')
@endsection

