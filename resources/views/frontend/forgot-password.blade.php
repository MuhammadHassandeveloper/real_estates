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
                                <h2 class="mb-2 mt-2">Forgot Password</h2>
                            </div>
                            <div class="hero-search-content">
                                <form action="{{ url('forgot-password') }}" method="POST">
                                    @csrf
                                    <div class="row mt-2">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-with-icon">
                                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                                    <i class="ti-email"></i>
                                                </div>
                                                @error('email')
                                                <span class="text-danger error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn search-btn">Send Password Reset Link</button>
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
