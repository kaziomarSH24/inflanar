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
                            <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.FAQ')}}</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                <li class="active"><a href="javascript:;">{{__('admin.FAQ')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

        <!-- Faq Area -->
    <section class="inflanar-bg-cover pd-top-100 pd-btm-120">
        <div class="container inflanar-container-medium">
            <div class="row inflanar-container-medium__row align-items-center">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="inflanar-accordion accordion accordion-flush" id="inflanar-accordion">
                        <!-- End Single Accordion -->
                        @foreach ($faqs as $index => $faq)
                            <div class="accordion-item inflanar-accordion__single mg-top-20 {{ $index == 0 ? 'active' : '' }}">
                                <h2 class="accordion-header" id="inflanart-{{ $index }}">
                                    <button class="accordion-button collapsed inflanar-accordion__heading" type="button" data-bs-toggle="collapse" data-bs-target="#ac-collapse-{{ $index }}">{{ $faq->question }}</button>
                                </h2>
                                <div id="ac-collapse-{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"  data-bs-parent="#inflanar-accordion">
                                    <div class="accordion-body inflanar-accordion__body">
                                        {!! clean($faq->answer) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- End Single Accordion -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Faq Area -->

      <!-- Testimonials -->
    <section class="inflanar-section-shape16 inflanar-section-bigspace inflanar-bg-cover pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section TItle -->
                    <div class="inflanar-section__head inflanar-section__center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-primary-color m-0" data-aos="fade-in" data-aos-delay="300">
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
                    <div class="swiper-pagination swiper-pagination__testimonial mg-top-10"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonials  -->
@endsection
