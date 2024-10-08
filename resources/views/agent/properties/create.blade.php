@extends('agent.main')
@section('title', $title)
@section('properties-drops', 'show')
@section('property_create', 'active')
@section('style')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
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
                                <li class="breadcrumb-item"><a href="{{ url('agent/dashboard') }}">Real Estate</a></li>
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
                            <form action="{{ route('agent.store_property') }}" method="POST" enctype="multipart/form-data" id="propertyForm">
                                @csrf
                                <div class="row">
                                    <col class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Property Images<span class="text-danger">*</span></label>
                                        <input type="file" id="propertyImages" name="property_images[]" multiple accept="image/*" required>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="Property-title-input" class="form-label">Property title<span class="text-danger">*</span></label>
                                            <input type="text" id="Property-title-input" name="title" class="form-control" placeholder="Enter property title" value="{{ old('title') }}" required>
                                            @error('title')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="Property-type-input" class="form-label">Property Type<span class="text-danger">*</span></label>
                                            <select class="form-select" name="property_type_id" id="Property-type-input" data-choices="" data-choices-search-false="">
                                                <option value="" selected>Select Property Type</option>
                                                @if($ptypes)
                                                    @foreach($ptypes as $ptype)
                                                        <option value="{{ $ptype->id }}" {{ old('property_type_id') == $ptype->id ? 'selected' : '' }}>{{ $ptype->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('property_type_id')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="bedroom-input" class="form-label">Bedroom<span class="text-danger">*</span></label>
                                            <input type="number" id="bedroom-input" name="bedrooms" class="form-control" placeholder="Enter Bedroom" value="{{ old('bedrooms') }}" required>
                                            @error('bedrooms')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="bathroom-input" class="form-label">Bathroom<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="bathrooms" id="bathroom-input" placeholder="Enter Bathroom" value="{{ old('bathrooms') }}" required>
                                            @error('bathrooms')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="room-input" class="form-label">Rooms<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="rooms" id="room-input" placeholder="Enter rooms" value="{{ old('rooms') }}" required>
                                            @error('rooms')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="garage-input" class="form-label">Garages<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="garages" id="garage-input" placeholder="Enter garages" value="{{ old('garages') }}" required>
                                            @error('garages')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="sqft-input" class="form-label">SQFT<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="size_sqft" id="sqft-input" placeholder="Enter sqft" value="{{ old('size_sqft') }}" required>
                                            @error('size_sqft')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="Property-price-input" class="form-label">Price<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="Property-price-input" name="price" placeholder="Enter price" value="{{ old('price') }}" required>
                                            </div>
                                            @error('price')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="street-address" class="form-label">Street Address<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="address" id="street-address" placeholder="Enter street address" value="{{ old('address') }}" required>
                                            @error('address')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="state_id" class="form-label">State<span class="text-danger">*</span></label>
                                            <select class="form-control select2-dropdown" name="state_id" id="state_id" required>
                                                <option value="">-- Select --</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('state_id')
                                            <span class="text-danger error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="city_id" class="form-label">City<span class="text-danger">*</span></label>
                                            <select class="form-control" name="city_id" id="city_id" required>
                                                <option value="">-- Select --</option>
                                                <!-- Cities will be appended here -->
                                            </select>
                                            @error('city_id')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="zipcode-input" class="form-label">Zipcode<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="zip_code" id="zipcode-input" placeholder="20325" value="{{ old('zip_code') }}" required>
                                            @error('zip_code')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="building_age-input" class="form-label">Building age<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="building_age" id="building_age-input" placeholder="25" value="{{ old('building_age') }}" required="">
                                            @error('building_age')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="is_featured" class="form-label">Is Featured<span class="text-danger">*</span></label>
                                            <select class="form-select" name="is_featured" id="is_featured">
                                                <option value="0" {{ old('is_featured') == '0' ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>Yes</option>
                                            </select>
                                            @error('is_featured')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="property_category" class="form-label">Property Category<span class="text-danger">*</span></label>
                                            <select class="form-select" name="property_category" id="property_category">
                                                <option value="Sale" {{ old('property_category') == 'Sale' ? 'selected' : '' }}>Sale</option>
                                                <option value="Rent" {{ old('property_category') == 'Rent' ? 'selected' : '' }}>Rent</option>
                                            </select>
                                            @error('property_category')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12" id="rental_duration_container" style="display: none;">
                                        <div class="mb-3">
                                            <label for="rental_duration" class="form-label">Rental Duration<span class="text-danger">*</span></label>
                                            <select class="form-select" name="rental_duration" id="rental_duration">
                                                <option value="Weekly" {{ old('rental_duration') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                                <option value="Monthly" {{ old('rental_duration') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                                <option value="Yearly" {{ old('rental_duration') == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                            </select>
                                            @error('rental_duration')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if($ftypes)
                                        @foreach($ftypes as $ftype)
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" name="property_features[]" class="form-check-input" id="additionalFeatures{{ $ftype->id }}" value="{{ $ftype->id }}" {{ in_array($ftype->id, old('property_features', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="additionalFeatures{{ $ftype->id }}">{{ $ftype->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="col-lg-12 col-12">
                                        <div class="mb-3">
                                            <label for="short_description" class="form-label">Short Description</label>
                                            <textarea class="form-control" name="short_description" id="short_description" rows="3">{{ old('short_description') }}</textarea>
                                            @error('short_description')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="mb-3">
                                            <label for="long_description" class="form-label">Long Description</label>
                                            <textarea class="form-control" name="long_description" id="long_description" rows="6">{{ old('long_description') }}</textarea>
                                            @error('long_description')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <!-- Section for Nearby Places -->
                                    <div id="nearbyPlacesSection">
                                        <h5>Add Nearby Places</h5>
                                        <div class="row" id="nearbyPlaceRows">
                                            <!-- Template for a nearby place row -->
                                            <div class="col-md-12 nearby-place-row">
                                                <div class="form-group mb-2">
                                                    <label for="nearby_place_name[]">Name</label>
                                                    <input type="text" name="nearby_place_name[]" required class="form-control" placeholder="Name">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="nearby_place_type[]">Type</label>
                                                    <input type="text" name="nearby_place_type[]" required class="form-control" placeholder="Type (e.g., school, hospital)">
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="nearby_place_distance[]">Distance (km)</label>
                                                    <input type="number" step="0.01" name="nearby_place_distance[]" required class="form-control" placeholder="Distance">
                                                </div>
                                                <button type="button" class="remove-row btn btn-danger btn-sm mt-2 mb-2 text-right text-end float-end"><i class="bi bi-x-circle"></i></button>

                                            </div>
                                        </div>
                                        <button type="button" id="addNearbyPlaceRow"  class="btn btn-success btn-sm add-city-btn"><i class="bi bi-plus-circle"></i></button>

                                    </div>

                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-clipboard2-check align-baseline me-1"></i> Save</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var propertyCategory = document.getElementById('property_category');
            var rentalDurationContainer = document.getElementById('rental_duration_container');
            function toggleRentalDuration() {
                if (propertyCategory.value === 'Rent') {
                    rentalDurationContainer.style.display = 'block';
                } else {
                    rentalDurationContainer.style.display = 'none';
                }
            }

            propertyCategory.addEventListener('change', toggleRentalDuration);
            toggleRentalDuration();
        });
    </script>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );
        const inputElement = document.getElementById('propertyImages');
        FilePond.create(inputElement, {
            allowMultiple: true,
            acceptedFileTypes: ['image/*'],
            server: {
                process: {
                    url: '{{ route("agent.property.upload_images") }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.select2-dropdown').select2({
                theme: 'bootstrap', // Use the Bootstrap theme for Select2
            });
        });
    </script>
    <script>
        $('#state_id').change(function() {
            var state_id = $(this).val();
            if (state_id) {
                var url = '{{ route("get-cities", ":state_id") }}';
                url = url.replace(':state_id', state_id);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#city_id').empty();
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty();
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addRowButton = document.getElementById('addNearbyPlaceRow');
            const nearbyPlaceRowsContainer = document.getElementById('nearbyPlaceRows');
            const rowTemplate = `
                <div class="col-md-12 nearby-place-row mt-2">
                    <div class="form-group mb-2">
                        <label for="nearby_place_name[]">Name</label>
                        <input type="text" name="nearby_place_name[]"  class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nearby_place_type[]">Type</label>
                        <input type="text" name="nearby_place_type[]" class="form-control" placeholder="Type (e.g., school, hospital)">
                    </div>

                    <div class="form-group mb-2">
                        <label for="nearby_place_distance[]">Distance (km)</label>
                        <input type="number" step="0.01" name="nearby_place_distance[]" class="form-control" placeholder="Distance">
                    </div>
                  <button type="button" class="remove-row btn btn-danger btn-sm mt-2 mb-2 text-right text-end float-end"><i class="bi bi-x-circle"></i></button>
                </div>
            `;

            addRowButton.addEventListener('click', function () {
                nearbyPlaceRowsContainer.insertAdjacentHTML('beforeend', rowTemplate);
            });

            nearbyPlaceRowsContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-row')) {
                    event.target.parentElement.remove();
                }
            });
        });
    </script>
@endsection
