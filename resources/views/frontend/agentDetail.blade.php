@extends('frontend.main')
@section('title',$title)
@section('agents-page','active')
@section('style')
@stop
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="agent-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="agency agency-list shadow-0 mt-2 mb-2">
                        <a href="javascript:void(0);" class="agency-avatar">
                            <img src="{{ asset('uploads/'.$agent->photo) }}" alt="">
                        </a>
                        <div class="agency-content">
                            <div class="agency-name">
                                <h4><a href="javascript:void(0);">{{ $agent->first_name .' '. $agent->last_name }}</a>
                                </h4>
                                <span>
                                   <i class="lni-map-marker"></i>{{ $agent->city->name .' '. $agent->state->name }}
                                 </span>
                            </div>
                            <div class="agency-desc">
                                <p>{{ $agent->bio }}</p>
                            </div>
                            <ul class="agency-detail-info">
                                <li><i class="lni-phone-handset"></i>{{ $agent->phone }}</li>
                                <li><i class="lni-envelope"></i><a href="#">{{ $agent->email }}</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="gray">
        <div class="container">
            <div class="row">
                <!-- property main detail -->
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="block-wraps">
                        <div class="block-header">
                            <ul class="nav nav-tabs customize-tab" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="rental-tab" data-toggle="tab" href="#rental"
                                       role="tab" aria-controls="rental" aria-selected="true">Rental</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sale-tab" data-toggle="tab" href="#sale" role="tab"
                                       aria-controls="sale" aria-selected="false">For Sale</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="rental" role="tabpanel"
                                     aria-labelledby="rental-tab">
                                    <div class="row">
                                        @if($properties && $properties->count() > 0)
                                            @foreach($properties as $property)
                                                @if($property->property_category == 'Rent')
                                                    <div class="col-lg-4 col-md-6 col-sm-12 list-layout">
                                                        @php
                                                            $pimages = $property->images;
                                                            $created_at = Carbon::parse($property->created_at);
                                                            $humanDiff = $created_at->diffForHumans();
                                                        @endphp
                                                        <div class="single-items">
                                                            <div class="property_item classical-list">
                                                                <div class="image">
                                                                    <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                                        <img
                                                                            src="{{ asset($pimages->first()->image_path) }}"
                                                                            alt="latest property" class="img-fluid">
                                                                    </a>
                                                                    <div class="sb-date">
                                                                        <span class="tag"><i class="ti-calendar"></i>{{ $humanDiff }}</span>
                                                                    </div>
                                                                    <span
                                                                        class="tag_t">{{ $property->property_category }}</span>
                                                                </div>
                                                                <div class="proerty_content">
                                                                    <div class="proerty_text">
                                                                        <h3 class="captlize">
                                                                            <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                                                {{ $property->title }}
                                                                            </a>
                                                                        </h3>
                                                                        <p class="proerty_price">{{ $property->country->currency_sign }}{{ number_format($property->price) }}</p>
                                                                    </div>
                                                                    <p class="property_add">{{ $property->address }}, {{ $property->city->name }}</p>
                                                                    <div class="property_meta">
                                                                        <div class="list-fx-features">
                                                                            <div class="listing-card-info-icon">
                                                                                <span
                                                                                    class="inc-fleat inc-bed">{{ $property->bedrooms }}</span>
                                                                            </div>
                                                                            <div class="listing-card-info-icon">
                                                                                <span
                                                                                    class="inc-fleat inc-type">{{ $property->propertyType->name }}</span>
                                                                            </div>
                                                                            <div class="listing-card-info-icon">
                                                                                <span
                                                                                    class="inc-fleat inc-area">{{ $property->size_sqft }}</span>
                                                                            </div>
                                                                            <div
                                                                                class="listing-card-info-icon">
                                                                                <span
                                                                                    class="inc-fleat inc-bath">{{ $property->bathrooms }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="property_links">
                                                                        <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}"
                                                                           class="btn btn-theme-light">Property
                                                                            Detail</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p>No properties available.</p>
                                        @endif
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="sale"
                                     role="tabpanel"
                                     aria-labelledby="sale-tab">
                                    <div class="row">
                                        @if($properties && $properties->count() > 0)
                                            @foreach($properties as $property)
                                                @if($property->property_category == 'Sale')
                                                    <div class="col-lg-4 col-md-6 col-sm-12 list-layout">
                                                        @php
                                                            $pimages = $property->images;
                                                            $created_at = Carbon::parse($property->created_at);
                                                            $humanDiff = $created_at->diffForHumans();
                                                        @endphp
                                                        <div class="single-items">
                                                            <div class="property_item classical-list">
                                                                <div class="image">
                                                                    <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                                        <img
                                                                            src="{{ asset($pimages->first()->image_path) }}"
                                                                            alt="latest property" class="img-fluid">
                                                                    </a>
                                                                    <div class="sb-date">
                                                                        <span class="tag"><i class="ti-calendar"></i>{{ $humanDiff }}</span>
                                                                    </div>
                                                                    <span
                                                                        class="tag_t">{{ $property->property_category }}</span>
                                                                </div>
                                                                <div class="proerty_content">
                                                                    <div class="proerty_text">
                                                                        <h3 class="captlize">
                                                                            <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                                                {{ $property->title }}
                                                                            </a>
                                                                        </h3>
                                                                        <p class="proerty_price">{{ $property->country->currency_sign }}{{ number_format($property->price) }}</p>
                                                                    </div>
                                                                    <p class="property_add">{{ $property->address }}, {{ $property->city->name }}</p>
                                                                    <div class="property_meta">
                                                                        <div class="list-fx-features">
                                                                            <div class="listing-card-info-icon">
                                                                                <span
                                                                                    class="inc-fleat inc-bed">{{ $property->bedrooms }}</span>
                                                                            </div>
                                                                            <div class="listing-card-info-icon">
                                                                                <span
                                                                                    class="inc-fleat inc-type">{{ $property->propertyType->name }}</span>
                                                                            </div>
                                                                            <div class="listing-card-info-icon">
                                                                                <span
                                                                                    class="inc-fleat inc-area">{{ $property->size_sqft }}</span>
                                                                            </div>
                                                                            <div
                                                                                class="listing-card-info-icon">
                                                                                <span
                                                                                    class="inc-fleat inc-bath">{{ $property->bathrooms }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="property_links">
                                                                        <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}"
                                                                           class="btn btn-theme-light">Property
                                                                            Detail</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p>No properties available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@endsection
