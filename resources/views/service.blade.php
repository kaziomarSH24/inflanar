@extends('layout')
@section('title')
    <title>{{ $seo_setting->seo_title }}</title>
    <meta name="keywords" content="{{ $seo_setting->seo_keyword }}">
    <meta name="title" content="{{ $seo_setting->seo_title }}">
    <meta name="description" content="{{ $seo_setting->seo_description }}">
@endsection
@section('frontend-content')

    <!-- Breadcrumbs -->
    <section class="inflanar-breadcrumb" style="background-image: url({{ asset($breadcrumb) }});">
        <div class="container">
            <div class="row">
                <!-- Breadcrumb-Content -->
                <div class="col-12">
                    <div class="inflanar-breadcrumb__inner">
                        <div class="inflanar-breadcrumb__content">
                            <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Services')}}</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                <li class="active"><a href="javascript:;">{{__('admin.Services')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <!-- Features -->
    <section class="inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 mg-top-30">
                    <form action="">
                    <div class="inflanar-service-sidebar">
                        <!-- Single Sidebar -->
                        <div class="inflanar-service-sidebar__single">
                            <h4 class="inflanar-service-sidebar__title m-0">{{__('admin.Search')}}</h4>
                            <!-- Inflanar Search -->
                            <div class="inflanar-search-form inflanar-search-form__service mg-top-10">
                                <div class="inflanar-search-form__form">
                                    <input type="text" placeholder="{{__('admin.Search')}}" name="search" value="{{ request()->get('search') }}">
                                    <button type="submit" class="inflanar-btn inflanar-btn--search"><img src="{{ asset('frontend/img/in-search-white.svg') }}"></button>
                                </div>

                            </div>
                            <!-- End Inflanar Search -->
                        </div>
                        <!-- Single Sidebar -->
                        <div class="inflanar-service-sidebar__single mg-top-50">
                            <div class="inflanar-service-sidebar__checkboxd">
                                <h4 class="inflanar-service-sidebar__title m-0">{{__('admin.Select Category')}}</h4>

                                @if (request()->has('categories'))

                                    @foreach ($categories as $category)
                                        @php
                                            $is_request = false;
                                            foreach (request()->get('categories') as $request_cat) {
                                                if($request_cat == $category->slug) $is_request = true;
                                            }
                                        @endphp

                                        <div class="form-group inflanar-form-checkbox mg-top-15">
                                            <input {{  $is_request == true ? 'checked' : '' }} type="checkbox" id="cat{{ $category->id }}" name="categories[]" value="{{ $category->slug }}">
                                            <label class="inflanar-form-label" for="cat{{ $category->id }}">{{ $category->name }} <span>({{ $category->total_service }})</span></label>
                                        </div>


                                    @endforeach

                                @else
                                    @foreach ($categories as $category)
                                        <div class="form-group inflanar-form-checkbox mg-top-15">
                                            <input type="checkbox" id="cat{{ $category->id }}" name="categories[]" value="{{ $category->slug }}">
                                            <label class="inflanar-form-label" for="cat{{ $category->id }}">{{ $category->name }} <span>({{ $category->total_service }})</span></label>
                                        </div>
                                    @endforeach
                                @endif


                            </div>
                        </div>
                        <!-- End Single Sidebar -->
                        <!-- Single Sidebar -->
                        <div class="inflanar-service-sidebar__single mg-top-20">
                            <h4 class="inflanar-service-sidebar__title">{{__('admin.Price Filter')}}</h4>
                            <div class="price-filter pd-top-20">
                                <div class="price-filter-inner">
                                    <div id="slider-range"></div>
                                        <div class="price_slider_amount">
                                        <div class="label-input">
                                            <span>{{__('admin.Price')}}:</span><input type="text" id="amount" readonly>
                                        </div>

                                        <input type="hidden" name="min_amount" id="min_amount" value="0">
                                        <input type="hidden" name="max_amount" id="max_amount" value="{{ $max_amount }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Sidebar -->

                        <button type="submit" class="inflanar-btn mg-top-20"><span>{{__('admin.Search Here')}}</span></button>

                    </form>

                    </div>
                </div>

                <div class="col-lg-9 col-12">
                    <div class="row">

                        @forelse ($services as $index => $service)
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                                <!-- Single property-->
                                <div class="inflanar-service">
                                    <!-- Property Head-->
                                    <div class="inflanar-service__head">
                                        <img src="{{ asset($service->thumbnail_image) }}" alt="#">
                                        @auth('web')
                                            <div class="inflanar-service__wishlist {{ $service->is_wishlist($service->id) == true ? 'active' : '' }} add_to_wishlist" data-service_id="{{ $service->id }}">
                                                <a href="javascript:;" ><i class="fas fa-heart"></i></a>
                                            </div>
                                        @else
                                            <div class="inflanar-service__wishlist add_to_wishlist" data-service_id="{{ $service->id }}">
                                                <a href="javascript:;" ><i class="fas fa-heart"></i></a>
                                            </div>
                                        @endauth

                                    </div>
                                    <!-- Property Body-->
                                    <div class="inflanar-service__body">
                                        <div class="inflanar-service__top">
                                            @if ($service->category)
                                            <a href="{{ route('services', ['categories[]' => $service->category->slug]) }}" class="inflanar-service__cat"><img src="{{ asset('frontend/img/in-cat-label.svg') }}">{{ $service->category->name }}</a>
                                            @endif

                                            <div class="inflanar-service__price">

                                                {{ currency($service->price) }}
                                            </div>
                                        </div>
                                        <h3 class="inflanar-service__title"><a href="{{ route('service', $service->slug) }}">{{ $service->title }}</a></h3>
                                        <div class="inflanar-service__author">
                                            <div class="inflanar-service__author--info">
                                                @if ($service->influencer)
                                                    <a href="{{ route('influencer', $service->influencer->username) }}"><img src="{{ $service->influencer->image ? asset($service->influencer->image) : asset($setting->default_avatar) }}">{{ $service->influencer->name }}</a>
                                                @endif

                                            </div>

                                            <div class="inflanar-service__author--rating">
                                                @php
                                                    if ($service->total_review > 0) {
                                                        $average = $service->average_rating;

                                                        $int_average = intval($average);

                                                        $next_value = $int_average + 1;
                                                        $review_point = $int_average;
                                                        $half_review=false;
                                                        if($int_average < $average && $average < $next_value){
                                                            $review_point= $int_average + 0.5;
                                                            $half_review=true;
                                                        }
                                                    }
                                                @endphp
                                                <div class="inflanar-service__author--star">
                                                    @if ($service->total_review > 0)
                                                        @for ($i = 1; $i <=5; $i++)
                                                            @if ($i <= $review_point)
                                                            <span><i class="fa-solid fa-star"></i></span>
                                                            @elseif ($i> $review_point )
                                                                @if ($half_review==true)
                                                                <span><i class="fa-solid fa-star-half-stroke"></i></span>
                                                                    @php
                                                                        $half_review=false
                                                                    @endphp
                                                                @else
                                                                <span><i class="fa-regular fa-star"></i></span>
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    @else
                                                        <span><i class="fa-regular fa-star"></i></span>
                                                        <span><i class="fa-regular fa-star"></i></span>
                                                        <span><i class="fa-regular fa-star"></i></span>
                                                        <span><i class="fa-regular fa-star"></i></span>
                                                        <span><i class="fa-regular fa-star"></i></span>
                                                    @endif

                                                </div>
                                                <div class="inflanar-service__author--label">({{ $service->total_review }})</div>
                                            </div>

                                        </div>
                                        <a class="inflanar-btn-full inflanar-btn-full--v2 mg-top-20" href="{{ route('booking-service', $service->slug) }}">{{__('admin.Book Now')}}</a>
                                    </div>
                                </div>
                                <!-- End Single property-->
                            </div>
                        @empty
                        <div class="col-12  text-center ">
                            <img class="sorry-img" src="{{asset('/frontend/img/empty-service.png')}}" >
                                <h3 class="sorry-text" >{{__('admin.Sorry!! Service not found.')}}</h3>
                                <p class="mb-4">{{__('admin.Whoops... this information is not available for a moment')}}</p>
                                <a href="{{ route('services') }}" class="inflanar-btn inflanar-btn--header"><span>{{__('admin.Back to Service')}}</span></a>
                            </div>
                        @endforelse

                    </div>
                    <div class="row mg-top-50">
                        {{ $services->links('custom_pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features -->

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            let max_amount = "{{ $max_amount }}";
            let req_min_amount = "{{ $req_min_amount }}";
            let req_max_amount = "{{ $req_max_amount }}";
            // Use a different symbol for jQuery UI
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: max_amount,
                values: [req_min_amount, req_max_amount],
                slide: function(event, ui) {

                    $("#amount").val(ui.values[0] + " - " + ui.values[1]);

                    $("#min_amount").val(ui.values[0]);
                    $("#max_amount").val(ui.values[1]);
                }
            });

            $("#amount").val($("#slider-range").slider("values", 0) +
            " - " + $("#slider-range").slider("values", 1));

        });

        })(jQuery);
    </script>
@endsection
