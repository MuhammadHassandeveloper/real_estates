@extends('agency.main')
@section('title', $title)
@section('agency-agents-drops', 'show')
@section('agency_agent_create', 'active')
@section('style')
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Update Agent</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('agent/dashboard') }}">Real Estate</a></li>
                                <li class="breadcrumb-item active">Update Agent</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="agentList">
                        <div class="card-body">
                            <form action="{{ route('agency.update_agent') }}" method="POST" enctype="multipart/form-data" id="propertyForm">
                                @csrf
                                <input type="hidden" name="id" value="{{$agent->id}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter first name" value="{{ old('first_name', $agent->first_name) }}" required>
                                            @error('first_name')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter last name" value="{{ old('last_name', $agent->last_name) }}" required>
                                            @error('last_name')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone', $agent->phone) }}" required>
                                            @error('phone')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email', $agent->email) }}" required>
                                            @error('email')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                                            @error('password')
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
                                                    <option value="{{ $state->id }}" {{ $agent->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
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
                                                    <option value="{{ $city->id }}" {{ $agent->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
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
                                            <label for="zip_code" class="form-label">Zip Code<span class="text-danger">*</span></label>
                                            <input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="Enter zip code" value="{{ old('zip_code', $agent->zip_code) }}" required>
                                            @error('zip_code')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input type="file" id="photo" name="photo" class="form-control">
                                            @error('photo')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12  col-12">
                                        <div class="mb-3">
                                            <label for="bio" class="form-label">Bio</label>
                                            <textarea id="bio" name="bio" class="form-control" rows="3" placeholder="Enter bio">{{ old('bio',$agent->bio) }}</textarea>
                                            @error('bio')
                                            <span class="text-danger error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
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
