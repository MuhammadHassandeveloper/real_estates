@extends('frontend.main')
@section('title',$title)
@section('agents-page','active')
@section('style')
@stop
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <h2 class="ipt-title">All Agents</h2>
                    <span class="ipn-subtitle">Lists of our all Popular agents</span>

                </div>
            </div>
        </div>
    </div>


    <section>
        <div class="container">
            @if($agents->count() > 0)
                <div class="row">
                    @foreach($agents as $agent)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="agents-grid">
                            <div class="agent-call">
                                <a href="https://wa.me/{{ $agent->whatsapp_phone }}">
                                    <i class="lni-whatsapp"></i>
                                </a>
                            </div>
                            <div class="agents-grid-wrap">

                                <div class="fr-grid-thumb">
                                    <a href="{{ route('frontend.agent',$agent->id) }}">
                                        <img src="{{ asset('uploads/'.$agent->photo) }}" class="img-fluid mx-auto" alt="">
                                    </a>
                                </div>
                                <div class="fr-grid-deatil">
                                    <h5 class="fr-can-name">
                                        <a href="{{ route('frontend.agent',$agent->id) }}">{{ $agent->first_name .' '. $agent->last_name }}</a>
                                    </h5>
                                    <span class="fr-position"><i class="lni-map-marker"></i>{{ $agent->city .' '. $agent->state }}</span>
                                </div>

                            </div>

                            <div class="fr-grid-info">
                                <ul>
                                    @php
                                          $total_properties = App\Helpers\AppHelper::agentPropertiescount($agent->id);
                                    @endphp
                                    <li>Properties<span>{{  $total_properties }}</span></li>
                                    <li>Email<span>{{ $agent->email }}</span></li>
                                    <li>Phone<span>{{ $agent->phone }}</span></li>
                                </ul>
                            </div>

                            <div class="fr-grid-footer">
                                <a href="{{ route('frontend.agent',$agent->id) }}" class="btn btn-outline-theme full-width">View Profile<i class="ti-arrow-right ml-1"></i></a>
                            </div>

                        </div>
                    </div>
                    @endforeach

                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="pagination p-center">
                                    {{ $agents->links('vendor.pagination.bootstrap-4') }}
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

