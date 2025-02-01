@extends('layout')
@section('title')
    <title>{{__('admin.Reset Password')}}</title>
@endsection
@section('frontend-content')

    <!-- Sign In -->
    <section class="inflanar-signin pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inflanar-signin__body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="inflanar-signin__logins">
                                    <!-- Login header -->
                                    <div class="inflanar-signin__header mg-btm-10">
                                        <div class="inflanar-signin__heading">
                                            <h4 class="inflanar-signin__title">{{__('admin.Reset Password')}}</h4>
                                            <p class="inflanar-signin__tag">{{__('admin.Please fill out the form below and reset your password.')}}</p>
                                        </div>
                                    </div>
                                    <!-- End Login header -->
                                    <div class="inflanar-signin__inner mg-top-20">
                                        <form method="POST" action="{{ route('reset-password-store', $token) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group inflanar-form-input">
                                                        <label>{{__('admin.Email')}}*</label>
                                                        <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('admin.Email')}}" value="{{ $user->email }}" >
                                                    </div>

                                                    <div class="form-group inflanar-form-input mg-top-20">
                                                        <label>{{__('admin.Password')}}*</label>
                                                        <input class="ecom-wc__form-input" type="password" name="password" placeholder="{{__('admin.Password')}}">
                                                    </div>

                                                    <div class="form-group inflanar-form-input mg-top-20">
                                                        <label>{{__('admin.Confirm Password')}}*</label>
                                                        <input class="ecom-wc__form-input" type="password" name="password_confirmation" placeholder="{{__('admin.Confirm Password')}}">
                                                    </div>

                                                    @if($google_recaptcha->status==1)
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <div class="g-recaptcha" data-sitekey="{{ $google_recaptcha->site_key }}"></div>
                                                        </div>
                                                    @endif

                                                    <!-- Login Button Group -->
                                                    <div class="form-group mg-top-30">
                                                        <button type="submit" class="inflanar-btn"><span>{{__('admin.Send Reset Link')}}</span></button>
                                                    </div>
                                                    <div class="inflanar-signin__bottom">
                                                        <p class="inflanar-signin__text mg-top-20">{{__('admin.Go to login page')}}  <a href="{{ route('login') }}">{{__('admin.Login')}}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 d-none d-lg-block">
                                <div class="inflanar-signin__welcome inflanar-bg-cover inflanar-section-shape18">
                                    <img src="{{ asset($setting->login_page_bg) }}" alt="#">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Sign In -->
@endsection
