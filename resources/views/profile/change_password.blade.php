@extends('layout')
@section('title')
    <title>{{__('admin.Change Password')}}</title>
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
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Change Password')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.Change Password')}}</a></li>
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

                <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content mg-top-30">
                    <div class="inflanar-supports">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-12">
                                <div class="inflanar-supports__password--form">
                                    <form action="{{ route('user.update-password') }}" method="POST">
                                        @csrf
                                        <div class="form-group inflanar-form-input">
                                            <label>{{__('admin.Current Password')}}*</label>
                                            <input class="inflanar-signin__form-input"  id="password-field" type="password" name="current_password">
                                        </div>
                                        <div class="form-group inflanar-form-input mg-top-20">
                                            <label>{{__('admin.New Password')}}*</label>
                                            <input class="inflanar-signin__form-input" placeholder="" id="password-field" type="password" name="password">
                                        </div>
                                        <div class="form-group inflanar-form-input mg-top-20">
                                            <label>{{__('admin.Confirm Password')}}*</label>
                                            <input class="inflanar-signin__form-input" placeholder="" id="password-field" type="password" name="password_confirmation" >
                                        </div>
                                        <div class="inflanar__item-button--group mg-top-50">
                                            <button class="inflanar-btn" type="submit">{{__('admin.Update Password')}}</button>
                                            <a href="" class="inflanar-btn inflanar-btn__cancel"><span>{{__('admin.Cancel')}}</span></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 d-none d-lg-block">
                                <div class="inflanar-signin__welcome inflanar-signin__welcome--password inflanar-bg-cover inflanar-section-shape18">
                                    <img src="{{ asset('frontend/img/in-account-cover.png') }}" alt="#">
                                </div>
                            </div>
                        </div>
                    </div>

                 </div>
            </div>
        </div>
    </div>
</section>
<!-- End Features -->

@endsection
