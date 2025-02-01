@extends('layout')
@section('title')
    <title>{{__('admin.Dashboard')}}</title>
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
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Dashboard')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.Dashboard')}}</a></li>
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
        <div class="inflanar-personals">
            <div class="row">
                @include('profile.sidebar')
                <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                            <!-- Single Statics Box -->
                            <div class="inflanar-pdbox">
                                <div class="inflanar-pdbox__icon">
                                    <img src="{{ asset('frontend/img/in-dicon.svg') }}">
                                </div>
                                <div class="inflanar-pdbox__content">
                                    <h4 class="inflanar-pdbox__title">
                                        <span>{{__('admin.Active Order')}}</span> {{ $active_order }}
                                    </h4>
                                </div>
                            </div>
                            <!-- End Single Statics Box -->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                            <!-- Single Statics Box -->
                            <div class="inflanar-pdbox inflanar-pdbox__2">
                                <div class="inflanar-pdbox__icon">
                                    <img src="{{ asset('frontend/img/in-dicon3.svg') }}">
                                </div>
                                <div class="inflanar-pdbox__content">
                                    <h4 class="inflanar-pdbox__title">
                                        <span>{{__('admin.Completed Order')}}</span> {{ $complete_order }}
                                    </h4>
                                </div>
                            </div>
                            <!-- End Single Statics Box -->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                            <!-- Single Statics Box -->
                            <div class="inflanar-pdbox inflanar-pdbox__3">
                                <div class="inflanar-pdbox__icon">
                                    <img src="{{ asset('frontend/img/in-dicon2.svg') }}">
                                </div>
                                <div class="inflanar-pdbox__content">
                                    <h4 class="inflanar-pdbox__title">
                                        <span>{{__('admin.Cancel Order')}}</span> {{ $cancel_order }}
                                    </h4>
                                </div>
                            </div>
                            <!-- End Single Statics Box -->
                        </div>
                    </div>

                    <div class="inflanar-profile-info mg-top-30">
                        <div class="inflanar-profile-info__head">
                            <h3 class="inflanar-profile-info__heading">{{__('admin.Personal Information')}}</h3>
                        </div>
                        <ul class="inflanar-profile-info__list inflanar-dflex-column list-none">
                            <li class="inflanar-dflex">
                                <h4 class="inflanar-profile-info__title">{{__('admin.Name')}} :</h4>
                                <p class="inflanar-profile-info__text">{{ html_decode($user->name) }}</p>
                            </li>

                            <li class="inflanar-dflex">
                                <h4 class="inflanar-profile-info__title">{{__('admin.Designation')}} :</h4>
                                <p class="inflanar-profile-info__text">{{ html_decode($user->designation) }}</p>
                            </li>


                            <li class="inflanar-dflex">
                                <h4 class="inflanar-profile-info__title">{{__('admin.Email')}} :</h4>
                                <p class="inflanar-profile-info__text">{{ html_decode($user->email) }}</p>
                            </li>
                            <li class="inflanar-dflex">
                                <h4 class="inflanar-profile-info__title">{{__('admin.Phone')}} :</h4>
                                <p class="inflanar-profile-info__text">{{ html_decode($user->phone) }}</p>
                            </li>

                            <li class="inflanar-dflex">
                                <h4 class="inflanar-profile-info__title">Address :</h4>
                                <p class="inflanar-profile-info__text">{{ html_decode($user->address) }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Features -->

@endsection
