@extends('admin.main')
@section('title',$title)
@section('users-drops','show')
@section('agencies','active')
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
                                        <p class="fs-md text-muted mb-4">Total Rent Properties</p>
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
                                        <p class="fs-md text-muted mb-4"> Total Purchased Properties </p>
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
                                        <p class="fs-md text-muted mb-4">Total Favorite Properties</p>
                                        <h3 class="mb-0 mt-auto">
                                            <span>{{ $favoritePropertiesCount }}</span>
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
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Purchased Properties</h4>
                        </div>
                        <div class="card-body">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="table-responsive d-flex justify-content-between align-items-center mx-0 row">
                                    <table class="datatables-basic table table-sm" id="DataTables_Table_0">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Address</th>
                                            <th>Post By</th>
                                            <th>Date & Time</th>
                                            <th>Total Pay</th>
                                            <th>Status</th>
                                            <th>Pay Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @php $i = 1; @endphp
                                        @foreach($pproperties as $property)
                                            @php
                                                $res =  App\Helpers\AppHelper::property_purchased_status($property->purchased_status);
                                                $bgColor = $res[0];
                                                $color = $res[1];
                                                $text = $res[2];


                                                $ress =  App\Helpers\AppHelper::property_payment_status($property->purchased_payment_status);
                                                $pay_bgColor = $ress[0];
                                                $pay_color = $ress[1];
                                                $pay_text = $ress[2];

                                                $dateString = $property['purchased_date'] . ' ' . $property['purchased_time'];
                                                $dateTime = new DateTime($dateString);
                                                $formattedDate = $dateTime->format("d M Y,h:i A");

                                            @endphp
                                            <tr data-id="{{ $property->id }}">
                                                <td class="propert_id">
                                                    <a href="{{ route('customer.detail_property',$property->id)}}"
                                                       class="fw-medium link-primary">#{{ $i++  }}</a>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2 position-relative">
                                                        <a href="{{ route('customer.detail_property',$property->id)}}"
                                                           class="propert_name text-reset stretched-link">{{ $property->title }}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <b>City:</b>{{ $property->city->name }} <br>
                                                    <b>Address:</b>{{ $property->address }}
                                                </td>

                                                <td class="agent_name">
                                                    {{ $property->agent->first_name . ' ' .$property->last_name}} <br>
                                                    {{ $property->agent->phone}}
                                                </td>

                                                <td>{{ $formattedDate }}</td>
                                                <td>
                                                    <span class="fw-medium">{{ App\Helpers\AppHelper::appCurrencySign() }}{{ $property->purchased_price }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $pay_bgColor }} {{ $pay_color }} status">{{ $pay_text  }}</span>
                                                </td>
                                                <td>
                                                    <ul class="d-flex gap-2 list-unstyled mb-0">
                                                        <li>
                                                            <a href="{{ route('customer.detail_property',$property->id)}}"
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


            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="agentList">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Rent Properties</h4>
                        </div>

                        <div class="card-body">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="table-responsive d-flex justify-content-between align-items-center mx-0 row">
                                    <table class="datatables-basic table table-sm">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Address</th>
                                            <th>Post By</th>
                                            <th>Total Pay</th>
                                            <th>Rent</th>
                                            <th>Pay Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @php $i = 1;
                                         use Carbon\Carbon;
                                        @endphp
                                        @foreach($rproperties as $property)
                                            @php
                                                $startDate = Carbon::parse($property->start_date);
                                                $endDate = Carbon::parse($property->end_date);
                                                $formattedStartDate = $startDate->format('d M Y');
                                                $formattedEndDate = $endDate->format('d M Y');
                                                $daysDifference = $startDate->diffInDays($endDate);
                                            @endphp
                                            <tr data-id="{{ $property->id }}">
                                                <td>
                                                    <a href="{{ route('customer.detail_property',$property->id)}}"
                                                       class="fw-medium link-primary">#{{ $i++  }}</a>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2 position-relative">
                                                        <a href="{{ route('customer.detail_property',$property->id)}}"
                                                           class="propert_name text-reset stretched-link">{{ $property->title }}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <b>City:</b>{{ $property->city->name }} <br>
                                                    <b>Address:</b>{{ $property->address }}
                                                </td>
                                                <td class="agent_name">
                                                    {{ $property->agent->first_name . ' ' .$property->last_name}} <br>
                                                    {{ $property->agent->phone}}
                                                </td>
                                                <td>
                                                    <span class="fw-medium">{{ App\Helpers\AppHelper::appCurrencySign() }}{{ $property->rental_price }}</span>
                                                </td>
                                                <td>
                                                    <b>From:</b>{{ $property->start_date }} <br>
                                                    <b>To:</b>{{ $property->end_date }} <br>
                                                    <b>Days:</b>{{ $daysDifference }}
                                                </td>
                                                @php
                                                    $res =  App\Helpers\AppHelper::property_payment_status($property->rental_payment_status);
                                                    $bgColor = $res[0];
                                                    $color = $res[1];
                                                    $text = $res[2];
                                                @endphp
                                                <td>
                                                    <span
                                                        class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                                </td>

                                                @php
                                                    $res =  App\Helpers\AppHelper::property_retal_status($property->rental_status);
                                                    $bgColor = $res[0];
                                                    $color = $res[1];
                                                    $text = $res[2];
                                                @endphp
                                                <td>
                                                    <span
                                                        class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                                </td>
                                                <td>
                                                    <ul class="d-flex gap-2 list-unstyled mb-0">
                                                        <li>
                                                            <a href="{{ route('customer.detail_property',$property->id)}}"
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


            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="agentList">

                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">favourite Properties</h4>
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
                                            <th>Address</th>
                                            <th>Post By</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @php $i = 1; @endphp
                                        @foreach($fproperties as $property)
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
                                                <td>
                                                    <b>City:</b>{{ $property->city->name }} <br>
                                                    <b>Address:</b>{{ $property->address }}
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

