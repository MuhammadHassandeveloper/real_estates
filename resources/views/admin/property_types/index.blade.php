@extends('admin.main')
@section('title',$title)
@section('properties-drops','show')
@section('property_types','active')
@section('style')
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="agentList">
                        <div class="card-header">
                            <div class="row align-items-center gy-3">
                                <div class="col-md-auto col-6 text-end">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addType">
                                            <i class="bi bi-plus align-baseline me-1"></i> Add New
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="d-flex justify-content-between align-items-center mx-0 row">
                                    <table class="datatables-basic table" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 952px;">
                                    <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col" class="sort cursor-pointer">#</th>
                                        <th scope="col" class="sort cursor-pointer">Created Date</th>
                                        <th scope="col" class="sort cursor-pointer">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                    @php $i = 1; @endphp
                                    @if($types)
                                        @foreach($types as $type)
                                        <tr data-id="{{ $type->id }}">
                                            <td>{{  $i++ }}</td>
                                            <td>{{ $type->created_at->format('F j, Y, g:i a') }}</td>
                                            <td class="name-cell">{{ $type->name }}</td>
                                            <td>
                                                <ul class="d-flex gap-2 list-unstyled mb-0">
                                                    <li>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal" class="btn btn-subtle-secondary btn-icon btn-sm edit-item-btn btn-edit">
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
                                        @else
                                        <div class="noresult" style="display: none">
                                            <div class="text-center py-4">
                                                <i class="ph-magnifying-glass fs-1 text-primary"></i>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                            </div>
                                        </div>
                                        @endif

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

    <!-- Add Property Modal-->
    <div class="modal fade" id="addType" tabindex="-1" aria-labelledby="addAgencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgencyModalLabel">Add Property Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-addAgencyModal"></button>
                </div>

                <form action="{{ route('admin.property_types_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Property Type Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter  Property Type Name">
                            @error('name')
                            <span class="text-danger error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg align-baseline me-1"></i> Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Update Property Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addAgencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgencyModalLabel">Edit Property Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-addAgencyModal"></button>
                </div>

                <form action="{{ route('admin.property_types_update') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="typeName" class="form-label">Property Type Name<span class="text-danger">*</span></label>
                            <input type="hidden" name="id" id="typeId">
                            <input type="text" name="name" id="typeName" class="form-control" placeholder="Enter  Property Type Name">
                            @error('name')
                            <span class="text-danger error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg align-baseline me-1"></i> Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Delete Property Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="addAgencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgencyModalLabel">Confirmation For Delete Record </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-addAgencyModal"></button>
                </div>

                <form action="{{ route('admin.property_types_delete') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="pTypeId">
                        <p>Deleting this row will be permanently remove it from the system. This action cannot be undone. Are you certain you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg align-baseline me-1"></i> Close</button>
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
            $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                var $row = $(this).closest('tr');
                var id = $row.data('id');
                var name = $row.find('.name-cell').text();
                $('#typeId').val(id);
                $('#typeName').val(name);
                $('#editModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-delete').on('click', function() {
                var $row = $(this).closest('tr');
                var id = $row.data('id');
                $('#pTypeId').val(id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection

