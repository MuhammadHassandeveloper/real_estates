@extends('agent.main')
@section('title', $title)
@section('properties-drops', 'show')
@section('property_create', 'active')
@section('style')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
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
                            <form action="{{ url('agent/property-update') }}" method="POST" enctype="multipart/form-data" id="propertyForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $property->id }}">
                                <input type="hidden" id="imageDetails" name="image_details" value="[]">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Property Images<span class="text-danger">*</span></label>
                                            <input type="file" id="propertyImages" name="property_images[]" multiple accept="image/*">
                                            @foreach($pimages as $pimage)
                                                <input type="hidden" name="existing_images[]" value="{{ $pimage->id }}">
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mb-3">
                                                <label for="Property-title-input" class="form-label">Property title<span class="text-danger">*</span></label>
                                                <input type="text" id="Property-title-input" name="title" class="form-control" placeholder="Enter property title" value="{{ old('title', $property->title) }}" required>
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
                                                            <option value="{{ $ptype->id }}" {{ old('property_type_id', $property->property_type_id) == $ptype->id ? 'selected' : '' }}>{{ $ptype->name }}</option>
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
                                                <input type="number" id="bedroom-input" name="bedrooms" class="form-control" placeholder="Enter Bedroom" value="{{ old('bedrooms', $property->bedrooms) }}" required>
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
                                                <input type="number" class="form-control" name="bathrooms" id="bathroom-input" placeholder="Enter Bathroom" value="{{ old('bathrooms', $property->bathrooms) }}" required>
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
                                                <input type="number" class="form-control" name="rooms" id="room-input" placeholder="Enter rooms" value="{{ old('rooms', $property->rooms) }}" required>
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
                                                <input type="number" class="form-control" name="garages" id="garage-input" placeholder="Enter garages" value="{{ old('garages', $property->garages) }}" required>
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
                                                <input type="number" class="form-control" name="size_sqft" id="sqft-input" placeholder="Enter sqft" value="{{ old('size_sqft', $property->size_sqft) }}" required>
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
                                                    <input type="number" class="form-control" id="Property-price-input" name="price" placeholder="Enter price" value="{{ old('price', $property->price) }}" required>
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
                                                <input type="text" class="form-control" name="address" id="street-address" placeholder="Enter street address" value="{{ old('address', $property->address) }}" required>
                                                @error('address')
                                                <span class="text-danger error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="state_id" class="form-label">State<span class="text-danger">*</span></label>
                                            <select class="form-control select2-dropdown" name="state_id" id="state_id" required>
                                                <option value="">-- Select --</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $property->id }}" {{ $property->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
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
                                                <select class="form-control select2-dropdown" name="city_id" id="city_id" required>
                                                    <option value="">-- Select --</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->id }}" {{ $property->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                                    @endforeach
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
                                                <input type="text" class="form-control" name="zip_code" id="zipcode-input" placeholder="20325" value="{{ old('zip_code', $property->zip_code) }}" required>
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
                                                <input type="number" class="form-control" name="building_age" id="building_age-input" placeholder="25" value="{{ old('building_age', $property->building_age) }}" required>
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
                                                    <option value="0" {{ old('is_featured', $property->is_featured) == '0' ? 'selected' : '' }}>No</option>
                                                    <option value="1" {{ old('is_featured', $property->is_featured) == '1' ? 'selected' : '' }}>Yes</option>
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
                                                <option value="Sale" {{ old('property_category', $property->property_category) == 'Sale' ? 'selected' : '' }}>Sale</option>
                                                <option value="Rent" {{ old('property_category', $property->property_category) == 'Rent' ? 'selected' : '' }}>Rent</option>
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
                                                <option value="Weekly" {{ old('rental_duration', $property->rental_duration) == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                                <option value="Monthly" {{ old('rental_duration', $property->rental_duration) == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                                <option value="Yearly" {{ old('rental_duration', $property->rental_duration) == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                            </select>
                                            @error('rental_duration')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @foreach($ftypes as $ftype)
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" name="property_features[]" class="form-check-input" id="additionalFeatures{{ $ftype->id }}" value="{{ $ftype->id }}" {{ in_array($ftype->id, $property->property_features) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="additionalFeatures{{ $ftype->id }}">{{ $ftype->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-lg-12 col-12">
                                            <div class="mb-3">
                                                <label for="short_description" class="form-label">Short Description</label>
                                                <textarea class="form-control" name="short_description" id="short_description" rows="3">{{ old('short_description', $property->short_description) }}</textarea>
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
                                                <textarea class="form-control" name="long_description" id="long_description" rows="6">{{ old('long_description', $property->long_description) }}</textarea>
                                                @error('long_description')
                                                <span class="text-danger error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary"><i class="bi bi-clipboard2-check align-baseline me-1"></i> Update</button>
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

            // Initial check based on the old input or the property value
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
        const imageDetailsInput = document.getElementById('imageDetails');
        const pond = FilePond.create(inputElement, {
            allowMultiple: true,
            acceptedFileTypes: ['image/*'],
            server: {
                process: {
                    url: '{{ route("agent.property.upload_images") }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                load: (source, load) => {
                    fetch(source)
                        .then(res => res.blob())
                        .then(load);
                }
            },
            files: [
                    @foreach($pimages as $pimage)
                {
                    source: '{{ asset($pimage->image_path) }}',
                    options: {
                        type: 'local',
                        metadata: {
                            id: '{{ $pimage->id }}',
                            file_path: '{{ asset($pimage->image_path) }}',
                            file_name: '{{ $pimage->image }}'
                        }
                    }
                },
                @endforeach
            ],
            onprocessfile: (error, file) => {
                if (!error) {
                    updateImageDetails();
                }
            },
            onremovefile: (error, file) => {
                if (!error) {
                    updateImageDetails();
                }
            }
        });

        function updateImageDetails() {
            const files = pond.getFiles();
            const imageDetails = files.map(file => ({
                file_details: {
                    file_name: file.filename,
                    file_path: file.getMetadata('file_path')
                }
            }));
            imageDetailsInput.value = JSON.stringify(imageDetails);
        }
        updateImageDetails();
    </script>
    <script>
        $(document).ready(function () {
            $('.select2-dropdown').select2({
                theme: 'bootstrap', // Use the Bootstrap theme for Select2
            });

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
                            $('#city_id').append('<option value="">-- Select --</option>');
                            $.each(data, function(key, value) {
                                $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">-- Select --</option>');
                }
            });
        });
    </script>

@endsection
