@extends('layout')
@section('title')
    <title>{{__('admin.Edit Profile')}}</title>
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
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Edit Profile')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.Edit Profile')}}</a></li>
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
                <div class="col-lg-9 col-md-8 col-12 inflanar-personals__content mg-top-30">
                    <div class="inflanar-supports">
                         <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                             <div class="row">
                                 <div class="col-lg-6 col-md-6 col-12">
                                     <div class="form-group inflanar-form-input mg-top-20">
                                         <label>{{__('admin.Name')}}*</label>
                                         <input class="ecom-wc__form-input" type="text" name="name" placeholder="{{__('admin.Name')}}" value="{{ $user->name }}">
                                     </div>
                                 </div>

                                 <div class="col-lg-6 col-12">
                                     <div class="form-group inflanar-form-input mg-top-20">
                                         <label>{{__('admin.Email')}}*</label>
                                         <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('admin.Email')}}" value="{{ $user->email }}" readonly>
                                     </div>
                                 </div>

                                 <div class="col-lg-6 col-12">
                                     <div class="form-group inflanar-form-input mg-top-20">
                                         <label>{{__('admin.Phone')}}*</label>
                                         <input class="ecom-wc__form-input" type="text" name="phone" placeholder="{{__('admin.Phone')}}" value="{{ $user->phone }}">
                                     </div>
                                 </div>

                                 <div class="col-lg-6 col-12">
                                    <div class="form-group inflanar-form-input mg-top-20">
                                        <label>{{__('admin.Designation')}}</label>
                                        <input class="ecom-wc__form-input" type="text" name="designation" placeholder="{{__('admin.Designation')}}" value="{{ $user->designation }}">
                                    </div>
                                </div>

                                 <div class="col-12">
                                    <div class="form-group inflanar-form-input mg-top-20">
                                        <label>{{__('admin.Address')}}*</label>
                                        <input class="ecom-wc__form-input" type="text" name="address" placeholder="{{__('admin.Address')}}" value="{{ $user->address }}">
                                    </div>
                                </div>

                             </div>
                              <!-- Submit Button -->
                              <div class="form-group mg-top-40">
                                 <button type="submit" class="inflanar-btn"><span>{{__('admin.Update Profile')}}</span></button>
                             </div>
                         </form>
                    </div>

                 </div>
            </div>
        </div>
    </div>
</section>
<!-- End Features -->

@endsection
