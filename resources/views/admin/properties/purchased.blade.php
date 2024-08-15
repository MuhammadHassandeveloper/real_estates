@extends('admin.main')
@section('title',$title)
@section('customer-properties-drops','show')
@section('purchased-properties','active')
@section('style')
    <style>
        .row > * {
            width: 100%;
            max-width: 100%;
            padding-left: 0px !important;
        }

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
                                            <th>Title</th>
                                            <th>Address</th>
                                            <th>Customer</th>
                                            <th>Agent</th>
                                            <th>Date & Time</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Pay Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @php $i = 1; @endphp
                                        @foreach($properties as $property)
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
                                                $customer = App\Models\User::find($property->customer_id);
                                                $agent = App\Models\User::find($property->agent_id);

                                            @endphp
                                            <tr data-id="{{ $property->id }}">
                                                <td class="propert_id">
                                                    <a href="{{ route('admin.properties.detail_property',$property->id)}}"
                                                       class="fw-medium link-primary">#{{ $i++  }}</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2 position-relative">
                                                        <a href="{{ route('admin.properties.detail_property',$property->id)}}"
                                                           class="propert_name text-reset stretched-link">{{ $property->title }}</a>
                                                    </div>
                                                </td>
                                                <td class="address">{{ $property->address }}</td>
                                                <td class="agent_name">
                                                    {{ $customer->first_name }}  {{ $customer->last_name }} <br>
                                                    {{ $customer->phone }}
                                                </td>

                                                <td class="agent_name">
                                                    {{ $agent->first_name }}  {{ $agent->last_name }} <br>
                                                    {{ $agent->phone }}
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

