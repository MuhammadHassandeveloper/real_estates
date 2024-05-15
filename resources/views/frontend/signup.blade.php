@extends('frontend.main')
@section('title',$title)
@section('login-page','active')
@section('style')
    <style>
        .hero-search-wrap {
            max-width: 700px !important;
        }
    </style>
@stop
@section('content')

    <!-- ============================ Login  Start ================================== -->
    <section class="pb-0 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-10 col-sm-12">
                    <div class="modal-body">
                        <div class="hero-search-wrap mx">
                            <div class="hero-search-content">
                                <h4 class="modal-header-title">Sign Up</h4>
                                <div class="login-form hero-search-content">
                                    <form action="{{ url('user-store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="text"
                                                       class="form-control @error('first_name') is-invalid @enderror"
                                                       name="first_name" placeholder="First Name"
                                                       value="{{ old('first_name') }}">
                                                <i class="ti-user"></i>
                                            </div>
                                            @error('first_name')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="text"
                                                       class="form-control @error('last_name') is-invalid @enderror"
                                                       name="last_name" placeholder="Last Name"
                                                       value="{{ old('last_name') }}">
                                                <i class="ti-user"></i>
                                            </div>
                                            @error('last_name')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="tel"
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       name="phone" placeholder="123 546 5847"
                                                       value="{{ old('phone') }}">
                                                <i class="lni-phone-handset"></i>
                                            </div>
                                            @error('phone')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <select class="form-control @error('role_type') is-invalid @enderror"
                                                        name="role_type">
                                                    <option value="" disabled selected>Select Role</option>
                                                    <option value="customer"
                                                            @if(old('role_type') == 'customer') selected @endif>As a
                                                        Customer
                                                    </option>
                                                    <option value="agent"
                                                            @if(old('role_type') == 'agent') selected @endif>As an Agent
                                                    </option>
                                                    <option value="agency"
                                                            @if(old('role_type') == 'agency') selected @endif>As an
                                                        Agency
                                                    </option>
                                                </select>
                                                <i class="ti-briefcase"></i>
                                            </div>
                                            @error('role_type')
                                            <span class="text-danger error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" placeholder="Email" value="{{ old('email') }}">
                                                <i class="ti-email"></i>
                                            </div>
                                            @error('email')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" placeholder="Password">
                                                <i class="ti-unlock"></i>
                                            </div>
                                            @error('password')
                                            <span class="text-danger error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn search-btn">Sign Up</button>
                                </div>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>

        </div>
    </section>
    <!-- ============================ Login End ================================== -->
@stop
@section('script')
@endsection

