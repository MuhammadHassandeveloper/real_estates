@extends('agency.main')
@section('title',$title)
@section('agency-agents-drops','show')
@section('agency_agents_list','active')
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
                        <h4 class="mb-sm-0">Agents List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('agency/dashboard') }}">Real Estate</a></li>
                                <li class="breadcrumb-item active">Agents List</li>
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
                                    <a href="{{ route('agency.create_agent') }}" class="btn btn-secondary">
                                        <i class="bi bi-plus align-baseline me-1"></i> Add New
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="d-flex justify-content-between align-items-center mx-0 row">
                                    <table class="datatables-basic table" id="DataTables_Table_0" role="grid"
                                           aria-describedby="DataTables_Table_0_info">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col" class="sort cursor-pointer" data-sort="agent_id">#</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="first_name">First Name</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="last_name">Last Name</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="email">Email</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="phone">Phone</th>
                                            <th scope="col" class="sort cursor-pointer">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @php $i = 1; @endphp
                                        @foreach($agents as $agent)
                                            <tr data-id="{{ $agent->id }}">
                                                <td class="agent_id">
                                                    <a href="{{url('agency.detail_agent', $agent->id)}}" class="fw-medium link-primary">#{{ $i++  }}</a>
                                                </td>
                                                <td class="first_name">{{ $agent->first_name }}</td>
                                                <td class="last_name">{{ $agent->last_name }}</td>
                                                <td class="email">{{ $agent->email }}</td>
                                                <td class="phone">{{ $agent->phone }}</td>
                                                <td>
                                                    <ul class="d-flex gap-2 list-unstyled mb-0">
                                                        <li>
                                                            <a href="{{route('agency.detail_agent', $agent->id)}}" class="btn btn-subtle-primary btn-icon btn-sm">
                                                                <i class="ph-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('agency.edit_agent', $agent->id)}}" class="btn btn-subtle-secondary btn-icon btn-sm edit-item-btn">
                                                                <i class="ph-pencil"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" data-bs-toggle="modal" class="btn btn-subtle-danger btn-icon btn-sm remove-item-btn btn-delete">
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

                <form action="{{ route('agency.property.delete_agent') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="Aid">
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
                $('#Aid').val(id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection

