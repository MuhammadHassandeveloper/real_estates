@extends('admin.main')
@section('title',$title)
@section('properties-drops','show')
@section('properties_list','active')
@section('style')
@stop
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reale Estate</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if($property->property_category == 'Sale')
                @php
                    $ppdetail = App\Models\PropertyPurchase::where('property_id', $property->id)->first();
                @endphp

                @if($ppdetail && $ppdetail->customer_id)
                    @php
                        $res =  App\Helpers\AppHelper::property_purchased_status($ppdetail->purchased_status);
                              $bgColor = $res[0];
                              $color = $res[1];
                              $text = $res[2];


                              $ress =  App\Helpers\AppHelper::property_payment_status($ppdetail->purchased_payment_status);
                              $pay_bgColor = $ress[0];
                              $pay_color = $ress[1];
                              $pay_text = $ress[2];

                              $dateString = $ppdetail['purchased_date'] . ' ' . $ppdetail['purchased_time'];
                              $dateTime = new DateTime($dateString);
                              $formattedDate = $dateTime->format("d M Y,h:i A");
                              $customer = App\Models\User::find($ppdetail->customer_id);
                              $agent = App\Models\User::find($ppdetail->agent_id);
                    @endphp
                    <div class="row">
                        <h6 class="card-title mb-2 mt-2">More About Property Purchase </h6>
                        <div class="col-xxl-4 col-lg-4 col-md-4 col-12">
                            <div class="card border-bottom border-2 border-secondary">
                                <div class="card-body d-flex gap-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-3">Purchased By:</h6>
                                        <p class="fw-medium fs-md mb-1">{{ $customer->first_name }} {{ $customer->last_name }}</p>
                                        <p class="text-muted mb-1">{{ $customer->email }}</p>
                                        <p class="text-muted mb-0">+{{ $customer->phone }}</p>
                                        <p class="text-muted mb-0">{{ $customer->state->name }} {{ $customer->city->name }}</p>
                                    </div>

                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-4 col-lg-4 col-md-4 col-12">
                            <div class="card border-bottom border-2 border-primary">
                                <div class="card-body d-flex gap-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-3">Purchased Detail:</h6>
                                        <p class="fw-medium fs-md mb-0">
                                            <b>Status:</b>
                                            <span class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                        </p>
                                        <p class="fw-medium fs-md mb-0">
                                            <b>Payment Status:</b>
                                            <span
                                                class="badge {{ $pay_bgColor }} {{ $pay_color }} status">{{ $pay_text  }}</span>
                                        </p>

                                        <p class="fw-medium fs-md mb-0">
                                            <b>Purchased
                                                Amount: </b> {{ App\Helpers\AppHelper::appCurrencySign() }}{{ $ppdetail->purchased_price }}
                                        </p>
                                        <p class="fw-medium fs-md mb-0">
                                            <b>Purchased At: </b> {{ $formattedDate }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-4 col-lg-4 col-md-4 col-12">
                            <div class="card border-bottom border-2 border-secondary">
                                <div class="card-body d-flex gap-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-3">Post By:</h6>
                                        <p class="fw-medium fs-md mb-1">{{ $agent->first_name }} {{ $agent->last_name }}</p>
                                        <p class="text-muted mb-1">{{ $agent->email }}</p>
                                        <p class="text-muted mb-0">+{{ $agent->phone }}</p>
                                        <p class="text-muted mb-0">{{ $agent->state->name }} {{ $agent->city->name }}</p>
                                    </div>

                                </div>
                            </div>
                        </div><!--end col-->
                    </div>
                @endif
            @endif
            @if($property->property_category == 'Rent')
                @php
                    $rdetail = App\Models\PropertyRental::where('property_id', $property->id)->first();
                @endphp
                @if($rdetail && $rdetail->customer_id)
                    @php
                        $startDate = Carbon::parse($rdetail->start_date);
                        $endDate = Carbon::parse($rdetail->end_date);
                        $formattedStartDate = $startDate->format('d M Y');
                        $formattedEndDate = $endDate->format('d M Y');
                        $daysDifference = $startDate->diffInDays($endDate);
                        $customer = App\Models\User::find($rdetail->customer_id);
                        $agent = App\Models\User::find($rdetail->agent_id);
                    @endphp
                    <div class="row">
                        <h6 class="card-title mb-2 mt-2">More About Property Rent </h6>
                        <div class="col-xxl-6 col-lg-6 col-md-6 col-12">
                            <div class="card border-bottom border-2 border-secondary">
                                <div class="card-body d-flex gap-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-3">Rental By:</h6>
                                        <p class="fw-medium fs-md mb-1">{{ $customer->first_name }} {{ $customer->last_name }}</p>
                                        <p class="text-muted mb-1">{{ $customer->email }}</p>
                                        <p class="text-muted mb-0">+{{ $customer->phone }}</p>
                                        <p class="text-muted mb-0">{{ $customer->state->name }} {{ $customer->city->name }}</p>
                                    </div>

                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6 col-lg-6 col-md-6 col-12">
                            <div class="card border-bottom border-2 border-secondary">
                                <div class="card-body d-flex gap-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-3">Post By:</h6>
                                        <p class="fw-medium fs-md mb-1">{{ $agent->first_name }} {{ $agent->last_name }}</p>
                                        <p class="text-muted mb-1">{{ $agent->email }}</p>
                                        <p class="text-muted mb-0">+{{ $agent->phone }}</p>
                                        <p class="text-muted mb-0">{{ $agent->state->name }} {{ $agent->city->name }}</p>
                                    </div>

                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-xxl-12 col-12">
                            <div class="card border-bottom border-2 border-primary">
                                <div class="card-body d-flex gap-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-3">Rental Detail:</h6>
                                        <p class="fw-medium fs-md mb-0">
                                            <b>Payment Status:</b>
                                            @php
                                                $res =  App\Helpers\AppHelper::property_payment_status($rdetail->rental_payment_status);
                                                $bgColor = $res[0];
                                                $color = $res[1];
                                                $text = $res[2];
                                            @endphp
                                            <span class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>

                                            @php
                                                $res =  App\Helpers\AppHelper::property_retal_status($rdetail->rental_status);
                                                $bgColor = $res[0];
                                                $color = $res[1];
                                                $text = $res[2];
                                            @endphp
                                            <b>Status:</b>
                                            <span class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                        </p>

                                        <p class="fw-medium fs-md mb-0">
                                            <b>Rental
                                                Amount: </b> {{ App\Helpers\AppHelper::appCurrencySign() }}{{ $rdetail->rental_price }}
                                        </p>
                                        <p class="fw-medium fs-md mb-0">
                                            <b>From:</b> {{ $rdetail->start_date }} <br>
                                            <b>To:</b> {{ $rdetail->end_date }} <br>
                                            <b>Days:</b> {{ $daysDifference }}
                                        </p>
                                        <p class="fw-medium fs-md mb-0">
                                            <b>Customer Note :</b>{{ $rdetail->note }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                    </div>
                @endif
            @endif
            <div class="row">
                @if(isset($nearplaces))
                    @foreach($nearplaces as $place)
                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="card border-bottom border-2 border-secondary">
                                <div class="card-body d-flex gap-3">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-3">Near Places:</h6>
                                        <p class="fw-medium fs-md mb-1"><b>Name:</b>{{ $place->name }}</p>
                                        <p class="text-muted mb-1"><b>Type:</b>{{ $place->type }}</p>
                                        <p class="text-muted mb-0"><b>Distance
                                                (Km):</b>{{ $place->distance }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="swiper property-slider mb-3 swiper-initialized swiper-horizontal swiper-backface-hidden">

                                <div class="swiper-wrapper" id="swiper-wrapper-daa4ad5163e03110e" aria-live="polite">
                                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 3"
                                         data-swiper-slide-index="0" style="width: 100%; margin-right: 20px;">
                                        <div class="position-relative ribbon-box">
                                            <div class="ribbon ribbon-danger fw-medium rounded-end mt-2 mb-3">
                                                For {{ $property->property_category }}
                                            </div>

                                            <div
                                                class="ribbon {{ $property->is_featured ? 'ribbon-success' : 'ribbon-danger' }} fw-medium rounded-end mt-5 mb-2">
                                                {{ $property->is_featured ? 'Featured' : 'Not Featured' }}
                                            </div>

                                            @if($pimages->isNotEmpty())
                                                <img src="{{ asset($pimages->first()->image_path) }}"
                                                     class="img-fluid w-100" style="height: 350px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end slider-->

                            <div class="pt-1">
                                <h6 class="card-title">{{ $property->title }}
                                    (<span class="badge text-bg-info align-middle ms-1">
                                        {{ $property->propertyType->name }}
                                    </span>)
                                    @if(!is_null($property->rental_duration))
                                        (<span class="badge text-bg-warning align-middle ms-1">
                                        {{ $property->rental_duration}}
                                    </span>)
                                    @endif
                                </h6>
                                <div class="text-muted hstack gap-2 flex-wrap list-unstyled mb-3">
                                    <div>
                                        <i class="bi bi-geo-alt align-baseline me-1"></i> {{ $property->address }}
                                        , {{ $property->city->name }}, {{ $property->state->name }}
                                    </div>
                                    <div class="vr"></div>
                                    <div>
                                        <i class="bi bi-calendar-event align-baseline me-1"></i>
                                        Created {{ $property->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <p class="text-muted mb-2">{{ $property->short_description }}</p>
                                <p class="text-muted">{{ $property->short_description }}.</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="card-title mb-3">Property Overview</h6>
                                <div class="row g-3">
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <div class="avatar-title bg-dark-subtle text-dark fs-lg rounded">
                                                        <i class="bi bi-tag"></i>
                                                    </div>
                                                </div>
                                                <p class="fs-md mb-0">{{ \App\Helpers\AppHelper::appCurrencySign() }}{{ $property->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <div
                                                        class="avatar-title bg-warning-subtle text-warning fs-lg rounded">
                                                        <i class="bi bi-house"></i>
                                                    </div>
                                                </div>
                                                <p class="fs-md mb-0">{{ $property->bedrooms }} Bedroom</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <div
                                                        class="avatar-title bg-danger-subtle text-danger fs-lg rounded">
                                                        <i class="ph ph-bathtub"></i>
                                                    </div>
                                                </div>
                                                <p class="fs-md mb-0">{{ $property->bathrooms }} Bathroom</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <div
                                                        class="avatar-title bg-success-subtle text-success fs-lg rounded">
                                                        <i class="bi bi-columns"></i>
                                                    </div>
                                                </div>
                                                <p class="fs-md mb-0">{{ $property->size_sqft }} SQFT</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <div
                                                        class="avatar-title bg-warning-subtle text-warning fs-lg rounded">
                                                        <i class="bi bi-house"></i> <!-- Icon for garages -->
                                                    </div>
                                                </div>
                                                <p class="fs-md mb-0">{{ $property->garages }} Garages</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <div
                                                        class="avatar-title bg-warning-subtle text-warning fs-lg rounded">
                                                        <i class="bi bi-door-open"></i> <!-- Icon for simple rooms -->
                                                    </div>
                                                </div>
                                                <p class="fs-md mb-0">{{ $property->rooms }} Simple Rooms</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-sm-6">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <div
                                                        class="avatar-title bg-warning-subtle text-warning fs-lg rounded">
                                                        <i class="bi bi-building"></i> <!-- Icon for simple rooms -->
                                                    </div>
                                                </div>
                                                <p class="fs-md mb-0">{{ $property->building_age }} Building Or Property
                                                    Age</p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="mb-3">
                                <h6 class="card-title mb-3">Property Features</h6>
                                <ul class="list-unstyled hstack flex-wrap gap-3">
                                    @php
                                        $selected_features = $property->features();
                                    @endphp
                                    @foreach($selected_features as $feature)
                                        <li class="w-lg">{{ $feature->name }}</li>
                                    @endforeach
                                </ul>
                            </div>


                            <div class="swiper-wrapper" id="swiper-wrapper-daa4ad5163e03110e" aria-live="polite">
                                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 3"
                                     data-swiper-slide-index="0" style="width: 100%; margin-right: 20px;">
                                    <h6 class="card-title mb-3">Property Images</h6>
                                    <div class="position-relative ribbon-box">
                                        @if($pimages->isNotEmpty())
                                            <div class="row">
                                                @foreach($pimages as $index => $image)
                                                    @if($index > 0 && $index % 2 == 0)
                                            </div>
                                            <div class="swiper-slide swiper-slide-active" role="group"
                                                 aria-label="1 / 3" data-swiper-slide-index="{{ floor($index / 2) }}"
                                                 style="width: 100%; margin-right: 20px;">
                                                <div class="position-relative ribbon-box">
                                                    <div class="row">
                                                        @endif
                                                        <div class="col-lg-6 col-12 mb-3">
                                                            <img src="{{ asset($image->image_path) }}" class="img-fluid"
                                                                 style="height: 350px;">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                    </div>

                                </div>
                            </div>
                        </div><!--end col-->


                    </div><!--end row-->
                </div>
                <!-- container-fluid -->
            </div>

            @if(isset($reviews) && $reviews->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center gap-3 mb-2">
                            <h6 class="card-title flex-grow-1 mb-0">Customer  Reviews For Property</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="me-lg-n3 pe-lg-4 simplebar-scrollable-y" data-simplebar="init"
                                             style="max-height: 500px;">
                                            <div class="simplebar-wrapper" style="margin: 0px -24px 0px 0px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" tabindex="0"
                                                             role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                                            <div class="simplebar-content" style="padding: 0px 24px 0px 0px;">
                                                                <ul class="list-unstyled mb-0" id="review-list">
                                                                    @foreach($reviews as $review)
                                                                        <li class="review-list py-2" id="review-1">
                                                                            <div class="border border-dashed rounded p-3">
                                                                                <div class="hstack flex-wrap gap-3 mb-4">
                                                                                    <div class="vr"></div>
                                                                                    <div class="flex-grow-1">
                                                                                        <p class="mb-0">
                                                                                            <a href="javascript:void(0)">
                                                                                                {{ $review->name }} <br>
                                                                                                {{ $review->email }} <br>
                                                                                                <span class="badge bg-primary p-2 edit-item-list">
                                                                                                    Current Status:
                                                                                                    <strong>
                                                                                                        @if($review->display == 0)
                                                                                                            {{ 'Not Visible On Site' }}
                                                                                                        @else
                                                                                                            {{ 'Visible On Site' }}
                                                                                                        @endif
                                                                                                    </strong>
                                                                                                </span>
                                                                                            </a>
                                                                                        </p>

                                                                                    </div>
                                                                                    <div class="flex-shrink-0">
                                                                                        <span class="text-muted fs-13 mb-0">{{ $review->created_at->format('d M Y H:i A') }}</span>
                                                                                    </div>
                                                                                    <div class="flex-shrink-0">
                                                                                        @if($review->display == 0)
                                                                                        <a href="{{ route('admin.properties.review.set',['id' => $review->id,'display' => 1]) }}"
                                                                                           class="badge bg-secondary-subtle text-secondary edit-item-list">
                                                                                            <i class="ph-pencil align-baseline me-1"></i>Visible
                                                                                        </a>
                                                                                        @else
                                                                                            <a href="{{ route('admin.properties.review.set',['id' => $review->id,'display' => 0]) }}"
                                                                                               class="badge bg-secondary-subtle text-secondary edit-item-list">
                                                                                                <i class="ph-pencil align-baseline me-1"></i>Hide
                                                                                            </a>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>

                                                                                <h6 class="review-title fs-md">Message</h6>
                                                                                <p class="review-desc mb-0">"{{ $review->message }} "</p>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach


                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder"
                                                     style="width: 792px; height: 781px;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-horizontal"
                                                 style="visibility: hidden;">
                                                <div class="simplebar-scrollbar"
                                                     style="width: 0px; display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical"
                                                 style="visibility: visible;">
                                                <div class="simplebar-scrollbar"
                                                     style="height: 320px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><!--end row-->
                        </div>
                    </div>
                </div><!--end col-->
            </div>
            @endif


        </div>
    </div>

@stop
@section('script')

@endsection

