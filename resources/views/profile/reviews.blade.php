@extends('layout')
@section('title')
    <title>{{__('admin.Reviews')}}</title>
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
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Reviews')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.Reviews')}}</a></li>
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

                <div class="col-lg-7 col-md-8 col-12  inflanar-personals__content">
                    <!-- Single Review -->
                    @foreach ($reviews as $review)
                        <div class="inflanar-testimonial inflanar-testimonial--review inflanar-border mg-top-30">
                            <!-- Testimonial Text -->
                            <div class="inflanar-testimonial__bottom">
                                <!-- Testimonial Author -->
                                <div class="inflanar-testimonial__author">
                                    <img src="{{ asset($review->service->thumbnail_image) }}" alt="#">
                                    <div class="inflanar-testimonial__author--info">
                                        <h5 class="inflanar-testimonial__author--title"><a href="{{ route('service', $review->service->slug) }}">{{ $review->service->title }}</a></h5>
                                        <p class="inflanar-testimonial__author--position">{{ $review->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="inflanar-rating--main mg-btm-15">
                                    <!-- Author Rating -->
                                    <ul class="inflanar-rating list-none">
                                        @for ($i = 1; $i <= 5 ; $i++)
                                            @if ($i <= $review->rating)
                                                <li><i class="fa-solid fa-star"></i></li>
                                            @else
                                                <li><i class="fa-regular fa-star"></i></li>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                            <p class="inflanar-testimonial__text">{{ html_decode($review->comment) }}</p>
                        </div>
                   @endforeach


                    <!-- Pagination -->
                    <div class="inflanar-supports__bgroup mg-top-40">
                        {{ $reviews->links('custom_pagination') }}
                    </div>
                    <!-- End Pagination -->

               </div>

            </div>
        </div>
    </div>
</section>
<!-- End Features -->

@endsection
