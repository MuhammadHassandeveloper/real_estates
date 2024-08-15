@extends('admin.main')
@section('title',$title)
@section('users-drops','show')
@section('agents','active')
@section('style')
    <style>
        /*.row > * {*/
        /*    width: 100%;*/
        /*    max-width: 100%;*/
        /*    padding-left: 0px !important;*/
        /*}*/

    </style>
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Real Estate</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-4 col-lg-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-column h-100">
                                        <p class="fs-md text-muted mb-4">Total Properties</p>
                                        <h3 class="mb-0 mt-auto">
                                            <span>{{ $properties->count() }}</span>
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
                                        <p class="fs-md text-muted mb-4">Customer Properties for Rent</p>
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
                                        <p class="fs-md text-muted mb-4">Customer Properties Purchased</p>
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
                                        <p class="fs-md text-muted mb-4">Customer Favorite Properties</p>
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
                                        <p class="fs-md text-muted mb-4">Customer Total Rent Properties Sum</p>
                                        <h3 class="mb-0 mt-auto">
                                            <span>{{ $rentalSum }}</span>
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
                                        <p class="fs-md text-muted mb-4">Customer Total Purchase Sum</p>
                                        <h3 class="mb-0 mt-auto">
                                            <span>{{ $purchaseSum }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="agentList">

                        <div class="card-body">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="d-flex justify-content-between align-items-center mx-0 row">
                                    <table class="datatables-basic table table-sm" id="DataTables_Table_0" role="grid"
                                           aria-describedby="DataTables_Table_0_info">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Address</th>
                                            <th>Post By</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                    <a href="{{url('admin/property-detail',$property->id)}}"
                                                       class="fw-medium link-primary">#{{ $i++  }}</a>
                                                </td>
                                                <td class="propert_type">
                                                    {{ $property->propertyType->name }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2 position-relative">
                                                        <a href="{{url('admin/property-detail',$property->id)}}"
                                                           class="propert_name text-reset stretched-link">{{ $property->title }}</a>
                                                    </div>
                                                </td>
                                                <td class="address">
                                                    {{ $property->city->name }} <br>
                                                    {{ $property->state->name }}
                                                </td>
                                                <td class="agent_name">
                                                    {{ $property->agent->first_name . ' ' .$property->last_name}} <br>
                                                    {{ $property->agent->phone}}
                                                </td>
                                                <td class="price">
                                                    <span class="fw-medium">{{ App\Helpers\AppHelper::appCurrencySign() }}{{ $property->price }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                                </td>
                                                <td>
                                                    <ul class="d-flex gap-2 list-unstyled mb-0">
                                                        <li>
                                                            <a href="{{ route('admin.properties.detail_property',$property->id)}}"
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
                </div>
            </div>


        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@stop
@section('script')

@endsection

