@extends('layout')
@section('title')
    <title>{{__('admin.Register')}}</title>
@endsection
@section('frontend-content')

<!-- Sign In -->
<section class="inflanar-signin mg-top-70 pd-top-120 pd-btm-120">
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
                                        <h4 class="inflanar-signin__title">{{__('admin.SignUp')}}</h4>
                                        <p class="inflanar-signin__tag">{{__('admin.Welcome to Inflanar')}}</p>
                                    </div>
                                    <div class="inflanar-signin__heading__options">
                                        <!--Tab Nav -->
                                        <div class="list-group inflanar-signin__options" id="list-tab" role="tablist">
                                            <a class="list-group-item active" data-bs-toggle="list" href="#in-tab11" role="tab">
                                                <span>{{__('admin.Influencer')}}</span>
                                            </a>
                                            <a class="list-group-item" data-bs-toggle="list" href="#in-tab12" role="tab">
                                                <span>{{__('admin.Business')}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Login header -->

                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Single Tab -->
                                    <div class="tab-pane fade active show" id="in-tab11" role="tabpanel">
                                        <div class="inflanar-signin__inner">
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Name')}}*</label>
                                                            <input class="ecom-wc__form-input" type="text" name="name" placeholder="{{__('admin.Name')}}" >
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Email')}}*</label>
                                                            <input class="ecom-wc__form-input" type="text" name="email" placeholder="{{__('admin.Email')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Password')}}*</label>
                                                            <input class="ecom-wc__form-input" type="password" name="password" placeholder="{{__('admin.Password')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Confirm Password')}}*</label>
                                                            <input class="ecom-wc__form-input" type="password" name="password_confirmation" placeholder="{{__('admin.Confirm Password')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group mg-top-20">
                                                            <div class="inflanar-signin__check-inline">
                                                                <div class="inflanar-signin__checkbox">
                                                                    <div class="inflanar-signin__checkbox--group">
                                                                        <input required class="inflanar-signin__form-check" id="checkbox" name="checkbox" type="checkbox">
                                                                        <label for="checkbox">{{__('admin.I agree with the')}}  <a href="{{ route('terms-conditions') }}" class="forgot-pass">{{__('admin.Terms and Conditions')}}</a></label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        @if($google_recaptcha->status==1)
                                                            <div class="col-12">
                                                                <div class="form-group inflanar-form-input mg-top-20">
                                                                    <div class="g-recaptcha" data-sitekey="{{ $google_recaptcha->site_key }}"></div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <!-- Login Button Group -->
                                                        <div class="form-group mg-top-40">
                                                            <button type="submit" class="inflanar-btn"><span>{{__('admin.Create Account')}}</span></button>
                                                        </div>
                                                        <div class="inflanar-signin__bottom mg-top-20">
                                                            <p class="inflanar-signin__text">{{__('admin.Alread have an account?')}}  <a href="{{ route('login') }}">{{__('admin.Login')}}</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Single Tab -->
                                    <!-- Single Tab -->
                                    <div class="tab-pane fade" id="in-tab12" role="tabpanel">
                                        <div class="inflanar-signin__inner">
                                            <form action="{{ route('influencer-register') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Name')}}*</label>
                                                            <input class="ecom-wc__form-input" type="text" name="name" placeholder="{{__('admin.Name')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Designation')}}*</label>
                                                            <input class="ecom-wc__form-input" type="text" name="designation" placeholder="{{__('admin.Designation')}}">
                                                        </div>
                                                    </div>



                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Email')}}*</label>
                                                            <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('admin.Email Address')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Phone')}}*</label>
                                                            <input class="ecom-wc__form-input" type="text" name="phone" placeholder="{{__('admin.Phone Number')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Country')}}*</label>
                                                            <input class="ecom-wc__form-input" type="text" name="country" placeholder="{{__('admin.Country')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Address')}}*</label>
                                                            <input class="ecom-wc__form-input" type="text" name="address" placeholder="{{__('admin.Type Address')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Password')}}*</label>
                                                            <input class="ecom-wc__form-input" type="password" name="password" placeholder="{{__('admin.Password')}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group inflanar-form-input mg-top-20">
                                                            <label>{{__('admin.Confirm Password')}}*</label>
                                                            <input class="ecom-wc__form-input" type="password" name="password_confirmation" placeholder="{{__('admin.Confirm Password')}}">
                                                        </div>
                                                    </div>



                                                    <div class="col-12">
                                                        <div class="form-group mg-top-20">
                                                            <div class="inflanar-signin__check-inline">
                                                                <div class="inflanar-signin__checkbox">
                                                                    <div class="inflanar-signin__checkbox--group">
                                                                        <input required class="inflanar-signin__form-check" id="checkbox1" name="checkbox" type="checkbox">
                                                                        <label for="checkbox1">{{__('admin.I agree with the')}}  <a href="{{ route('terms-conditions') }}" class="forgot-pass">{{__('admin.Terms and Conditions')}}</a></label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        @if($google_recaptcha->status==1)
                                                            <div class="col-12">
                                                                <div class="form-group inflanar-form-input mg-top-20">
                                                                    <div class="g-recaptcha" data-sitekey="{{ $google_recaptcha->site_key }}"></div>
                                                                </div>
                                                            </div>
                                                        @endif


                                                        <div class="form-group mg-top-40">
                                                            <button type="submit" class="inflanar-btn"><span>{{__('admin.Create Account')}}</span></button>
                                                        </div>

                                                        <div class="inflanar-signin__bottom mg-top-20">
                                                            <p class="inflanar-signin__text">{{__('admin.Dont’t have an aceount ?')}}  <a href="{{ route('login') }}">{{__('admin.Login')}}</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Single Tab -->
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
