@extends('frontend.main')
@section('title',$title)
@section('login-page','active')
@section('style')
@stop
@section('content')

    <!-- ============================ Login  Start ================================== -->
    <section class="pb-0 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 col-sm-12">
                    <div class="modal-body">
                        <div class="hero-search-wrap">
                            <div class="hero-search mb-2">
                                <h1>Login</h1>
                            </div>
                            <div class="hero-search-content login-form">
                                <form action="{{ url('post-login') }}" class="login-form">
                                    @csrf
                                    <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="text" name="email" class="form-control" placeholder="Email">
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
                                    <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="password" name="password" class="form-control" placeholder="Password">
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

                                    <div class="modal-divider">
                                        <span>Don't have an account ?
                                            <a href="{{ url('signup') }}">Signup</a>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn search-btn">Login</button>
                                    </div>

                                    <div class="text-center">
                                        <p class="mt-2"><a href="{{ route('forgot-password') }}" class="link">Forgot password?</a></p>
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
    <!-- ============================ Login End ================================== -->
@stop
@section('script')
@endsection

