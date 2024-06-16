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
                                        <select name="city_id" class="form-control">
                                            <option value="">--City--</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" {{ request('city_id') == $city->name ? 'selected' : '' }}>{{ $city->name }}</option>
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
                            <h3>New  Property</h3>
                            <p>Find new  property for you.</p>
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
                                    $pimages = $pimages = $property->images;
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
                                            <span class="tag_p">
                                                    {{ $property->country->currency_sign }}{{ number_format($property->price) }}
                                                       @if(!is_null($property->rental_duration) && $property->rental_duration != null)
                                                           <i>/ {{ $property->rental_duration}}</i>
                                                       @endif
                                            </span>
                                        </div>
                                        <div class="proerty_content">
                                            <div class="proerty_text">
                                                <h3 class="captlize">
                                                    <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                        {{ $property->title }}
                                                    </a>
                                                </h3>

                                            </div>
                                            <p class="property_add">{{ $property->address }} </p>
                                            <div class="property_meta">
                                                <div class="list-fx-features">
                                                    <div class="listing-card-info-icon">
                                                        <span class="inc-fleat inc-bed">{{ $property->bedrooms }}</span>
                                                    </div>
                                                    <div class="listing-card-info-icon">
                                                        <span class="inc-fleat inc-type">{{ $property->propertyType->name }}</span>
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
                                        <span class="fr-position"><i class="lni-map-marker"></i>{{ $agency->city->name .' '. $agency->state->name }}</span>
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

    <!-- ============================ Slide Location Start ================================== -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading center">
                        <h2>Find Properties By Locations</h2>
                        <p>Top &amp; perfect 100+ location to find best properties.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Location Listing -->
                @foreach($cityProperties as $cityProperty)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="location-listing">
                        <div class="location-listing-thumb">
                            <a href="{{ route('frontend.properties', ['city_id' => $cityProperty->city->id]) }}">
                                <img src="{{ asset('city_images/'.$cityProperty->city->image) }}" class="city-img-fluid" alt=""></a>
                        </div>
                        <div class="location-listing-caption">
                            <h4>
                                <a href="{{ route('frontend.properties', ['city_id' => $cityProperty->city->id]) }}">{{ $cityProperty->city->name }}</a></h4>
                            <span class="theme-cl">{{ $cityProperty->property_count }} Property</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ============================ Slide Location End ================================== -->

    <!-- ============================ Featured Property Start ================================== -->
    @if($fproperties && $fproperties->count() > 0)
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
                        @if($fproperties && $fproperties->count() > 0)
                            @foreach($fproperties as $property)
                                @php
                                    $pimages = $pimages = $property->images;
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
                                            <span class="tag_p">
                                                {{ $property->country->currency_sign }}{{ number_format($property->price) }}
                                                @if(!is_null($property->rental_duration) && $property->rental_duration != null)
                                                    <i>/ {{ $property->rental_duration}}</i>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="proerty_content">
                                            <div class="proerty_text">
                                                <h3 class="captlize">
                                                    <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                        {{ $property->title }}
                                                    </a>
                                                </h3>
                                            </div>
                                            <p class="property_add">{{ $property->address }} </p>
                                            <div class="property_meta">
                                                <div class="list-fx-features">
                                                    <div class="listing-card-info-icon">
                                                        <span class="inc-fleat inc-bed">{{ $property->bedrooms }}</span>
                                                    </div>
                                                    <div class="listing-card-info-icon">
                                                        <span class="inc-fleat inc-type">{{$property->propertyType->name}}</span>
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
                        @if($agent->photo)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="agents-grid">
                                <div class="agent-call">
                                    <a href="https://wa.me/{{ $agent->whatsapp_phone }}">
                                        <i class="lni-whatsapp"></i>
                                    </a>
                                </div>
                                <div class="agents-grid-wrap">
                                    <div class="fr-grid-thumb">
                                        <a href="{{ route('frontend.agent',$agent->id) }}">
                                            <img src="{{ asset('uploads/'.$agent->photo) }}" class="img-fluid mx-auto" alt=""/>
                                        </a>
                                    </div>
                                    <div class="fr-grid-deatil">
                                        <h5 class="fr-can-name font-14">
                                            <a href="{{ route('frontend.agent',$agent->id) }}">{{ $agent->first_name .' '. $agent->last_name }}</a>
                                        </h5>
                                        <span class="fr-position"><i class="lni-map-marker"></i>{{ $agent->city->name .' '. $agent->state->name }}</span>
                                        <span class="agent-type theme-cl">Agent</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif
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

