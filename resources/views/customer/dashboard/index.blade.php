@extends('customer.main')
@section('title',$title)
@section('style')
@stop
@section('content')
    @php
        use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
        use App\Helpers\AppHelper;
        $missingFields = AppHelper::checkAgentProfileCompletion(Sentinel::getUser()->id);
    @endphp
    <!-- Start Page-content -->
    <div class="page-content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-column h-100">
                                        <p class="fs-md text-muted mb-4">Properties for sale</p>
                                        <h3 class="mb-0 mt-auto"><span class="counter-value" data-target="3652">0</span>
                                            <small class="text-success fs-xs mb-0 ms-1"><i
                                                        class="bi bi-arrow-up me-1"></i> 06.19%</small></h3>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="property_sale" data-colors='["--tb-primary"]' dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-xxl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-column h-100">
                                        <p class="fs-md text-muted mb-4">Properties for rent</p>
                                        <h3 class="mb-0 mt-auto"><span class="counter-value" data-target="1524">0</span>
                                            <small class="text-success fs-xs mb-0 ms-1"><i
                                                        class="bi bi-arrow-up me-1"></i> 02.33%</small></h3>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="property_rent" data-colors='["--tb-warning"]' dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-xxl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-column h-100">
                                        <p class="fs-md text-muted mb-4">Visitors</p>
                                        <h3 class="mb-0 mt-auto"><span class="counter-value"
                                                                       data-target="149.36">0</span>k <small
                                                    class="text-success fs-xs mb-0 ms-1"><i
                                                        class="bi bi-arrow-up me-1"></i> 12.33%</small></h3>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="visitors_chart" data-colors='["--tb-secondary"]' dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-xxl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-column h-100">
                                        <p class="fs-md text-muted mb-4">Residency Property</p>
                                        <h3 class="mb-0 mt-auto"><span class="counter-value" data-target="2376">0</span>
                                            <small class="text-danger fs-xs mb-0 ms-1"><i
                                                        class="bi bi-arrow-down me-1"></i> 09.57%</small></h3>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="residency_property" data-colors='["--tb-success"]' dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                <div class="col-xxl-9">
                    <div class="card" id="propertyList">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recently Added Property</h4>
                            <div class="flex-shrink-0">
                                <a href="{{ url('admin.agent.properties') }}" class="text-muted">View All <i
                                            class="bi bi-chevron-right align-baseline"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="d-flex justify-content-between align-items-center mx-0 row">
                                    <table class="datatables-basic table" role="grid"
                                           aria-describedby="DataTables_Table_0_info" style="width: 952px;">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col" class="sort cursor-pointer" data-sort="propert_id">#</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="propert_type">Type
                                            </th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="propert_name">Title
                                            </th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="address">City</th>
                                            <th scope="col" class="sort cursor-pointer desc" data-sort="agent_name">
                                                State
                                            </th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="price">Price</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="status">Status</th>
                                            <th scope="col" class="sort cursor-pointer">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @php $i = 1; @endphp
                                        @foreach($properties as $property)
                                            @php
                                                $res =  AppHelper::property_category($property->property_category);
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
                                                    <span class="fw-medium">{{ AppHelper::appCurrencySign() }}{{ $property->price }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                                </td>
                                                <td>
                                                    <ul class="d-flex gap-2 list-unstyled mb-0">
                                                        <li>
                                                            <a href="{{url('customer/property-detail',$property->id)}}"
                                                               class="btn btn-subtle-primary btn-icon btn-sm ">
                                                                <i class="ph-eye"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
        <!-- End Page-content -->
@stop
@section('script')
@endsection

