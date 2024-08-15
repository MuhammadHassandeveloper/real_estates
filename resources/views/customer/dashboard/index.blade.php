@extends('customer.main')
@section('title',$title)
@section('style')
    @section('dashboard','active')
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
                </div><!--end row-->

                @if($messages->isNotEmpty())
                    <div class="row">
                    <div class="col-xxl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4 class="card-title mb-0 flex-grow-1">Latest Agents  Feedback</h4>
                            </div>
                            <div class="card-body px-0">
                                <div data-simplebar="init" style="max-height: 400px;" class="simplebar-scrollable-y">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                                    <div class="simplebar-content" style="padding: 0px;">
                                                        @foreach ($messages as $message)
                                                            <div class="card border-bottom rounded-0 border-0 shadow-none mb-0">
                                                                <div class="card-body pt-0">
                                                                    <div class="d-flex gap-2">
                                                                        <div class="flex-grow-1">
                                                                            <span class="text-muted clearfix float-end">{{ $message->created_at->format('h:i A') }}</span>
                                                                            <h6 class="fs-md mb-1">
                                                                               <b>Message From</b> <a href="javascript:void(0);" class="text-reset">{{ $message->agent->first_name }} {{ $message->agent->last_name }}</a>
                                                                            </h6>
                                                                            <h6 class="fs-md mb-1">
                                                                                <b>For Property</b> <a href="javascript:void(0);" class="text-reset">{{ $message->property->title }}</a>
                                                                            </h6>
                                                                            <p class="text-muted mb-0">"{{ $message->message }}"</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end card-->
                    </div>

                </div>
                @endif

                <div class="row">
                <div class="col-xxl-9">
                    <div class="card" id="propertyList">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recently Added Favourite Property</h4>
                            <div class="flex-shrink-0">
                                <a href="{{ route('customer.fav-properties') }}" class="text-muted">View All <i
                                            class="bi bi-chevron-right align-baseline"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="d-flex table-responsive justify-content-between align-items-center mx-0 row">
                                    <table class="table-sm datatables-basic table">
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
                                        @foreach($favoriteProperties as $property)
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

