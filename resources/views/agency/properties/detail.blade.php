@extends('agency.main')
@section('title',$title)
@section('properties-drops','show')
@section('properties_list','active')
@section('style')
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Property Overview</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reale Estate</a></li>
                                <li class="breadcrumb-item active">Property Overview</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
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

                                            <div class="ribbon {{ $property->is_featured ? 'ribbon-success' : 'ribbon-danger' }} fw-medium rounded-end mt-5 mb-2">
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
                                <h6 class="card-title">{{ $property->title }} (<span class="badge text-bg-info align-middle ms-1"> {{ $property->propertyType->name }}  </span>)</h6>
                                <div class="text-muted hstack gap-2 flex-wrap list-unstyled mb-3">
                                    <div>
                                        <i class="bi bi-geo-alt align-baseline me-1"></i> {{ $property->address }}
                                        , {{ $property->city }}, {{ $property->state }}
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
<<<<<<< HEAD
                                                <p class="fs-md mb-0">{{ \App\Helpers\Helpers::appCurrencySign() }}{{ $property->price }}</p>
=======
                                                <p class="fs-md mb-0">{{ \App\Helpers\AppHelper::appCurrencySign() }}{{ $property->price }}</p>
>>>>>>> parent of da1d971 (ok)
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
                                        $selected_features = json_decode($property->property_features, true);
                                    @endphp
                                    @foreach($selected_features as $ftype)
                                        @php
<<<<<<< HEAD
                                            $feature = App\Helpers\Helpers::featureDetail($ftype);
=======
                                            $feature = App\Helpers\AppHelper::featureDetail($ftype);
>>>>>>> parent of da1d971 (ok)
                                        @endphp
                                        <li class="w-lg">
                                            {{ $feature->name }}
                                        </li>
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
@stop
@section('script')

@endsection

