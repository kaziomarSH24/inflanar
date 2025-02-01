@extends('layout')
@section('title')
    <title>{{ $blog->seo_title }}</title>
    @php
        $tags = '';
        if($blog->tags){
            foreach (json_decode($blog->tags) as $blog_tag) {
                $tags .= $blog_tag->value.', ';
            }
        }
    @endphp

    <meta name="keywords" content="{{ $tags }}">
    <meta name="title" content="{{ $blog->seo_title }}">
    <meta name="description" content="{{ $blog->seo_description }}">
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


<!-- Blog Single Sidebar -->
<section class="blog-single inflaner-inner-page pd-top-90 pd-btm-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-12 mg-top-30">
                <div class="inflanar-blog-details">
                    <div class="inflanar-blog-details__head">
                        <h1 class="inflanar-blog-content__title">{{ $blog->title }}</h1>
                        <ul class="inflanar-blog__meta list-none inflanar-no-border">
                            <li><img src="{{ asset('frontend/img/in-author-icon.svg') }}">{{__('admin.By')}} <span>Influencer</span></li>
                            <li><img src="{{ asset('frontend/img/in-calendar-icon.svg') }}"> {{ $blog->created_at->format('d M Y') }}</li>
                        </ul>
                        <div class="inflanar-blog__img mg-btm-30">
                            <img src="{{ asset($blog->image) }}" alt="#">
                        </div>
                    </div>
                    <div class="inflanar-blog-details__body">
                        {!! clean($blog->description) !!}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="inflanar-blog-detail__bar">
                                <div class="inflanar-blog-detail__meta">
                                    <h4 class="inflanar-blog-detail__meta--title m-0">Tags:</h4>
                                    <ul class="inflanar-blog-detail__tag list-none">
                                        @if ($blog->tags)
                                            @foreach (json_decode($blog->tags) as $blog_tag)
                                                <li><a href="{{ route('blogs', ['search' => $blog_tag->value]) }}">#{{ $blog_tag->value }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="inflanar-blog-detail__meta">
                                    <h4 class="inflanar-blog-detail__meta--title m-0">Share:</h4>
                                    <ul class="inflanar-social inflanar-social__single">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog', $blog->slug) }}&t={{ $blog->title }}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/share?text={{ $blog->title }}&url={{ route('blog', $blog->slug) }}"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('blog', $blog->slug) }}&title={{ $blog->title }}"><i class="fab fa-linkedin"></i></a></li>
                                        <li><a href="https://www.pinterest.com/pin/create/button/?description={{ $blog->title }}&media=&url={{ route('blog', $blog->slug) }}"><i class="fab fa-pinterest"></i></a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Single Review -->
                        <div class="inflanar-blog-authors mg-top-60">
                            <div class="inflanar-blog-authors__head">
                                <img src="{{ asset($blog->author->image) }}">
                            </div>
                            <div class="inflanar-blog-authors__content">
                                <h4 class="inflanar-blog-authors__title">{{ $blog->author->name }}</h4>
                                <p class="inflanar-blog-authors__text">{{ $blog->author->about_me }}</p>
                            </div>
                            <div class="inflanar-blog-authors__social">
                                <ul class="inflanar-social inflanar-social__author">
                                    @if ($blog->author->facebook)
                                    <li><a href="{{ $blog->author->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif

                                    @if ($blog->author->twitter)
                                    <li><a href="{{ $blog->author->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                    @endif

                                    @if ($blog->author->linkedin)
                                    <li><a href="{{ $blog->author->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
                                    @endif

                                    @if ($blog->author->instagram)
                                    <li><a href="{{ $blog->author->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                    @endif


                                </ul>
                                <span>{{__('admin.Follow On')}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mg-top-60">
                        <div class="inflanar-blog-comments">
                            <h2 class="inflanar-blog-detail__title m-0">{{ $blog_comments->count() }} {{__('admin.Comments')}}</h2>

                            @foreach ($blog_comments as $blog_comment)
                                <!-- Single Review -->
                                <div class="inflanar-testimonial inflanar-testimonial--review inflanar-border mg-top-30">
                                    <!-- Testimonial Text -->
                                    <div class="inflanar-testimonial__bottom">
                                        <!-- Testimonial Author -->
                                        <div class="inflanar-testimonial__author">
                                            <img src="http://www.gravatar.com/avatar" alt="#">
                                            <div class="inflanar-testimonial__author--info">
                                                <h5 class="inflanar-testimonial__author--title">{{ html_decode($blog_comment->name) }}</h5>
                                                <div class="inflanar-testimonial__right">
                                                    <p class="inflanar-testimonial__author--position">{{ $blog_comment->created_at->format('d M Y') }}</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="inflanar-testimonial__text">{{ html_decode($blog_comment->comment) }}</p>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Comments Form -->
                        <div class="inflanar-comments-form inflanar-comments-form--reviews mg-top-60">
                            <h2 class="inflanar-comments-form__title m-0">{{__('admin.Write Your Comment')}}</h2>
                            <form action="{{ route('store-comment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group inflanar-form-input">
                                            <label>{{__('admin.Name')}}*</label>
                                            <input class="ecom-wc__form-input" type="text" name="name" placeholder="{{__('admin.Name')}}" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group inflanar-form-input">
                                            <label>{{__('admin.Email')}}*</label>
                                            <input class="ecom-wc__form-input" type="text" name="email" placeholder="{{__('admin.Email')}}" >
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group inflanar-form-input">
                                            <label>{{__('admin.Comment')}}*</label>
                                            <textarea class="ecom-wc__form-input" name="comment" placeholder="{{__('admin.Write your comment')}}"></textarea>
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
                                        <button type="submit" class="inflanar-btn"><span>{{__('admin.Send Comment')}}</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Comments Form -->
                    </div>
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
<!-- End Blog Single Sidebar -->


@endsection
