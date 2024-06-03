@extends('agency.main')
@section('title',$title)
@section('agency-agents-drops','show')
@section('agency_agents_list','active')
@section('style')
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Agent Overview</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
                                <li class="breadcrumb-item active">Agent Overview</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    {{--agent overview--}}
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-center g-3">
                                <div class="col-xl-4 col-md-5">
                                    <div class="text-center bg-info-subtle rounded-3 py-3 ribbon-box page-agency-overview overflow-hidden">
                                        <div class="ribbon ribbon-danger ribbon-shape trending-ribbon">
                                            <span class="trending-ribbon-text">{{ $properties_count }} Properties</span>
                                            <i class="mdi mdi-home-city text-white align-bottom float-end ms-2"></i>
                                        </div>
                                        <img src="{{ $agent->photo ? asset('property_images/' . $agent->photo) : asset('assets/images/default-profile.png') }}"
                                             alt="Agent Photo" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-7">
                                    <div>
                                        <div>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-nowrap table-borderless mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <th>Agency:</th>
                                                        @php
                                                                @endphp
                                                        <td>
                                                            <a href="#!">{{ $agency->first_name ? $agency->first_name .' '.$agency->last_name : 'N/A' }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email:</th>
                                                        <td>{{ $agent->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Contact Number:</th>
                                                        <td>{{ $agent->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>City:</th>
                                                        <td>{{ $agent->city }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>State:</th>
                                                        <td>{{ $agent->state }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bio:</th>
                                                        <td>{{ $agent->bio ? $agent->bio : 'N/A' }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--agent properties--}}
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">Agent Properties</h4>
                                    </div>
                                </div>
                            </div>

                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="d-flex justify-content-between align-items-center mx-0 row">
                                    <table class="datatables-basic table" id="DataTables_Table_0" role="grid"
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
                                                $res =  App\Helpers\Helpers::property_category($property->property_category);
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
                                                <td class="address">{{ $property->city }}</td>
                                                <td class="agent_name">{{ $property->state }}</td>
                                                <td class="price">
                                                    <span
                                                            class="fw-medium">{{ App\Helpers\Helpers::appCurrencySign() }}{{ $property->price }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                            class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                                </td>
                                                <td>
                                                    <ul class="d-flex gap-2 list-unstyled mb-0">
                                                        <li>
                                                            <a href="{{url('agent/property-detail',$property->id)}}"
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
@stop
@section('script')

@endsection

