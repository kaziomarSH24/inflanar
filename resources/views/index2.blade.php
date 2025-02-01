@extends('layout2')
@section('title')
    <title>{{ $seo_setting->seo_title }}</title>
    <meta name="keywords" content="{{ $seo_setting->seo_keyword }}">
    <meta name="title" content="{{ $seo_setting->seo_title }}">
    <meta name="description" content="{{ $seo_setting->seo_description }}">
@endsection
@section('frontend-content')
    <!-- inflanar Hero -->
    <section id="hero" class="inflanar-hero inflanar-hero--v2 inflanar-section-shape6 inflanar-bg-cover p-relative" >
        <div class="inflanar-hero-social inflanar-hero-social--5 inflanar-anim-shape5"><img src="{{ asset('frontend/img/in-gsocial2.svg') }}"></div>
        <div class="inflanar-hero-social inflanar-hero-social--6 inflanar-anim-shape6"><img src="{{ asset('frontend/img/in-gsocial3.svg') }}"></div>
        <div class="inflanar-hero-social inflanar-hero-social--7 inflanar-anim-shape7"><img src="{{ asset('frontend/img/in-gsocial4.svg') }}"></div>
        <div class="inflanar-hero-social inflanar-hero-social--8 inflanar-anim-shape8"><img src="{{ asset('frontend/img/in-gsocial1.svg') }}"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="inflanar-hero__inside text-center">
                        <div class="inflanar-hero__inner">
                            <!-- Hero Content -->
                            <div class="inflanar-hero__content"  data-aos="fade-up" data-aos-delay="300">
                                <span class="inflanar-hero__sub inflanar-regular-font">{{ $slider->home2_title }}</span>
                                <h1 class="inflanar-hero__title">{!! strip_tags(clean($slider->home2_header),'<span>') !!}</h1>
                            </div>
                            <!-- inflanar Image -->
                            <div class="inflanar-hero__group-img  inflanar-anim-shape5">
                                <img src="{{ asset($slider->home2_feature_image) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End inflanar Hero -->

    <!-- Category List -->
    <section class="pd-top-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section TItle -->
                    <div class="inflanar-section__head inflanar-section__center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-scolor m-0" data-aos="fade-in" data-aos-delay="300">
                            <span>{{ $home_page->category_title }}</span> <img src="{{ asset('frontend/img/in-section-vector2.svg') }}">
                        </span>
                        <h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->category_header }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="200">
                    <div class="inflanar-category">
                        <!-- Single Category -->
                        @foreach ($categories as $category)
                            <a href="{{ route('services', ['categories[]' => $category->slug]) }}" class="inflanar-category__single">
                                <div class="inflanar-category__icon">
                                    <img src="{{ asset($category->icon) }}" alt="#">
                                </div>
                                <div class="inflanar-category__content">
                                    <h4 class="inflanar-category__title">{{ $category->name }}</h4>
                                    <span class="inflanar-category__label">{{ $category->total_service }}+</span>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features -->

    <!-- Influencers -->
    <section class="pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section TItle -->
                    <div class="inflanar-section__head inflanar-section__center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-scolor m-0" data-aos="fade-in" data-aos-delay="300">
                            <span>{{ $home_page->influencer_title }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
							</span>
							<h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->influencer_header }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($influencers as $index => $influencer)
                    <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                        <!-- Single Influencer-->
                        <div class="inflanar-influencer">
                            <!-- Influencer Head-->
                            <div class="inflanar-influencer__head">
                                <img src="{{ $influencer->image ? asset($influencer->image) : asset($setting->default_avatar) }}" alt="#">
                                <h4 class="inflanar-influencer__title">
                                    <a href="{{ route('influencer', html_decode($influencer->username)) }}">
                                        {{ html_decode($influencer->name) }}
                                        @php
                                            $kyc = Modules\Kyc\Entities\KycInformation::where('user_id',$influencer->id)->where('status',1)->first();
                                        @endphp
                                        @if($kyc)
                                            <button class="varified-badge">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z"></path></svg>
                                                </span>
                                            </button>
                                        @endif
                                        <span>{{ html_decode($influencer->designation) }}</span></a>
                                </h4>
                            </div>
                            <!-- Influencer Body -->
                            <div class="inflanar-influencer__body">
                                <div class="inflanar-influencer__follower">
                                    <div class="inflanar-influencer__follower--single">
                                        <b>{{ html_decode($influencer->total_follower) }}</b><span>{{__('admin.Followers')}}</span>
                                    </div>
                                    <div class="inflancer-hborder"></div>
                                    <div class="inflanar-influencer__follower--single in-right">
                                        <b>{{ html_decode($influencer->total_following) }}</b><span>{{__('admin.Following')}}</span>
                                    </div>
                                </div>
                                <a class="inflanar-btn-full inflanar-btn-full--v3  mg-top-20" href="{{ route('influencer', html_decode($influencer->username)) }}">{{__('admin.View Profile')}}</a>
                            </div>
                            <!-- End Influencer Body -->
                        </div>
                        <!-- End Single Influencer-->
                    </div>
                @endforeach
            </div>
            <div class="row mg-top-40" data-aos="fade-up" data-aos-delay="600">
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('influencers') }}" class="inflanar-btn inflanar-btn__secondary inflanar-btn__big "><span>{{__('admin.View All')}}</span></a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Influencers -->

    <!-- Services -->
    <section class="inflanar-section-shape7 inflanar-bg-cover pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section TItle -->
                    <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-scolor m-0" data-aos="fade-in" data-aos-delay="300">
                            <span>{{ $home_page->working_title }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
										</span>
							<h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->working_header }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="200">
                    <!-- Single Card-->
                    <div class="inflanar-hcard inflanar-hcard--one">
                        <div class="inflanar-hcard__img">
                            <img src="{{ asset($working_proccess->home1_image1) }}" alt="#">
                        </div>
                        <div class="inflanar-hcard__content">
                            <div class="inflanar-hcard__line"><img src="{{ asset('frontend/img/in-line-shape4.svg') }}"></div>
                            <h4 class="inflanar-hcard__label">
                                <span>{{__('admin.Step')}}</span>
                                <b class="inflanar-scolor-bg">1</b>
                            </h4>
                            <h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title1 }}</h4>
							<p class="inflanar-hcard__text">{{ $working_proccess->home1_description1 }}</p>
                        </div>
                    </div>
                    <!-- End Single Card-->
                </div>
                <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                    <!-- Single Card-->
                    <div class="inflanar-hcard inflanar-hcard--two">
                        <div class="inflanar-hcard__content inflanar-hcard__content__two">
                            <h4 class="inflanar-hcard__label">
                                <span>{{__('admin.Step')}}</span>
                                <b class="inflanar-scolor-bg">2</b>
                            </h4>
                            <h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title2 }}</h4>
							<p class="inflanar-hcard__text">{{ $working_proccess->home1_description2 }}</p>
                            <div class="inflanar-hcard__line"><img src="{{ asset('frontend/img/in-line-shape5.svg') }}"></div>
                        </div>
                        <div class="inflanar-hcard__img">
                            <img src="{{ asset($working_proccess->home1_image2) }}" alt="#">
                        </div>
                    </div>
                    <!-- End Single Card-->
                </div>
                <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="600">
                    <!-- Single Card-->
                    <div class="inflanar-hcard inflanar-hcard--one">
                        <div class="inflanar-hcard__img">
                            <img src="{{ asset($working_proccess->home1_image3) }}" alt="#">
                        </div>
                        <div class="inflanar-hcard__content">
                            <div class="inflanar-hcard__line inflanar-hcard__line--v2"><img src="{{ asset('frontend/img/in-line-shape6.svg') }}"></div>
                            <h4 class="inflanar-hcard__label">
                                <span>{{__('admin.Step')}}</span>
                                <b class="inflanar-scolor-bg">3</b>
                            </h4>
                            <h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title3 }}</h4>
							<p class="inflanar-hcard__text">{{ $working_proccess->home1_description3 }}</p>
                        </div>
                    </div>
                    <!-- End Single Card-->
                </div>
                <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="800">
                    <!-- Single Card-->
                    <div class="inflanar-hcard inflanar-hcard--two">
                        <div class="inflanar-hcard__content inflanar-hcard__content__two">
                            <h4 class="inflanar-hcard__label">
                                <span>{{__('admin.Step')}}</span>
                                <b class="inflanar-scolor-bg">4</b>
                            </h4>
                            <h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title4 }}</h4>
							<p class="inflanar-hcard__text">{{ $working_proccess->home1_description4 }}</p>
                            <div class="inflanar-hcard__line inflanar-hcard__line--v3"><img src="{{ asset('frontend/img/in-line-shape5.svg') }}"></div>
                        </div>
                        <div class="inflanar-hcard__img">
                            <img src="{{ asset($working_proccess->home1_image4) }}" alt="#">
                        </div>
                    </div>
                    <!-- End Single Card-->
                </div>
            </div>
        </div>
    </section>
    <!-- End Services -->


    <!-- Services -->
    <section class="inflanar-section-shape inflanar-bg-cover pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section TItle -->
                    <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-scolor m-0" data-aos="fade-in" data-aos-delay="300">
                            <span>{{ $home_page->service_title }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
							</span>
							<h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->service_header }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($featured_services as $index => $featured_service)
                    <div class="col-lg-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                        <!-- Single property-->
                        <div class="inflanar-service inflanar-service--v2">
                            <!-- Property Head-->
                            <div class="inflanar-service__head">
                                <img src="{{ asset($featured_service->thumbnail_image) }}" alt="#">
                                @auth('web')
                                    <div class="inflanar-service__wishlist {{ $featured_service->is_wishlist($featured_service->id) == true ? 'active' : '' }} add_to_wishlist" data-service_id="{{ $featured_service->id }}">
                                        <a href="javascript:;" ><i class="fas fa-heart"></i></a>
                                    </div>
                                @else
                                    <div class="inflanar-service__wishlist add_to_wishlist" data-service_id="{{ $featured_service->id }}">
                                        <a href="javascript:;" ><i class="fas fa-heart"></i></a>
                                    </div>
                                @endauth
                                <div class="inflanar-service__price">
                                    {{ currency($featured_service->price) }}
                                </div>
                            </div>
                            <!-- Property Body-->
                            <div class="inflanar-service__body">
                                <h3 class="inflanar-service__title"><a href="{{ route('service', $featured_service->slug) }}">{{ $featured_service->title }}</a></h3>
                                <div class="inflanar-service__author--info">
                                    @if ($featured_service->influencer)
                                        <a href="{{ route('influencer', $featured_service->influencer->username) }}"><img src="{{ $featured_service->influencer->image ? asset($featured_service->influencer->image) : asset($setting->default_avatar) }}">{{ $featured_service->influencer->name }}</a>
                                    @endif

                                </div>
                                <div class="inflanar-service__author">

                                    @if ($featured_service->category)
                                        <a href="{{ route('services', ['categories[]' => $featured_service->category->slug]) }}" class="inflanar-service__cat"><img src="{{ asset('frontend/img/in-cat-label.svg') }}">{{ $featured_service->category->name }}</a>
                                    @endif

                                    <div class="inflanar-service__author--rating">
                                        @php
                                            if ($featured_service->total_review > 0) {
                                                $average = $featured_service->average_rating;

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
                                            @if ($featured_service->total_review > 0)
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
                                        <div class="inflanar-service__author--label">({{ $featured_service->total_review }})</div>
                                    </div>

                                </div>
                                <a class="inflanar-btn-full inflanar-btn-full--v3 mg-top-20" href="{{ route('booking-service', $featured_service->slug) }}">{{__('admin.Book Now')}}</a>
                            </div>
                        </div>
                        <!-- End Single property-->
                    </div>
                @endforeach

            </div>
            <div class="row mg-top-40" data-aos="fade-up" data-aos-delay="600">
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('services') }}" class="inflanar-btn inflanar-btn__secondary  inflanar-btn__big"><span>{{__('admin.View All')}}</span></a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services -->

    <!-- Why Choose  -->
    <section class="inflanar-section-shape8 inflanar-bg-cover pd-top-120 pd-btm-120 inflanar-ohidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-12" data-aos="fade-up" data-aos-delay="200">
                    <!-- Section TItle -->
                    <div class="inflanar-section__head mg-btm-20">
                        <span class="inflanar-section__badge inflanar-scolor m-0" data-aos="fade-in" data-aos-delay="300">
                            <span>{{ $why_choose_us->home2_title }}</span> <img src="{{ asset('frontend/img/in-section-vector2.svg') }}">
                        </span>
                        <h2 class="inflanar-section__title inflanar-section__title--medium" data-aos="fade-in" data-aos-delay="400">{{ $why_choose_us->home2_header }}</h2>
                        <p class="mg-top-20">{{ $why_choose_us->home2_description }}</p>
                    </div>

                    <!-- Single Why Choose -->
                    <div class="inflanar-why-choose mg-top-40">
                        <div class="inflanar-why-choose__icon">
                            <img src="{{ asset('frontend/img/in-why-icon1.svg') }}">
                        </div>
                        <div class="inflanar-why-choose__content">
                            <h4 class="inflanar-why-choose__title">{{ $why_choose_us->home2_item1 }}</h4>
                            <p class="inflanar-why-choose__text">{{ $why_choose_us->home2_des1 }}</p>
                        </div>
                    </div>
                    <!-- End Single Why Choose -->
                    <!-- Single Why Choose -->
                    <div class="inflanar-why-choose mg-top-40">
                        <div class="inflanar-why-choose__icon">
                            <img src="{{ asset('frontend/img/in-why-icon2.svg') }}">
                        </div>
                        <div class="inflanar-why-choose__content">
                            <h4 class="inflanar-why-choose__title">{{ $why_choose_us->home2_item2 }}</h4>
                            <p class="inflanar-why-choose__text">{{ $why_choose_us->home2_des2 }}</p>
                        </div>
                    </div>
                    <!-- End Single Why Choose -->
                    <!-- Single Why Choose -->
                    <div class="inflanar-why-choose mg-top-40">
                        <div class="inflanar-why-choose__icon">
                            <img src="{{ asset('frontend/img/in-why-icon3.svg') }}">
                        </div>
                        <div class="inflanar-why-choose__content">
                            <h4 class="inflanar-why-choose__title">{{ $why_choose_us->home2_item3 }}</h4>
                            <p class="inflanar-why-choose__text">{{ $why_choose_us->home2_des3 }}</p>
                        </div>
                    </div>
                    <!-- End Single Why Choose -->
                </div>
                <div class="col-xl-5 offset-xl-2 col-lg-6 col-md-10 offset-md-1 col-12 d-none d-lg-block">
                    <div class="inflan-why-choose__gorup">
                        <div class="inflanar-why-choose__img">
                            <img src="{{ asset($why_choose_us->home2_image) }}">
                        </div>
                        <div class="inflanar-scard inflanar-scard--1 inflanar-anim-shape8">
                            <img src="{{ asset($why_choose_us->home2_foreground1) }}">
                        </div>
                        <div class="inflanar-scard inflanar-scard--2 inflanar-anim-shape8">
                            <img src="{{ asset($why_choose_us->home2_foreground2) }}">
                        </div>
                        <div class="inflanar-scard inflanar-scard--3 inflanar-anim-shape7">
                            <img src="{{ asset($why_choose_us->home2_icon1) }}">
                        </div>
                        <div class="inflanar-scard inflanar-scard--4 inflanar-anim-shape6">
                            <img src="{{ asset($why_choose_us->home2_icon2) }}">
                        </div>
                        <div class="inflanar-scard inflanar-scard--5 inflanar-anim-shape5">
                            <img src="{{ asset($why_choose_us->home2_icon3) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose -->

    <!-- Testimonials -->
    <section class="pd-top-120 pd-btm-120 inflanar-ohidden">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section TItle -->
                    <div class="inflanar-section__head inflanar-section__center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-scolor  m-0" data-aos="fade-in" data-aos-delay="300">
                            <span>{{ $home_page->testimonial_title }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
							</span>
							<h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->testimonial_header }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Testimonial Slider -->
                    <div class="swiper mySwiper inflanar-slider-testimonial loading">
                        <div class="swiper-wrapper mg-top-30">
                            @foreach ($testimonials as $index => $testimonial)
                                <div class="swiper-slide mg-btm-30">
                                    <!-- Testimonial Single -->
                                    <div class="inflanar-testimonial">
                                        <!-- Testionial Head -->
                                        <div class="inflanar-testimonial__head">
                                            <div class="inflanar-testimonial__logo">
                                                <img src="{{ asset($testimonial->logo) }}">
                                            </div>
                                            <!-- Quoute Icon -->
                                            <div class="inflanar-testimonial__quote">
                                                <img src="{{ asset('frontend/img/in-testi-qoute.svg') }}">
                                            </div>
                                        </div>
                                        <!-- Testimonial Text -->
                                        <p class="inflanar-testimonial__text">{{ $testimonial->comment }}</p>
                                        <div class="inflanar-testimonial__bottom mg-top-40">
                                            <!-- Testimonial Author -->
                                            <div class="inflanar-testimonial__author">
                                                <img src="{{ asset($testimonial->image) }}" alt="#">
                                                <div class="inflanar-testimonial__author--info">
                                                    <h5 class="inflanar-testimonial__author--title">{{ $testimonial->name }}</h5>
                                                    <p class="inflanar-testimonial__author--position">{{ $testimonial->designation }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Testimonial Single -->
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- End Testimonial Slider -->
                    <!-- Slider Pagination -->
                    <div class="swiper-pagination swiper-pagination__second swiper-pagination__testimonial mg-top-10"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonials  -->

    <!-- Brands -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inflanar-brands inflanar-bg-cover inflanar-section-shape9">
                        <div class="row align-items-center  inflanar-row-gap-80">
                            <div class="col-lg-6 col-12 mg-top-30">
                                <!-- Section TItle -->
                                <div class="inflanar-section__head inflanar-section__head--brands">
                                    <h2 class="inflanar-section__title inflanar-section__title__insdie-scolor mg-btm-10">{!! strip_tags(clean($home_page->partner_title),'<span>') !!} </h2>
                                    <p>{{ $home_page->partner_description }}</p>
                                    <div class="inflanar-brands-btn mg-top-40">
                                        <a href="{{ route('contact-us') }}" class="inflanar-btn inflanar-btn__secondary inflanar-btn__big"><span>{{__('admin.Contact Us')}}</span></a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12" data-aos="fade-up" data-aos-delay="400">
                                <div class="row">
                                    @foreach ($partners as $partner)
                                        <div class="col-lg-4 col-md-4 col-6 mg-top-30">
                                            <div class="brands__single">
                                                <a href="{{ $partner->link ? $partner->link : 'javascript:;' }}"><img src="{{ asset($partner->logo) }}"></a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Brands -->

    <!-- Blog Area -->
    <section id="blog" class="blog-area inflanar-bg-cover section-padding">
        <div class="blog-bg-pattern">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Section TItle -->
                        <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
                            <span class="inflanar-section__badge inflanar-scolor m-0" data-aos="fade-in" data-aos-delay="300">
                                <span>{{ $home_page->blog_title }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
                            </span>
                            <h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->blog_header }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($blogs as $index => $blog)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <!-- Single Blog -->
                            <div class="inflanar-blog inflanar-blog--v2">
                                <div class="inflanar-blog__head">
                                    <a href="{{ route('blog', $blog->slug) }}"><img src="{{ asset($blog->image) }}" alt="#"></a>
                                </div>
                                <!-- Blog Content -->
                                <div class="inflanar-blog__content">
                                    <ul class="inflanar-blog__meta list-none">
                                        <li><img src="{{ asset('frontend/img/in-author-icon.svg') }}">{{__('admin.By')}} <span>{{ $blog->author ? $blog->author->name : '' }}</span></li>
                                            <li><img src="{{ asset('frontend/img/in-calendar-icon.svg') }}"> {{ $blog->created_at->format('d M Y') }}</li>
                                    </ul>
                                    <h3 class="inflanar-blog__title"><a href="{{ route('blog', $blog->slug) }}">{{ $blog->title }}</a></h3>
                                </div>
                            </div>
                            <!-- End Single Blog -->
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Area -->
@endsection
