@extends('frontend.main')
@section('title',$title)
@section('properties-page','active')
@section('style')
@stop
@section('content')
    <div class="page-title bb-title" style="background:url({{ asset('assets/img/bg.jpg') }}) no-repeat;"
         data-overlay="6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2 class="ipt-title">Property List</h2>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="simple-sidebar sm-sidebar mb-5">
                        <div class="sidebar-widgets">
                            <h5 class="mb-3">Find New Property</h5>
                            <form action="{{ route('frontend.properties') }}" method="GET">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="number" name="min_price" class="form-control"
                                                       placeholder="Minimum Price" value="{{ request('min_price') }}">
                                                <i class="ti-money"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="number" name="max_price" class="form-control"
                                                       placeholder="Maximum Price" value="{{ request('max_price') }}">
                                                <i class="ti-money"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <select name="bedrooms" class="form-control">
                                                    <option value="">Bedrooms</option>
                                                    @for ($i = 1; $i <= 50; $i++)
                                                        <option
                                                            value="{{ $i }}" {{ request('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <!-- Bathrooms -->
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <select name="bathrooms" class="form-control">
                                                    <option value="">Bathrooms</option>
                                                    @for ($i = 1; $i <= 50; $i++)
                                                        <option
                                                            value="{{ $i }}" {{ request('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <select name="property_category" class="form-control">
                                                    <option value="">Type</option>
                                                    <option
                                                        value="Rent" {{ request('property_category') == 'Rent' ? 'selected' : '' }}>
                                                        For Rent
                                                    </option>
                                                    <option
                                                        value="Sale" {{ request('property_category') == 'Sale' ? 'selected' : '' }}>
                                                        For Sale
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <select name="city" class="form-control">
                                                    <option value="">--City--</option>
                                                    @foreach($fproperties->unique('city') as $property)
                                                        <option
                                                            value="{{$property->city}}" {{ request('city') == $property->city ? 'selected' : '' }}>
                                                            {{ $property->city }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <a href="{{ route('frontend.properties') }}"
                                               class="btn reset-btn-outline p-3">Search Reset</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn search-btn-outline p-3">Filter Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Sidebar End -->
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="filter-fl">
                                <h4>Total Property Find is: <span class="theme-cl">
                                        @if($properties && $properties->count() > 0)
                                            {{ $properties->count() }}
                                        @else
                                            0
                                        @endif
                                    </span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if($properties && $properties->count() > 0)
                            @foreach($properties as $property)
                                @php $pimages = App\Helpers\Helpers::propertImages($property->id) @endphp
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="property-listing property-1">
                                        <div class="listing-img-wrapper">
                                            @if($pimages->isNotEmpty())
                                                <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                    <img src="{{ asset($pimages->first()->image_path) }}"
                                                         class="img-fluid mx-auto" alt="">
                                                </a>
                                            @endif
                                            <span class="property-type">{{ $property->property_category }}</span>
                                        </div>

                                        <div class="listing-content">
                                            <div class="listing-detail-wrapper">
                                                <div class="listing-short-detail">
                                                    <h4 class="listing-name">
                                                        <a href="{{ route('frontend.property-detail',['id' => $property->id,'title' => $property->title]) }}">{{ $property->title }}</a>
                                                    </h4>
                                                    <span class="listing-location"><i class="ti-location-pin"></i>{{ $property->address }}, {{ $property->city }}</span>
                                                </div>
                                            </div>

                                            <div class="listing-features-info">
                                                <ul>
                                                    <li><strong>Bed:</strong> {{ $property->bedrooms }}</li>
                                                    <li><strong>Bath:</strong> {{ $property->bathrooms }}</li>
                                                    <li><strong>Sqft:</strong> {{ $property->size_sqft }}</li>
                                                </ul>
                                            </div>

                                            <div class="listing-footer-wrapper">
                                                <div class="listing-price">
                                                    <h4 class="list-pr">{{ App\Helpers\Helpers::appCurrencySign() }}{{ number_format($property->price) }}</h4>
                                                </div>
                                                <div class="listing-detail-btn">
                                                    <a href="{{ route('frontend.property-detail',['id' => $property->id,'title' => $property->title]) }}"
                                                       class="more-btn">More Info</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No properties available.</p>
                        @endif
                    </div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="pagination p-center">
                                {{ $properties->links('vendor.pagination.bootstrap-4') }}
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@endsection

