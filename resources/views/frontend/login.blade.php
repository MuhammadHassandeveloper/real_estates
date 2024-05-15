@extends('frontend.main')
@section('title',$title)
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
                        <h4 class="modal-header-title">Log In</h4>
                            <form action="{{ url('post-login') }}" class="login-form">
                                @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-with-icon">
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                    <i class="ti-email"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-with-icon">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <i class="ti-unlock"></i>
                                </div>
                            </div>

                            <div class="modal-divider">
                                <span>Don't have an account ?
                                    <a href="{{ url('signup') }}">Signup</a>
                                </span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md full-width pop-login">Login</button>
                            </div>

                        </form>
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

