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
                                <div class="col-lg-3 col-md-6 order-last order-md-first me-auto">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Search for agent, email, address or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-md-auto col-6 text-end">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-subtle-danger d-none" id="remove-actions" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addAgent"><i class="bi bi-person-plus align-baseline me-1"></i> Add Agent</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="option" id="checkAll">
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th scope="col" class="sort cursor-pointer" data-sort="agent_id">#</th>
                                        <th scope="col" class="sort cursor-pointer" data-sort="joining_date">Date</th>
                                        <th scope="col" class="sort cursor-pointer" data-sort="agent_Name">Agent Name</th>
                                        <th scope="col" class="sort cursor-pointer" data-sort="address">Address</th>
                                        <th scope="col" class="sort cursor-pointer" data-sort="email">Email</th>
                                        <th scope="col" class="sort cursor-pointer" data-sort="contact">Contacts</th>
                                        <th scope="col" class="sort cursor-pointer" data-sort="status">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all"><tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td class="agent_id"><a href="apps-real-estate-agent-overview.html" class="fw-medium link-primary">#TBS01</a></td>
                                        <td class="joining_date">20 March, 2023</td>
                                        <td class="agent_Name">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded">
                                                <a href="apps-real-estate-agent-overview.html" class="text-reset text-capitalize">Scot Sawayn</a>
                                            </div>
                                        </td>
                                        <td class="address">Birmingham, United Kingdom</td>
                                        <td class="email">scotsawayn@steex.com</td>
                                        <td class="contact">(86) 9985-9220</td>
                                        <td class="status"><span class="badge bg-success-subtle text-success">Active</span></td>
                                        <td>
                                            <ul class="d-flex gap-2 list-unstyled mb-0">
                                                <li>
                                                    <a href="apps-real-estate-agent-overview.html" class="btn btn-subtle-primary btn-icon btn-sm "><i class="ph-eye"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#addAgent" data-bs-toggle="modal" class="btn btn-subtle-secondary btn-icon btn-sm edit-item-btn"><i class="ph-pencil"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#deleteRecordModal" data-bs-toggle="modal" class="btn btn-subtle-danger btn-icon btn-sm remove-item-btn"><i class="ph-trash"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr></tbody><!-- end tbody -->
                                </table><!-- end table -->
                                <div class="noresult" style="display: none">
                                    <div class="text-center py-4">
                                        <i class="ph-magnifying-glass fs-1 text-primary"></i>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We've searched more than 150+ agent We did not find any agent for you search.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 align-items-center" id="pagination-element">
                                <div class="col-sm">
                                    <div class="text-muted text-center text-sm-start">
                                        Showing <span class="fw-semibold">10</span> of <span class="fw-semibold">15</span> Results
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-auto mt-3 mt-sm-0">
                                    <div class="pagination-wrap justify-content-center hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="javascript:void(0)">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"><li class="active"><a class="page" href="#" data-i="1" data-page="10">1</a></li></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0)">
                                            Next
                                        </a>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
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

