@extends('frontend.main')
@section('title', $title)
@section('contact-us-page','active')

@section('content')
    @php
    use App\Helpers\AppHelper;
    @endphp
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2 class="ipt-title">{{ $title }}</h2>
                </div>
            </div>
        </div>
    </div>


    <section>

        <div class="container">

            <!-- row Start -->
            <div class="row">

                <div class="col-lg-7 col-md-7">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control simple">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control simple">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control simple">
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control simple"></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-theme" type="submit">Submit Request</button>
                    </div>

                </div>

                <div class="col-lg-5 col-md-5">
                    <div class="contact-info">

                        <h2>Get In Touch</h2>
                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-home"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Reach Us</h4>
                                {{ AppHelper::contact_address() }},<br>{{ AppHelper::contact_city() }},<br>{{ AppHelper::contact_country() }}
                            </div>
                        </div>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Drop A Mail</h4>
                                {{ AppHelper::email() }}
                            </div>
                        </div>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Call Us</h4>
                                +{{ AppHelper::phone() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /row -->

        </div>

    </section>
@stop
