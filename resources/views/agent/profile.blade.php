@extends('agent.main')
@section('title', $title)
@section('style')

@stop
@section('content')
    <?php
    use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
    $user = Sentinel::getUser();
    ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Profile View</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('agent/dashboard') }}">Real Estate</a></li>
                                <li class="breadcrumb-item active">Profile View</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="agentList">
                        <div class="card-body">
                            <div class="row">
                                <!--end col-->
                                <div class="col-xxl-3">
                                    <div class="card overflow-hidden">
                                        <div class="card-body pt-0 mt-5">
                                            <div class="text-center">
                                                <div class="mt-5">
                                                    <h5>{{ Sentinel::getUser()->first_name .' '. Sentinel::getUser()->last_name }}
                                                        <i class="bi bi-patch-check-fill align-baseline text-info ms-1"></i>
                                                    </h5>
                                                    <p class="text-muted">{{ App\Helpers\AppHelper::roleName(Sentinel::getUser()->id) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-9">
                                    <div class="d-flex align-items-center flex-wrap gap-2 mb-4">
                                        <ul class="nav nav-pills arrow-navtabs nav-secondary gap-2 flex-grow-1 order-2 order-lg-1"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                                   role="tab"
                                                   aria-selected="false" tabindex="-1">
                                                    Personal Details
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword"
                                                   role="tab"
                                                   aria-selected="true">
                                                    Changes Password
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card">
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="personalDetails" role="tabpanel">
                                                <div class="card-header">
                                                    <h6 class="card-title mb-0">Personal Details</h6>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{ route('agent.profile_update') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="firstnameInput" class="form-label">First Name</label>
                                                                    <input type="text" class="form-control" name="first_name" id="firstnameInput" placeholder="Enter your firstname" value="{{ old('first_name', $user->first_name) }}">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="lastnameInput" class="form-label">Last Name</label>
                                                                    <input type="text" class="form-control" id="lastnameInput" name="last_name" placeholder="Enter your last name" value="{{ old('last_name', $user->last_name) }}">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="phonenumberInput" class="form-label">Whatsapp Phone</label>
                                                                    <input type="text" class="form-control" id="phonenumberInput" name="phone" placeholder="Enter your phone number" value="{{ old('phone', $user->phone) }}">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="emailInput" class="form-label">Email Address</label>
                                                                    <input type="email" class="form-control" id="emailInput" readonly disabled value="{{ $user->email }}">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="cityInput" class="form-label">City</label>
                                                                    <input type="text" class="form-control" id="cityInput" name="city" placeholder="City" value="{{ old('city', $user->city) }}">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="stateInput" class="form-label">State</label>
                                                                    <input type="text" class="form-control" id="stateInput" name="state" placeholder="State" value="{{ old('state', $user->state) }}">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="zipcodeInput" class="form-label">Zip Code</label>
                                                                    <input type="text" class="form-control" minlength="5" maxlength="6" name="zip_code" id="zipcodeInput" placeholder="Enter zipcode" value="{{ old('zip_code', $user->zip_code) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="bio" class="form-label">Bio</label>
                                                                    <textarea type="text" class="form-control" minlength="5" maxlength="1000" id="bio" name="bio" placeholder="Enter bio">{{ old('bio', $user->bio) }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <label class="form-label mb-3">Profile Photo</label>
                                                                <div class="text-center mb-3">
                                                                    <div class="position-relative d-inline-block">
                                                                        <div class="position-absolute top-100 start-100 translate-middle">
                                                                            <label for="companyLogo-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Select company logo" data-bs-original-title="Select company logo">
                                                                                <span class="avatar-xs d-inline-block">
                                                                                    <span class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                                        <i class="ri-image-fill"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </label>
                                                                            <input class="form-control d-none" id="companyLogo-image-input" name="photo" type="file" accept="image/png, image/gif, image/jpeg">
                                                                        </div>
                                                                        <div class="avatar-lg">
                                                                            <div class="avatar-title bg-light rounded-3">
                                                                                <img src="{{ asset('property_images/'.Sentinel::getUser()->photo) }}" alt="" id="companyLogo-img" class="avatar-md h-auto rounded-3 object-fit-cover">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 d-flex justify-content-end text-end">
                                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                                <div class="card-header">
                                                    <h6 class="card-title mb-0">Changes Password</h6>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{ route('agent.password_update') }}" method="POST">
                                                        @csrf
                                                        <div class="row g-2 justify-content-lg-between align-items-center">
                                                            <div class="col-lg-4">
                                                                <div class="auth-pass-inputgroup">
                                                                    <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                                    <div class="position-relative">
                                                                        <input type="password" class="form-control password-input" name="old_password" id="oldpasswordInput" placeholder="Enter current password" required>
                                                                        <button class="btn btn-link position-absolute top-0 end-0 text-decoration-none text-muted password-addon" type="button">
                                                                            <i class="ri-eye-fill align-middle"></i>
                                                                        </button>
                                                                        @if ($errors->has('old_password'))
                                                                            <span class="text-danger mt-2">{{ $errors->first('old_password') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="auth-pass-inputgroup">
                                                                    <label for="password-input" class="form-label">New Password*</label>
                                                                    <div class="position-relative">
                                                                        <input type="password" class="form-control password-input" name="new_password" id="password-input" onpaste="return false" placeholder="Enter new password" required>
                                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button">
                                                                            <i class="ri-eye-fill align-middle"></i>
                                                                        </button>
                                                                        @if ($errors->has('new_password'))
                                                                            <span class="text-danger mt-2">{{ $errors->first('new_password') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="auth-pass-inputgroup">
                                                                    <label for="confirm-password" class="form-label">Confirm Password*</label>
                                                                    <div class="position-relative">
                                                                        <input type="password" class="form-control password-input" name="new_password_confirmation" onpaste="return false" id="confirm-password" placeholder="Confirm password" required>
                                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button">
                                                                            <i class="ri-eye-fill align-middle"></i>
                                                                        </button>
                                                                        @if ($errors->has('new_password_confirmation'))
                                                                            <span class="text-danger mt-2">{{ $errors->first('new_password_confirmation') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="card bg-light shadow-none passwd-bg" id="password-contain">
                                                                    <div class="card-body">
                                                                        <div class="mb-4">
                                                                            <h5 class="fs-sm">Password must contain:</h5>
                                                                        </div>
                                                                        <div class="">
                                                                            <p id="pass-length" class="invalid fs-xs mb-2">Minimum <b>8 characters</b></p>
                                                                            <p id="pass-lower" class="invalid fs-xs mb-2">At <b>lowercase</b> letter (a-z)</p>
                                                                            <p id="pass-upper" class="invalid fs-xs mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                                                            <p id="pass-number" class="invalid fs-xs mb-0">A least <b>number</b> (0-9)</p>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-12">
                                                                <div class="d-flex justify-content-end text-end">
                                                                    <button type="submit" class="btn btn-success">Change Password</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('admin/assets/js/pages/passowrd-create.init.js') }}"></script>
@endsection
