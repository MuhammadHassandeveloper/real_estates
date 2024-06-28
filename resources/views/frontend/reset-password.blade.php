@extends('frontend.main')
@section('title', $title)
@section('content')
    <section class="pb-0 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 col-sm-12">
                    <div class="modal-body">
                        <div class="hero-search-wrap">
                            <div class="hero-search mb-2">
                                <h2 class="mb-2 mt-2 ">Reset Password</h2>
                            </div>
                            <div class="hero-search-content">
                                <form action="{{ url('reset-password') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-with-icon">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter E-Mail *">
                                                    <i class="ti-email"></i>
                                                    @error('email')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-with-icon">
                                                    <input type="password" name="password" class="form-control" placeholder="New Password" required>
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

                                    <div class="row mt-2">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-with-icon">
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                                    <i class="ti-unlock"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn search-btn">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>
@stop
