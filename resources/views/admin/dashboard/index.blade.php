@extends('admin.main')
@section('title',$title)
@section('style')
@stop
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/apexcharts@3.27.1/dist/apexcharts.css" rel="stylesheet">

    <!-- Start Page-content -->
    <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Real Estate</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Real Estate</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Properties</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $propertiesCount }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Properties for Rent</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $rentedPropertiesCount }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Properties Purchased</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $purchasedPropertiesCount }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Favorite Properties</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $favoritePropertiesCount }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Total Rental Sum</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ App\Helpers\AppHelper::appCurrencySign() }}{{ $rentalSum }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Total Purchase Sum</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ App\Helpers\AppHelper::appCurrencySign() }}{{ $purchaseSum }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->


                <div class="row">
                    <div class="col-xxl-12 col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Revenue Overview</h5>
                                <div class="flex-shrink-0">
                                    <input type="text" class="form-control form-control-sm" id="dateRangePicker" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-default-date="01 Jan 2023 to 31 Dec 2023">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-12">
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane active" id="revenue" role="tabpanel">
                                                <div id="total_revenue" data-colors='["--tb-primary"]' class="apex-charts effect-chart" dir="ltr"></div>
                                            </div><!--end tab-->
                                            <div class="tab-pane" id="income" role="tabpanel">
                                                <div id="total_income" data-colors='["--tb-success"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                            <div class="tab-pane" id="property-sale" role="tabpanel">
                                                <div id="property_sale_chart" data-colors='["--tb-danger"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                            <div class="tab-pane" id="property-rent" role="tabpanel">
                                                <div id="property_rent" data-colors='["--tb-info"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="agentList">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Recently Added Property</h4>
                            </div>
                                <div class="card-body">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="table-responsive d-flex justify-content-between align-items-center mx-0 row">
                                            <table class="datatables-basic table table-sm">
                                                <thead class="text-muted table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Title</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th>Price</th>
                                                    <th>Category</th>
                                                </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                @php $i = 1; @endphp
                                                @foreach($properties as $property)
                                                    @php
                                                        $res =  App\Helpers\AppHelper::property_category($property->property_category);
                                                        $bgColor = $res[0];
                                                        $color = $res[1];
                                                        $text = $res[2];
                                                    @endphp
                                                    <tr data-id="{{ $property->id }}">
                                                        <td class="propert_id">
                                                            <a href="{{url('agent/property-detail',$property->id)}}"
                                                               class="fw-medium link-primary">#{{ $i++  }}</a>
                                                        </td>
                                                        <td class="propert_type">
                                                            {{ $property->propertyType->name }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-2 position-relative">
                                                                <a href="{{url('agent/property-detail',$property->id)}}"
                                                                   class="propert_name text-reset stretched-link">{{ $property->title }}</a>
                                                            </div>
                                                        </td>
                                                        <td class="address">{{ $property->city->name }}</td>
                                                        <td class="agent_name">{{ $property->state->name }}</td>
                                                        <td class="price">
                                                            <span class="fw-medium">{{ App\Helpers\AppHelper::appCurrencySign() }}{{ $property->price }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-column h-100">
                            <div class="row h-100 justify-content-between">
                                {{--  agents list--}}
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center">
                                            <h4 class="card-title mb-0 flex-grow-1">Latest Agent List</h4>
                                        </div>
                                        <div class="card-body pt-4">
                                            <div class="table-responsive table-card">
                                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                    @foreach($agents as $agent)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-grow-1">{{ $agent->first_name }} </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $agent->city->name }}</td>
                                                            <td>
                                                                {{ $agent->phone }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody><!-- end tbody -->
                                                </table><!-- end table -->
                                            </div>
                                        </div>
                                    </div><!--end card-->
                                </div>

                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
@stop
@section('script')
    <!-- Initialize the monthlyPurchaseSums variable on the global window object -->
    <script>
        window.monthlyPurchaseSums = @json($monthlyPurchaseSums);
    </script>

    <script src="{{ asset('admin/assets/js/pages/dashboard-real-estate.init.js') }}"></script>
@endsection


