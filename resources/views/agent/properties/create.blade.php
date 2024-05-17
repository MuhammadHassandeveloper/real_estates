@extends('agent.main')
@section('title',$title)
@section('properties-drops','show')
@section('property_create','active')
@section('style')
    <link href="{{ asset('admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="agentList">
                        <div class="card-body">
                            <form action="#!">
                                <div class="mb-3">
                                    <label class="form-label">Property Images<span class="text-danger">*</span></label>
                                    <div class="dropzone property-dropzone border border-1 border-dashed text-center dz-clickable">

                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="bi bi-cloud-download fs-1"></i>
                                            </div>

                                            <h5 class="fs-md mb-0">Drop files here or click to upload.</h5>
                                        </div>
                                    </div>

                                    <ul class="list-unstyled mb-0" id="property-preview">

                                    </ul>
                                    <!-- end dropzon-preview -->
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="Property-title-input" class="form-label">Property title<span class="text-danger">*</span></label>
                                            <input type="text" id="Property-title-input" class="form-control" placeholder="Enter property title" required="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="Property-type-input" class="form-label">Property Type<span class="text-danger">*</span></label>

                                            <select class="form-select" id="Property-type-input" data-choices="" data-choices-search-false="">
                                                <option value="">Select Property Type</option>
                                                <option value="Villa">Villa</option>
                                                <option value="Residency">Residency</option>
                                                <option value="Apartment">Apartment</option>
                                                <option value="Others">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="bedroom-input" class="form-label">Bedroom<span class="text-danger">*</span></label>
                                            <input type="number" id="bedroom-input" class="form-control" placeholder="Enter Bedroom" required="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="bathroom-input" class="form-label">Bathroom<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="bathroom-input" placeholder="Enter Bathroom" required="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="sqft-input" class="form-label">SQFT<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="sqft-input" placeholder="Enter sqft" required="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="Property-price-input" class="form-label">Price<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="Property-price-input" placeholder="Enter price" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="street-address" class="form-label">Street Address<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="street-address" placeholder="Enter street address" required="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="state-input" class="form-label">State<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="state-input" placeholder="Enter state" required="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="country-input" class="form-label">Country<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="country-input" placeholder="Enter country" required="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="zipcode-input" class="form-label">Zipcode<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="zipcode-input" placeholder="254 325" required="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures">
                                            <label class="form-check-label" for="additionalFeatures">Swimming pool</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures2">
                                            <label class="form-check-label" for="additionalFeatures2">Air conditioning</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures3">
                                            <label class="form-check-label" for="additionalFeatures3">Electricity</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures4">
                                            <label class="form-check-label" for="additionalFeatures4">Near Green Zone</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures5">
                                            <label class="form-check-label" for="additionalFeatures5">Near Shop</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures6">
                                            <label class="form-check-label" for="additionalFeatures6">Near School</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures7">
                                            <label class="form-check-label" for="additionalFeatures7">Parking Available</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures8">
                                            <label class="form-check-label" for="additionalFeatures8">Internet</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="additionalFeatures9">
                                            <label class="form-check-label" for="additionalFeatures9">Balcony</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-repeat align-baseline me-1"></i> Reset</button>
                                            <button type="button" class="btn btn-primary"><i class="bi bi-clipboard2-check align-baseline me-1"></i> Save</button>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </form>
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
    <!-- dropzone js -->
{{--    <script type="text/javascript">--}}
{{--        Dropzone.autoDiscover = false;--}}
{{--        var dropzone = new Dropzone('.dropzone', {--}}
{{--            url: '/upload', // Specify the URL where files should be uploaded--}}
{{--            thumbnailWidth: 200,--}}
{{--            maxFilesize: 1,--}}
{{--            acceptedFiles: ".jpeg,.jpg,.png,.gif",--}}
{{--            addRemoveLinks: true // Enable remove file option--}}
{{--        });--}}

{{--    </script>--}}
@endsection

