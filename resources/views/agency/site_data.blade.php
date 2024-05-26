@extends('agent.main')
@section('title', $title)
@section('style')

@stop
@section('content')
    <?php
    use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
    $user = Sentinel::getUser();
    ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Profile View</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('agent/dashboard') }}">Real Estate</a></li>
                                <li class="breadcrumb-item active">Profile View</li>
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
                                <form action="{{ route('site_settings.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="phone">Phone:</label>
                                    <input type="text" id="phone" name="phone"><br>

                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email"><br>

                                    <label for="owner_name">Owner Name:</label>
                                    <input type="text" id="owner_name" name="owner_name"><br>

                                    <label for="site_title">Site Title:</label>
                                    <input type="text" id="site_title" name="site_title"><br>

                                    <label for="currency_sign">Currency Sign:</label>
                                    <input type="text" id="currency_sign" name="currency_sign"><br>

                                    <label for="currency_code">Currency Code:</label>
                                    <input type="text" id="currency_code" name="currency_code"><br>

                                    <label for="site_logo">Site Logo:</label>
                                    <input type="file" id="site_logo" name="site_logo"><br>

                                    <label for="favicon">Favicon:</label>
                                    <input type="file" id="favicon" name="favicon"><br>

                                    <label for="stripe_public_key">Stripe Public Key:</label>
                                    <input type="text" id="stripe_public_key" name="stripe_public_key"><br>

                                    <label for="stripe_secret_key">Stripe Secret Key:</label>
                                    <input type="text" id="stripe_secret_key" name="stripe_secret_key"><br>

                                    <label for="facebook_url">Facebook URL:</label>
                                    <input type="text" id="facebook_url" name="facebook_url"><br>

                                    <label for="twitter_url">Twitter URL:</label>
                                    <input type="text" id="twitter_url" name="twitter_url"><br>

                                    <label for="linkedin_url">LinkedIn URL:</label>
                                    <input type="text" id="linkedin_url" name="linkedin_url"><br>

                                    <label for="instagram_url">Instagram URL:</label>
                                    <input type="text" id="instagram_url" name="instagram_url"><br>

                                    <label for="meta_description">Meta Description:</label>
                                    <textarea id="meta_description" name="meta_description"></textarea><br>

                                    <label for="meta_keywords">Meta Keywords:</label>
                                    <textarea id="meta_keywords" name="meta_keywords"></textarea><br>

                                    <label for="contact_address">Contact Address:</label>
                                    <textarea id="contact_address" name="contact_address"></textarea><br>

                                    <label for="contact_city">Contact City:</label>
                                    <input type="text" id="contact_city" name="contact_city"><br>

                                    <label for="contact_state">Contact State:</label>
                                    <input type="text" id="contact_state" name="contact_state"><br>

                                    <label for="contact_zip">Contact Zip:</label>
                                    <input type="text" id="contact_zip" name="contact_zip"><br>

                                    <label for="contact_country">Contact Country:</label>
                                    <input type="text" id="contact_country" name="contact_country"><br>

                                    <label for="additional_data">Additional Data (JSON):</label>
                                    <textarea id="additional_data" name="additional_data"></textarea><br>

                                    <button type="submit">Save Settings</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('admin/assets/js/pages/passowrd-create.init.js') }}"></script>
@endsection
