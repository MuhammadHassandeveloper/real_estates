@extends('admin.main')
@section('title', 'Countries')
@section('countries', 'active')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Real Estate</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="countryList">
                        <div class="card-header">
                            <div class="row align-items-center gy-3">
                                <div class="col-md-auto col-6 text-end">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCountry">
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
                                            <th scope="col">Country Code</th>
                                            <th scope="col">Currency Sign</th>
                                            <th scope="col">Currency</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @php
                                            $i = 1;
                                            use App\Helpers\AppHelper;
                                            @endphp
                                        @if($countries)
                                            @foreach($countries as $country)
                                                @php
                                                    $res =  AppHelper::country_status($country->status);
                                                    $bgColor = $res[0];
                                                    $color = $res[1];
                                                    $text = $res[2];
                                                @endphp
                                                <tr data-id="{{ $country->id }}">
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $country->created_at->format('F j, Y, g:i a') }}</td>
                                                    <td class="name-cell">{{ $country->name }}</td>
                                                    <td>{{ $country->country_code }}</td>
                                                    <td>{{ $country->currency_sign }}</td>
                                                    <td>{{ $country->currency }}</td>
                                                    <td>
                                                        <span class="badge {{ $bgColor }} {{ $color }} status">{{ $text  }}</span>
                                                    </td>
                                                    <td>
                                                        <ul class="d-flex gap-2 list-unstyled mb-0">
                                                            <li>
                                                                <a href="{{ route('admin.change.status', ['id' => $country->id]) }}" class="btn btn-subtle-danger btn-icon btn-sm" onclick="event.preventDefault(); document.getElementById('change-status-form-{{ $country->id }}').submit();">
                                                                    <i class="ph-shield-check"></i>
                                                                </a>
                                                                <form id="change-status-form-{{ $country->id }}" action="{{ route('admin.change.status', ['id' => $country->id]) }}" method="GET" style="display: none;">
                                                                    @csrf
                                                                </form>
                                                            </li>

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

    <!-- Add Country Modal -->
    <div class="modal fade" id="addCountry" tabindex="-1" aria-labelledby="addCountryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCountryModalLabel">Add Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-addCountryModal"></button>
                </div>
                <form action="{{ route('admin.country_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            @error('name')
                            <span class="text-danger error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="country_code" class="form-label">Country Code<span class="text-danger">*</span></label>
                            <input type="text" name="country_code" id="country_code" class="form-control" placeholder="Enter Country Code">
                            @error('country_code')
                            <span class="text-danger error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="currency_sign" class="form-label">Currency Sign<span class="text-danger">*</span></label>
                            <input type="text" name="currency_sign" id="currency_sign" class="form-control" placeholder="Enter Currency Sign">
                            @error('currency_sign')
                            <span class="text-danger error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency<span class="text-danger">*</span></label>
                            <input type="text" name="currency" id="currency" class="form-control" placeholder="Enter Currency">
                            @error('currency')
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

    <!-- Edit Country Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editCountryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCountryModalLabel">Edit Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-editCountryModal"></button>
                </div>
                <form action="{{ route('admin.country_update') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="countryName" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="hidden" name="id" id="countryId">
                            <input type="text" name="name" id="countryName" class="form-control" placeholder="Enter Country Name">
                            @error('name')
                            <span class="text-danger error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="countryCode" class="form-label">Country Code<span class="text-danger">*</span></label>
                            <input type="text" name="country_code" id="countryCode" class="form-control" placeholder="Enter Country Code">
                            @error('country_code')
                            <span class="text-danger error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="currencySign" class="form-label">Currency Sign<span class="text-danger">*</span></label>
                            <input type="text" name="currency_sign" id="currencySign" class="form-control" placeholder="Enter Currency Sign">
                            @error('currency_sign')
                            <span class="text-danger error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency<span class="text-danger">*</span></label>
                            <input type="text" name="currency" id="currency" class="form-control" placeholder="Enter Currency">
                            @error('currency')
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

    <!-- Delete Country Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteCountryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCountryModalLabel">Confirmation For Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-deleteCountryModal"></button>
                </div>
                <form action="{{ route('admin.country_delete') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="countryIdDelete">
                        <p>Deleting this row will permanently remove it from the system. This action cannot be undone. Are you certain you want to proceed?</p>
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
                var countryCode = $row.find('.country-code-cell').text();
                var currencySign = $row.find('.currency-sign-cell').text();
                var currency = $row.find('.currency-cell').text();
                $('#countryId').val(id);
                $('#countryName').val(name);
                $('#countryCode').val(countryCode);
                $('#currencySign').val(currencySign);
                $('#currency').val(currency);
                $('#editModal').modal('show');
            });

            $('.btn-delete').on('click', function() {
                var $row = $(this).closest('tr');
                var id = $row.data('id');
                $('#countryIdDelete').val(id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
