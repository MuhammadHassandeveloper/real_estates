@extends('admin.main')
@section('title', 'Site Data')
@section('style')
@stop
@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Site Data</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Site Data</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ url('admin/site-data/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" required name="phone" id="phone" placeholder="Enter phone number" value="{{ old('phone', $siteData->phone ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" required name="email" id="email" placeholder="Enter email" value="{{ old('email', $siteData->email ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="owner_name" class="form-label">Owner Name</label>
                                            <input type="text" class="form-control" required name="owner_name" id="owner_name" placeholder="Enter owner name" value="{{ old('owner_name', $siteData->owner_name ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="site_title" class="form-label">Site Title</label>
                                            <input type="text" class="form-control" required name="site_title" id="site_title" placeholder="Enter site title" value="{{ old('site_title', $siteData->site_title ?? '') }}">

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="site_logo" class="form-label">Site Logo</label>
                                            <input type="file" class="form-control" name="site_logo" id="site_logo">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="favicon" class="form-label">Favicon</label>
                                            <input type="file" class="form-control" name="favicon" id="favicon">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="dashboard_logo" class="form-label">Dashboard Logo</label>
                                            <input type="file" class="form-control" name="dashboard_logo" id="dashboard_logo">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="dashboard_favicon" class="form-label">Dashboard Favicon</label>
                                            <input type="file" class="form-control" name="dashboard_favicon" id="dashboard_favicon">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="stripe_public_key" class="form-label">Stripe Public Key</label>
                                            <input type="text" class="form-control" required name="stripe_public_key" id="stripe_public_key" placeholder="Enter Stripe public key" value="{{ old('stripe_public_key', $siteData->stripe_public_key ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="stripe_secret_key" class="form-label">Stripe Secret Key</label>
                                            <input type="text" class="form-control" required name="stripe_secret_key" id="stripe_secret_key" placeholder="Enter Stripe secret key" value="{{ old('stripe_secret_key', $siteData->stripe_secret_key ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="facebook_url" class="form-label">Facebook URL</label>
                                            <input type="url" class="form-control" name="facebook_url" id="facebook_url" placeholder="Enter Facebook URL" value="{{ old('facebook_url', $siteData->facebook_url ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="twitter_url" class="form-label">Twitter URL</label>
                                            <input type="url" class="form-control" name="twitter_url" id="twitter_url" placeholder="Enter Twitter URL" value="{{ old('twitter_url', $siteData->twitter_url ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                            <input type="url" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="Enter LinkedIn URL" value="{{ old('linkedin_url', $siteData->linkedin_url ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="instagram_url" class="form-label">Instagram URL</label>
                                            <input type="url" class="form-control" name="instagram_url" id="instagram_url" placeholder="Enter Instagram URL" value="{{ old('instagram_url', $siteData->instagram_url ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="meta_description" class="form-label">Meta Description</label>
                                            <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Enter meta description">{{ old('meta_description', $siteData->meta_description ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                            <textarea class="form-control" name="meta_keywords" id="meta_keywords" placeholder="Enter meta keywords">{{ old('meta_keywords', $siteData->meta_keywords ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="contact_address" class="form-label">Contact Address</label>
                                            <input type="text" class="form-control" required name="contact_address" id="contact_address" placeholder="Enter contact address" value="{{ old('contact_address', $siteData->contact_address ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="contact_city" class="form-label">Contact City</label>
                                            <input type="text" class="form-control" required name="contact_city" id="contact_city" placeholder="Enter contact city" value="{{ old('contact_city', $siteData->contact_city ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="contact_state" class="form-label">Contact State</label>
                                            <input type="text" class="form-control" required name="contact_state" id="contact_state" placeholder="Enter contact state" value="{{ old('contact_state', $siteData->contact_state ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="contact_zip" class="form-label">Contact Zip</label>
                                            <input type="text" class="form-control" required name="contact_zip" id="contact_zip" placeholder="Enter contact zip" value="{{ old('contact_zip', $siteData->contact_zip ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="contact_country" class="form-label">Contact Country</label>
                                            <input type="text" class="form-control" required name="contact_country" id="contact_country" placeholder="Enter contact country" value="{{ old('contact_country', $siteData->contact_country ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success d-flex justify-content-end text-end">Save Changes</button>
                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-xl-4 col-md-6">
                    <div class="card card-height-100 bg-soft-primary shadow-none bg-opacity-10">
                        <div class="card-body">
                            <div class="mb-4 pb-2">
                                <img style="width: 150px; height: 75px;" src="{{ $siteData->site_logo }}">
                            </div>
                            <a href="javascript:void(0);">
                                <h6 class="fs-15 fw-semibold">Site Logo</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card card-height-100 bg-soft-primary shadow-none bg-opacity-10">
                        <div class="card-body">
                            <div class="mb-4 pb-2">
                                <img style="width: 150px; height: 75px;" src="{{ $siteData->favicon }}">
                            </div>
                            <a href="javascript:void(0);">
                                <h6 class="fs-15 fw-semibold">Site FavIcon </h6>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-height-100 bg-soft-primary shadow-none bg-opacity-10">
                        <div class="card-body">
                            <div class="mb-4 pb-2">
                                <img style="width: 150px; height: 75px;" src="{{ $siteData->dashboard_logo  }}">
                            </div>
                            <a href="#!">
                                <h6 class="fs-15 fw-semibold">Dashboard Logo <span class="text-muted fs-13"></span></h6>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-height-100 bg-soft-primary shadow-none bg-opacity-10">
                        <div class="card-body">
                            <div class="mb-4 pb-2">
                                <img style="width: 150px; height: 75px;" src="{{ $siteData->dashboard_favicon }}">
                            </div>
                            <a href="#!">
                                <h6 class="fs-15 fw-semibold">Dashboard FavIcon <span class="text-muted fs-13"></span></h6>
                            </a>
                        </div>
                    </div>
                </div>

            </div>




        </div>
    </div>

@stop
