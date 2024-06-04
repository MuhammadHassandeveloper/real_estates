@extends('agent.main')
@section('title',$title)
@section('properties-drops','show')
@section('properties_list','active')
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
                        <h4 class="mb-sm-0">Properties List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('agent/dashboard') }}">Real Estate</a></li>
                                <li class="breadcrumb-item active">Properties List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="agentList">
                        <div class="card-header">
                            <div class="row gy-3 justify-content-end">
                                <div class="col-md-auto col-6"></div>
                                <div class="col-md-auto col-6 text-end">
                                    <a href="{{ route('agent.create_property') }}" class="btn btn-secondary">
                                        <i class="bi bi-plus align-baseline me-1"></i> Add New
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
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
<<<<<<< HEAD
                                                $res =  App\Helpers\Helpers::property_category($property->property_category);
=======
                                                $res =  App\Helpers\AppHelper::property_category($property->property_category);
>>>>>>> parent of da1d971 (ok)
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
<<<<<<< HEAD
                                                            class="fw-medium">{{ App\Helpers\Helpers::appCurrencySign() }}{{ $property->price }}</span>
=======
                                                        class="fw-medium">{{ App\Helpers\AppHelper::appCurrencySign() }}{{ $property->price }}</span>
>>>>>>> parent of da1d971 (ok)
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
                                                        <li>
                                                            <a href="{{url('agent/property-edit',$property->id)}}"
                                                               class="btn btn-subtle-secondary btn-icon btn-sm edit-item-btn">
                                                                <i class="ph-pencil"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                               class="btn btn-subtle-danger btn-icon btn-sm remove-item-btn btn-delete">
                                                                <i class="ph-trash"></i>
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

    <!-- Delete Property Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="addAgencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgencyModalLabel">Confirmation For Delete Record </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-addAgencyModal"></button>
                </div>

                <form action="{{ route('agent.property.delete_property') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="Pid">
                        <p>Deleting this row will be permanently remove it from the system. This action cannot be
                            undone. Are you certain you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal"><i
                                    class="bi bi-x-lg align-baseline me-1"></i> Close
                            </button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop
@section('script')

    <script>
        $(document).ready(function () {
            $('.btn-delete').on('click', function () {
                var $row = $(this).closest('tr');
                var id = $row.data('id');
                $('#Pid').val(id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection

