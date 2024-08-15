@extends('customer.main')
@section('title',$title)
@section('style')
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Activities</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('agent/dashboard') }}">Real Estate</a></li>
                                <li class="breadcrumb-item active">Activities List</li>
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
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Recent Activities & Timeline</h6>
                                        </div>
                                        <div class="card-body">
                                            <ul class="acitivity-timeline-2 list-unstyled mb-0">
                                                @if($activities)
                                                    @foreach($activities as $activity)
                                                    <li>
                                                        <h6 class="fs-md">{{ $activity->heading }}</h6>
                                                        <p><strong>Action Performed At:</strong>  {{ $activity->created_at->format('F j, Y, g:i a') }}</p>
                                                        <p class="mb-0">{{ $activity->content }}</p>
                                                    </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@stop
@section('script')

@endsection

