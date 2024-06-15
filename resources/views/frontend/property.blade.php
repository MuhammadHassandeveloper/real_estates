@extends('frontend.main')
@section('title',$title)
@section('properties-page','active')
@section('style')
    <style>
        .agent-call {
            position: absolute;
            right: 5px;
            top: -10px;
        }
    </style>
@stop
@section('content')
    @php
        use Carbon\Carbon;
        use App\Helpers\AppHelper;
       $pimages = $property->images;
    @endphp

    <section class="gray">
        <div class="container">
            <div class="row">

                <!-- property main detail -->
                <div class="col-lg-8 col-md-12 col-sm-12">

                    <div class="slide-property-first mb-4">
                        <div class="pr-price-into">
                            <h2>{{ $property->country->currency_sign }}{{ number_format($property->price) }}
                                @if(!is_null($property->rental_duration))
                                    <i>/ {{ $property->rental_duration}}</i>
                                @endif
                                <span class="prt-type rent">{{ $property->property_category }}</span>
                            </h2>

                            <span>{{ $property->title }}</span>
                            <span><i class="lni-map-marker"></i> {{ $property->address }}, {{ $property->city->name }}</span>
                        </div>
                    </div>


                    <div class="property3-slide single-advance-property mb-4">

                        <div class="slider-for">
                            @if($pimages->isNotEmpty())
                                @foreach($pimages as $image)
                                    <a href="{{ asset($image->image_path) }}" class="item-slick">
                                        <img src="{{ asset($image->image_path) }}" alt="Alt">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                        <div class="slider-nav">
                            @if($pimages->isNotEmpty())
                                @foreach($pimages as $image)
                                    <div class="item-slick">
                                        <img src="{{ asset($image->image_path) }}" alt="Alt">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- Single Block Wrap -->
                    <div class="block-wrap">

                        <div class="block-header">
                            <h4 class="block-title">Property Info</h4>
                        </div>

                        <div class="block-body">
                            <ul class="dw-proprty-info">
                                <li><strong>Bed:</strong> {{ $property->bedrooms }}</li>
                                <li><strong>Bath:</strong> {{ $property->bathrooms }}</li>
                                <li><strong>Garages</strong>{{ $property->garages }}</li>
                                <li><strong>Sqft:</strong> {{ $property->size_sqft }}</li>
                                <li><strong>Type</strong>{{$property->propertyType->name}}</li>
                                <li><strong>Price</strong>
                                    {{ $property->country->currency_sign  }}{{ number_format($property->price) }}
                                </li>
                                <li><strong>City</strong>{{ $property->city->name }}</li>
                                <li><strong>Building Age</strong>{{ $property->building_age }}</li>
                            </ul>
                        </div>

                    </div>

                    <!-- Single Block Wrap -->
                    <div class="block-wrap">

                        <div class="block-header">
                            <h4 class="block-title">Short Introduction</h4>
                        </div>

                        <div class="block-body">
                            <p>
                                {{ $property->short_description }}
                            </p>
                        </div>

                        <div class="block-header">
                            <h4 class="block-title">Description</h4>
                        </div>

                        <div class="block-body">
                            <p>
                                {{ $property->long_description }}
                            </p>
                        </div>

                    </div>

                    <!-- Single Block Wrap -->
                    <div class="block-wrap">

                        <div class="block-header">
                            <h4 class="block-title">Ameneties</h4>
                        </div>

                        <div class="block-body">
                            <ul class="avl-features third">
                                @php
                                    $pfeatures = $property->features()
                                @endphp
                                @foreach($pfeatures as $feature)
                                    <li>{{ $feature->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <!-- Property Reviews -->
                    <div class="block-wrap">

                        <div class="block-header">
                            <h4 class="block-title">47 Reviews</h4>
                        </div>

                        <div class="block-body">
                            <div class="author-review">
                                <div class="comment-list">
                                    <ul>
                                        <li class="article_comments_wrap">
                                            <article>
                                                <div class="article_comments_thumb">
                                                    <img src="assets/img/user-1.jpg" alt="">
                                                </div>
                                                <div class="comment-details">
                                                    <div class="comment-meta">
                                                        <div class="comment-left-meta">
                                                            <h4 class="author-name">Rosalina Kelian</h4>
                                                            <div class="comment-date">19th May 2018</div>
                                                        </div>
                                                    </div>
                                                    <div class="comment-text">
                                                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                                            qui officia deserunt mollit anim laborumab.
                                                            perspiciatis unde omnis iste natus error.</p>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="reviews-checked theme-cl">
                                <i class="fas fa-arrow-alt-circle-down mr-2"></i>
                                See More Reviews
                            </a>

                        </div>

                    </div>

                    <!-- Single Block Wrap -->
                    <div class="block-wrap">

                        <div class="block-header">
                            <h4 class="block-title">Write A Review</h4>
                        </div>

                        <div class="block-body">
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Subject Title">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Name">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <textarea class="form-control ht-80" placeholder="Messages"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <button class="btn btn-theme" type="submit">Submit Review</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>

                <!-- property Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="page-sidebar">
                        <!-- slide-property-sec -->
                        <div class="slide-property-sec mb-4">
                            <div class="pr-all-info">
                                <div class="pr-single-info">
                                    <div class="share-opt-wrap">
                                        <button type="button" class="btn-share" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Share this"
                                                data-url="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                            <i class="lni-share"></i>
                                        </button>

                                        <div class="dropdown-menu animated flipInX">
                                            <a href="javascript:void(0);" class="cl-facebook"><i class="lni-facebook"></i></a>
                                            <a href="javascript:void(0);" class="cl-twitter"><i class="lni-twitter"></i></a>
                                            <a href="javascript:void(0);" class="cl-instagram"><i class="lni-instagram"></i></a>
                                            <a href="javascript:void(0);" class="cl-whatsapp"><i class="lni-whatsapp"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $user = AppHelper::userDetail($property->agent_id);
                        @endphp
                            <!-- Agent Detail -->
                        <div class="agent-widget">
                            <div class="agent-title">
                                <div class="agent-photo">
                                    <div class="agent-call">
                                        <a href="https://wa.me/{{ $user->whatsapp_phone }}">
                                            <i class="lni-whatsapp"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('uploads/'.$user->photo) }}" alt="">
                                </div>

                                <div class="agent-details">
                                    <h4 class="mb-2">
                                        <a href="{{ route('frontend.agent',$user->id) }}">{{ $user->first_name .' '.$user->last_name}}
                                        </a>
                                    </h4>
                                    <span class="mt-2"><i class="lni-phone-handset"></i>{{ $user->phone }}</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Phone">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control">I'm interested in this property.</textarea>
                            </div>
                            <button class="btn btn-theme full-width">Send Message</button>
                        </div>

                        <!-- Featured Property -->
                        <div class="sidebar-widgets">
                            <h4>Featured Property</h4>
                            <div class="sidebar_featured_property">
                                    @if($fproperties && $fproperties->count() > 0)
                                        @foreach($fproperties as $property)
                                            @php
                                                $pimages = AppHelper::propertImages($property->id);
                                                $ptype = AppHelper::propertyType($property->id);
                                                $created_at = Carbon::parse($property->created_at);
                                                $humanDiff = $created_at->diffForHumans();
                                            @endphp

                                            <div class="sides_list_property">
                                                <div class="sides_list_property_thumb">
                                                    <img src="{{ asset($pimages->first()->image_path) }}" class="img-fluid" alt="">
                                                </div>
                                                <div class="sides_list_property_detail">
                                                    <h4>
                                                        <a href="{{ route('frontend.property-detail', ['id' => $property->id, 'title' => $property->title]) }}">
                                                          {{ $property->title }}
                                                        </a>
                                                    </h4>
                                                    <span><i class="ti-location-pin"></i>
                                                          {{ $property->state->name,$property->city->name }}
                                                    </span>
                                                    <div class="lists_property_price">
                                                        <div class="lists_property_types">
                                                            <div class="property_types_vlix">{{ $property->property_category }}</div>
                                                        </div>
                                                        <div class="lists_property_price_value">
                                                            <h4>{{ $property->country->currency_sign }}{{ number_format($property->price) }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No properties available.</p>
                                    @endif
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>

@stop
@section('script')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-share').forEach(function(shareButton) {
                shareButton.addEventListener('click', function() {
                    var propertyUrl = shareButton.getAttribute('data-url');
                    var facebookShareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(propertyUrl);
                    var twitterShareUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(propertyUrl);
                    var instagramShareUrl = 'https://www.instagram.com/?url=' + encodeURIComponent(propertyUrl);
                    var whatsappShareUrl = 'https://wa.me/?text=' + encodeURIComponent(propertyUrl);
                    var dropdownMenu = shareButton.nextElementSibling;
                    dropdownMenu.querySelector('.cl-facebook').setAttribute('href', facebookShareUrl);
                    dropdownMenu.querySelector('.cl-twitter').setAttribute('href', twitterShareUrl);
                    dropdownMenu.querySelector('.cl-instagram').setAttribute('href', instagramShareUrl);
                    dropdownMenu.querySelector('.cl-whatsapp').setAttribute('href', whatsappShareUrl);
                });
            });
        });

    </script>
@endsection

