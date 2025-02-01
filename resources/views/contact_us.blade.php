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
                            <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Contact Us')}}</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                <li class="active"><a href="javascript:;">{{__('admin.Contact Us')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <!-- Blog Single Sidebar -->
    <section class="inflanar-contact inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-12 mg-top-30">
                    <div class="inflanar-contact__box inflanar-bg-cover inflanar-section-shape17">
                        <!-- Contact heading -->
                        <div class="inflanar-contact__heading">
                            <h2 class="inflanar-contact-form__title m-0">{{__('admin.Contact Info')}}</h2>
                            <p class="inflanar-contact__htext">{{__('admin.Our Contact Info and we will respond as soon as possible')}}</p>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-6 col-12 mg-top-30">
                                <!-- Single Contact -->
                                <div class="inflanar-contact__single">
                                    <div class="inflanar-contact__icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="inflanar-contact__content">
                                        <p class="inflanar-contact__title">
                                            {!! nl2br($contact_us->phone) !!}
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Contact -->
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6 col-12 mg-top-30">
                                <!-- Single Contact -->
                                <div class="inflanar-contact__single">
                                    <div class="inflanar-contact__icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="inflanar-contact__content">
                                        <p class="inflanar-contact__title">
                                            {!! nl2br($contact_us->email) !!}
                                        </p>

                                    </div>
                                </div>
                                <!-- End Single Contact -->
                            </div>
                            <div class="col-12 mg-top-30">
                                <!-- Single Contact -->
                                <div class="inflanar-contact__single">
                                    <div class="inflanar-contact__icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="inflanar-contact__content">
                                        <p class="inflanar-contact__title">
                                            {!! nl2br($contact_us->address) !!}
                                        </p>

                                    </div>
                                </div>
                                <!-- End Single Contact -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-12 mg-top-30">
                        <!-- Comments Form -->
                        <div class="inflanar-comments-form inflanar-comments-form--reviews">
                        <h3 class="inflanar-contact-form__title m-0">{{__('admin.Feel Free to Get in Touch')}}</h3>
                        <form action="{{ route('store-contact-message') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>{{__('admin.Name')}}*</label>
                                        <input class="ecom-wc__form-input" type="text" name="name" placeholder="{{__('admin.Name')}}" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>{{__('admin.Phone')}}</label>
                                        <input class="ecom-wc__form-input" type="text" name="phone" placeholder="{{__('admin.Phone')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>{{__('admin.Email')}}*</label>
                                        <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('admin.Email')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>{{__('admin.Subject')}}*</label>
                                        <input class="ecom-wc__form-input" type="text" name="subject" placeholder="{{__('admin.Subject')}}" >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>{{__('admin.Message')}}*</label>
                                        <textarea class="ecom-wc__form-input" name="message" placeholder="{{__('admin.Write your message')}}"></textarea>
                                    </div>
                                </div>

                                @if($google_recaptcha->status==1)
                                    <div class="col-12">
                                        <div class="form-group inflanar-form-input">
                                            <div class="g-recaptcha" data-sitekey="{{ $google_recaptcha->site_key }}"></div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12 mg-top-20">
                                    <button type="submit" class="inflanar-btn"><span>{{__('admin.Send Message')}}</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Comments Form -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Single Sidebar -->

    <div class="inflanar-gmap">
        {!! $contact_us->map_code !!}
    </div>


@endsection
