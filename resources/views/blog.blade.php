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
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Our Blogs')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.Our Blogs')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<!-- Privacy Policy -->
<section class="inflanar-bg-cover inflaner-inner-page pd-top-90 pd-btm-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-12">
                <div class="row">

                    @forelse ($blogs as $index => $blog)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                            <!-- Single Blog -->
                            <div class="inflanar-blog">
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
                        @empty
                        <div class="col-12 text-danger text-center">
                            
                            <img class="sorry-img" src="{{asset('/frontend/img/empty-service.png')}}" >
                                <h3 class="sorry-text" >{{__('admin.Blog not found!')}}</h3>
                                <p class="mb-4">{{__('admin.Whoops... this information is not available for a moment')}}</p>
                                <a href="{{ route('blogs') }}" class="inflanar-btn inflanar-btn--header"><span>{{__('admin.Back to blog')}}</span></a>
                        </div>
                    @endforelse
                </div>
                <div class="row mg-top-50">
                    {{ $blogs->links('custom_pagination') }}
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-12">
                <div class="inflanar-blog-sidebar">

                    <!-- Single Sidebar -->
                    <div class="inflanar-blog-sidebar__single mg-top-30">
                        <h4 class="inflanar-service-sidebar__title m-0">{{__('admin.Search')}}</h4>
                        <!-- Inflanar Search -->
                        <div class="inflanar-search-form inflanar-search-form__service mg-top-10">
                            <form class="inflanar-search-form__form" action="">
                                <input type="text" placeholder="{{__('admin.Search')}}" name="search" value="{{ request()->get('search') }}">
                                <button type="submit" class="inflanar-btn inflanar-btn--search"><img src="{{ asset('frontend/img/in-search-white.svg') }}"></button>
                            </form>
                        </div>
                        <!-- End Inflanar Search -->
                    </div>

                    <!-- Blog Single Sidebar -->
                    <div class="inflanar-blog-sidebar__single recent-post mg-top-30">
                        <h4 class="inflanar-service-sidebar__title m-0">{{__('admin.Popular Post')}}</h4>
                         <!-- Sidebar Post -->
                        @foreach ($popular_blogs as $popular_blog)
                            <div class="inflanar-sidebar__post">
                                <div class="inflanar-sidebar__img"><img src="{{ asset($popular_blog->image) }}" alt="#"></div>
                                <div class="inflanar-sidebar__content">
                                    <h5 class="inflanar-sidebar__content--title"><a href="{{ route('blog', $popular_blog->slug) }}">{{ $popular_blog->title }}</a></h5>
                                    <div class="inflanar-sidebar__content--date"><img src="{{ asset('frontend/img/in-calendar-icon2.svg') }}" alt="#">{{ $popular_blog->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                        @endforeach
                        <!-- End Sidebar Post -->

                   </div>

                   <!-- Blog Single Sidebar -->
                   <div class="inflanar-blog-sidebar__single mg-top-30">
                      <h4 class="inflanar-service-sidebar__title m-0">{{__('admin.Blog Categories')}}</h4>
                      <ul class="inflanar-sidebar__category list-none">
                        @foreach ($categories as $category)
                        <li><a href="{{ route('blogs', ['category' => $category->slug]) }}">{{ $category->name }}<span>({{ $category->total_blog }})</span></a></li>
                        @endforeach
                      </ul>
                   </div>

                </div>

            </div>

        </div>
    </div>
</section>
<!-- End Privacy Policy -->

@endsection
