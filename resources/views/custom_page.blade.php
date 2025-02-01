@extends('layout')
@section('title')
    <title>{{ $custom_page->page_name }}</title>
    <meta name="title" content="{{ $custom_page->page_name }}">
    <meta name="description" content="{{ $custom_page->page_name }}">
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
                            <h2 class="inflanar-breadcrumb__title m-0">{{ $custom_page->page_name }}</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                <li class="active"><a href="javascript:;">{{ $custom_page->page_name }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <!-- Privacy Policy -->
    <section class="inflanar-bg-cover pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inflanar-page-content">
                        {!! clean($custom_page->description) !!}
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Privacy Policy -->

@endsection
