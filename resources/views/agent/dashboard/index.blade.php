@extends('agent.main')
@section('title',$title)
@section('style')
@stop
@section('content')
    @php
        use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
        use App\Helpers\AppHelper;
        $missingFields = AppHelper::checkAgentProfileCompletion(Sentinel::getUser()->id);
    @endphp
    <!-- Start Page-content -->
    <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Properties</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $propertiesCount }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Properties for Rent</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $rentedPropertiesCount }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Properties Purchased</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $purchasedPropertiesCount }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Favorite Properties</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $favoritePropertiesCount }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Total Rental Sum</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $rentalSum }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Total Purchase Sum</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $purchaseSum }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Rental Sum (Week)</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $rentalSumWeek }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Rental Sum (Month)</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $rentalSumMonth }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Rental Sum (Year)</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $rentalSumYear }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Purchase Sum (Week)</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $purchaseSumWeek }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Purchase Sum (Month)</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $purchaseSumMonth }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-xxl-4 col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column h-100">
                                            <p class="fs-md text-muted mb-4">Purchase Sum (Year)</p>
                                            <h3 class="mb-0 mt-auto">
                                                <span>{{ $purchaseSumYear }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

            </div>
    </div>
        <!-- End Page-content -->
@stop
@section('script')
@endsection

