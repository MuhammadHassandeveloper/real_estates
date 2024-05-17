@extends('agent.main')
@section('title',$title)
@section('properties-drops','show')
@section('properties_list','active')
@section('style')
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">
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
                                    <table class="datatables-basic table" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 952px;">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col" class="sort cursor-pointer" data-sort="propert_id">#</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="propert_type">Property Type</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="propert_name">Property Name</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="address">Address</th>
                                            <th scope="col" class="sort cursor-pointer desc" data-sort="agent_name">Agent Name</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="price">Price</th>
                                            <th scope="col" class="sort cursor-pointer" data-sort="status">Status</th>
                                            <th scope="col" class="sort cursor-pointer">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        <tr>
                                            <td class="propert_id">
                                                <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#TBS03</a>
                                            </td>
                                            <td class="propert_type">
                                                Apartment
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2 position-relative">
                                                    <img src="assets/images/real-estate/img-03.jpg" alt="" height="35" class="rounded">
                                                    <a href="apps-real-estate-property-overview.html" class="propert_name text-reset stretched-link">Vintage Apartment</a>
                                                </div>
                                            </td>
                                            <td class="address">
                                                Brazil
                                            </td>
                                            <td class="agent_name">Domenic Dach</td>
                                            <td class="price">
                                                <span class="fw-medium">$1249.99</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info-subtle text-info status">Rent</span>
                                            </td>
                                            <td>
                                                <ul class="d-flex gap-2 list-unstyled mb-0">
                                                    <li>
                                                        <a href="apps-real-estate-property-overview.html" class="btn btn-subtle-primary btn-icon btn-sm "><i class="ph-eye"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#!" class="btn btn-subtle-secondary btn-icon btn-sm edit-item-btn"><i class="ph-pencil"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#!" class="btn btn-subtle-danger btn-icon btn-sm remove-item-btn"><i class="ph-trash"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
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
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Delete Property Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="addAgencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgencyModalLabel">Confirmation For Delete Record </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-addAgencyModal"></button>
                </div>

                <form action="" method="post">
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

