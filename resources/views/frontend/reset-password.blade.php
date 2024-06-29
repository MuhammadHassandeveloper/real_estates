@extends('frontend.main')
@section('title', $title)
@section('content')
    <section class="pb-0 pt-0" style="background-color: #f4f4f4; min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-12">
                    <div class="modal-body">
                        <div class="hero-search-wrap">
                            <div class="hero-search mb-4 mt-2 text-center">
                                <h4 class="modal-header-title">Reset Password</h4>
                            </div>
                            <div class="hero-search-content">
                                <form action="{{ url('reset-password') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter E-Mail *" required>
                                            <i class="ti-email"></i>
                                            @error('email')
                                            <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="password" name="password" class="form-control" placeholder="New Password" required>
                                            <i class="ti-unlock"></i>
                                            @error('password')
                                            <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                            <i class="ti-unlock"></i>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn search-btn">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
