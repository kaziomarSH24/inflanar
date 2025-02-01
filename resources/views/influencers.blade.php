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
                            <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Businesses')}}</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                <li class="active"><a href="javascript:;">{{__('admin.Businesses')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->


       <!-- Influencers -->
       <section class="inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="row">

                @forelse ($influencers as $index => $influencer)
                    <div class="col-lg-3 col-md-6 col-12 mg-top-30">
                        <!-- Single Influencer-->
                        <div class="inflanar-influencer">
                            <!-- Influencer Head-->
                            <div class="inflanar-influencer__head">
                                <img src="{{ $influencer->image ? asset($influencer->image) : asset($setting->default_avatar) }}" alt="#">
                                <h4 class="inflanar-influencer__title">
                                    <a href="{{ route('influencer', html_decode($influencer->username)) }}">{{ html_decode($influencer->name) }}
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
                                        <span>{{ html_decode($influencer->designation) }}</span>
                                    </a>
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
                                <a class="inflanar-btn-full  mg-top-20" href="{{ route('influencer', html_decode($influencer->username)) }}">{{__('admin.View Profile')}}</a>
                            </div>
                            <!-- End Influencer Body -->
                        </div>
                        <!-- End Single Influencer-->
                    </div>
                @empty
                    <div class="col-12 mg-top-30 text-center text-danger">
                        <h3>{{__('admin.Sorry! Influencer not found.')}}</h3>
                    </div>
                @endforelse
            </div>
            <div class="row mg-top-50">
               {{ $influencers->links('custom_pagination') }}
            </div>
        </div>
    </section>
    <!-- End Influencers -->

@endsection
