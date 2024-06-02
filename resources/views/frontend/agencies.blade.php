@extends('frontend.main')
@section('title',$title)
@section('agencies-page','active')
@section('style')
@stop
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2 class="ipt-title">All Agency</h2>
                    <span class="ipn-subtitle">Lists of our all Popular agencies</span>

                </div>
            </div>
        </div>
    </div>
    <section>

        <div class="container">
            <!-- /row -->
            @if($agencies->count() > 0)
                <div class="row">
                    @foreach($agencies as $agency)
                        <div class="col-lg-12 col-md-12">
                            <div class="agency agency-list">
                                <a href="agency-page.html" class="agency-avatar">
                                    <img src="{{ asset('uploads/'.$agency->agency_logo) }}" alt="">
                                </a>

                                <div class="agency-content">
                                    <div class="agency-name">
                                        <h4><a href="agency-page.html">{{ $agency->first_name .' '. $agency->last_name }}</a></h4>
                                        <span><i class="lni-map-marker"></i>{{ $agency->city .' '. $agency->state }}</span>
                                    </div>

                                    <div class="agency-desc">
                                        <p>{{ $agency->bio}}</p>
                                    </div>

                                    <ul class="agency-detail-info">
                                        <li>
                                        <a href="https://wa.me/{{ $agency->whatsapp_phone }}">
                                            <i class="lni-whatsapp"></i>
                                            {{ $agency->whatsapp_phone }}
                                        </a>
                                        </li>
                                        <li><i class="lni-phone-handset"></i>{{ $agency->phone }}</li>
                                        <li><i class="lni-envelope"></i><a href="#">{{ $agency->email }}</a></li>
                                    </ul>

                                    <div class="clearfix"></div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="pagination p-center">
                                    {{ $agencies->links('vendor.pagination.bootstrap-4') }}
                                </ul>
                            </div>
                        </div>
                </div>
            @endif
        </div>

    </section>
@stop
@section('script')
@endsection

