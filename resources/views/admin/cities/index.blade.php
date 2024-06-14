@extends('admin.main')
@section('title', $title)
@section('cities', 'active')
@section('style')
    <style>
        .modal-content {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
@stop

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">

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

                <div class="col-lg-12">
                    <div class="card" id="cityList">
                        <div class="card-header">
                            <div class="row align-items-center gy-3">
                                <div class="col-md-auto col-6 text-end">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCityModal">
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
                                            <th scope="col" class="sort cursor-pointer">State</th>
                                            <th scope="col" class="sort cursor-pointer">Image</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @php $i = 1; @endphp
                                        @if($cities)
                                            @foreach($cities as $city)
                                                <tr data-id="{{ $city->id }}">
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $city->created_at->format('F j, Y, g:i a') }}</td>
                                                    <td class="name-cell">{{ $city->name }}</td>
                                                    <td class="state-cell" data-state-id="{{ $city->state_id }}">{{ $city->state->name }}</td>
                                                    <td><img src="{{ asset('city_images/'.$city->image) }}" alt="City Image" style="max-width: 50px;"></td>
                                                    <td>
                                                        <ul class="d-flex gap-2 list-unstyled mb-0">
                                                            <li>
                                                                <a href="javascript:void(0);" data-id="{{ $city->id }}" class="btn btn-subtle-secondary btn-icon btn-sm edit-item-btn btn-edit">
                                                                    <i class="ph-pencil"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" data-id="{{ $city->id }}" class="btn btn-subtle-danger btn-icon btn-sm remove-item-btn btn-delete">
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
    </div>

    <!-- Add City Modal-->
    <div class="modal fade" id="addCityModal" tabindex="-1" aria-labelledby="addCityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCityModalLabel">Add City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-addCityModal"></button>
                </div>

                <form action="{{ route('admin.city_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="state_id" class="form-label">State<span class="text-danger">*</span></label>
                            <select class="form-control select2-dropdown" name="state_id" id="state_id">
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                            <span class="text-danger error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div id="cities-container">
                            <div class="city-group mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <label for="name_0" class="form-label">City Name<span class="text-danger">*</span></label>
                                    <button type="button" class="btn btn-success btn-sm add-city-btn"><i class="bi bi-plus-circle"></i></button>
                                </div>
                                <input type="text" name="cities[0][name]" id="name_0" class="form-control mb-3" placeholder="Enter City Name">
                                @error('cities[0][name]')
                                <span class="text-danger error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="image_0" class="form-label">City Image<span class="text-danger">*</span></label>
                                <input type="file" name="cities[0][image]" id="image_0" class="form-control">
                                @error('cities[0][image]')
                                <span class="text-danger error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Cities</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit City Modal-->
    <div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCityModalLabel">Edit City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-editCityModal"></button>
                </div>

                <form action="{{ route('admin.city_update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_city_name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="hidden" name="id" id="edit_city_id">
                            <input type="text" name="name" id="edit_city_name" class="form-control" placeholder="Enter Name">
                            @error('name')
                            <span class="text-danger error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_image" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="edit_image" class="form-control" placeholder="Upload Image">
                            @error('image')
                            <span class="text-danger error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_state_id" class="form-label">State<span class="text-danger">*</span></label>
                            <select class="form-select select2-dropdown" name="state_id" id="edit_state_id">
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                            <span class="text-danger error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update City</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete City Modal-->
    <div class="modal fade" id="deleteCityModal" tabindex="-1" aria-labelledby="deleteCityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCityModalLabel">Delete City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-deleteCityModal"></button>
                </div>

                <form action="{{ route('admin.city_delete') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="delete_city_id">
                        <p>Deleting this city will permanently remove it from the system. This action cannot be undone. Are you sure you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete City</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('.select2-dropdown').select2({
                theme: 'bootstrap', // Use the Bootstrap theme for Select2
                dropdownParent: $('#addCityModal'), // Ensure dropdown is attached to the modal
                width: '100%' // Ensure the width is correctly calculated
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var cityIndex = 1;

            // Add city input group
            $('.add-city-btn').on('click', function() {
                var cityGroup = `
                    <div class="city-group mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label for="name_${cityIndex}" class="form-label">City Name<span class="text-danger">*</span></label>
                            <button type="button" class="btn btn-danger btn-sm remove-city-btn"><i class="bi bi-x-circle"></i></button>
                        </div>
                        <input type="text" name="cities[${cityIndex}][name]" id="name_${cityIndex}" class="form-control mb-3" placeholder="Enter City Name">
                        <label for="image_${cityIndex}" class="form-label">City Image<span class="text-danger">*</span></label>
                        <input type="file" name="cities[${cityIndex}][image]" id="image_${cityIndex}" class="form-control">
                    </div>`;
                $('#cities-container').append(cityGroup);
                cityIndex++;
            });

            // Remove city input group
            $(document).on('click', '.remove-city-btn', function() {
                $(this).closest('.city-group').remove();
            });

            $('.btn-edit').on('click', function() {
                var $row = $(this).closest('tr');
                var id = $row.data('id');
                var name = $row.find('.name-cell').text();
                var stateId = $row.find('.state-cell').data('state-id');

                $('#edit_city_id').val(id);
                $('#edit_city_name').val(name);
                $('#edit_state_id').val(stateId);

                $('#editCityModal').modal('show');
            });

            $('.btn-delete').on('click', function() {
                var $row = $(this).closest('tr');
                var id = $row.data('id');
                $('#delete_city_id').val(id);
                $('#deleteCityModal').modal('show');
            });
        });
    </script>

@endsection
