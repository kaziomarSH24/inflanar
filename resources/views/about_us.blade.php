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
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.About Us')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.About Us')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->


		<!-- Features -->
		<section class="pd-top-120 pd-btm-120">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 col-12">
							<div class="row">
								<div class="col-12">
									<!-- Section TItle -->
									<div class="inflanar-section__head inflanar-section__center mg-btm-20">
										<span class="inflanar-section__badge inflanar-primary-color m-0" data-aos="fade-in" data-aos-delay="300">
											<span>{{ $home_page->feature_title }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
										</span>
										<h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->feature_header }}</h2>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-6 col-6 mg-top-30" data-aos="fade-in" data-aos-delay="400">
									<!-- Features Single -->
									<div class="inflanar-features-list__single">
										<div class="inflanar-features-list__head">
											<div class="inflanar-features-list__first">
												<div class="inflanar-features-list__icon ">
													<img src="{{ asset($our_feature->icon1) }}" alt="#">
												</div>
											</div>
										</div>
										<div class="inflanar-features-list__body">
											<h4 class="inflanar-features-list__title">{{ $our_feature->title1 }}</h4>
											<p class="inflanar-features-list__text">{{ $our_feature->description1 }}</p>
										</div>
									</div>
									<!-- End Features Single -->
								</div>
								<div class="col-lg-3 col-md-6 col-6 mg-top-30" data-aos="fade-in" data-aos-delay="600">
									<!-- Features Single -->
									<div class="inflanar-features-list__single">
										<div class="inflanar-features-list__head">
											<div class="inflanar-features-list__first">
												<div class="inflanar-features-list__icon inflanar-scolor-bg">
													<img src="{{ asset($our_feature->icon2) }}" alt="#">
												</div>
											</div>
										</div>
										<div class="inflanar-features-list__body">
											<h4 class="inflanar-features-list__title">{{ $our_feature->title2 }}</h4>
											<p class="inflanar-features-list__text">{{ $our_feature->description2 }}</p>
										</div>
									</div>
									<!-- End Features Single -->
								</div>
								<div class="col-lg-3 col-md-6 col-6 mg-top-30" data-aos="fade-in" data-aos-delay="800">
									<!-- Features Single -->
									<div class="inflanar-features-list__single">
										<div class="inflanar-features-list__head">
											<div class="inflanar-features-list__first">
												<div class="inflanar-features-list__icon inflanar-tcolor-bg">
													<img src="{{ asset($our_feature->icon3) }}" alt="#">
												</div>
											</div>
										</div>
										<div class="inflanar-features-list__body">
											<h4 class="inflanar-features-list__title">{{ $our_feature->title3 }}</h4>
											<p class="inflanar-features-list__text">{{ $our_feature->description3 }}</p>
										</div>
									</div>
									<!-- End Features Single -->
								</div>
								<div class="col-lg-3 col-md-6 col-6 mg-top-30" data-aos="fade-in" data-aos-delay="1000">
									<!-- Features Single -->
									<div class="inflanar-features-list__single">
										<div class="inflanar-features-list__head">
											<div class="inflanar-features-list__first">
												<div class="inflanar-features-list__icon inflanar-ylcolor-bg">
													<img src="{{ asset($our_feature->icon4) }}" alt="#">
												</div>
											</div>
										</div>
										<div class="inflanar-features-list__body">
											<h4 class="inflanar-features-list__title">{{ $our_feature->title4 }}</h4>
											<p class="inflanar-features-list__text">{{ $our_feature->description4 }}</p>
										</div>
									</div>
									<!-- End Features Single -->
								</div>
							</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Features -->

		<!-- About US -->
		<section class="inflanar-section-shape15 inflanar-bg-cover pd-top-90 pd-btm-120 inflanar-section-shape2">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12">
						<div class="inflanar-about__row inflanar-row-gap">
							<!-- About Image -->
							<div class="inflanar-about__img mg-top-30">
								<img src="{{ asset($about_us->about_image) }}" alt="#">
							</div>
							<!-- About Content -->
							<div class="inflanar-about__content mg-top-30" data-aos="fade-in" data-aos-delay="300">

								<div class="inflanar-section__head mg-btm-20">
									<span class="inflanar-section__badge inflanar-primary-color m-0">
										<span>{{ $about_us->header }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
									</span>
									<h2 class="inflanar-section__title inflanar-section__title--medium  mg-btm-20" data-aos="fade-in" data-aos-delay="400">{{ $about_us->title }}</h2>
									<p>{!! clean($about_us->description) !!}</p>
								</div>

								<a href="{{ route("contact-us") }}" class="inflanar-btn"><span>{{__('admin.Contact Us')}}</span></a>

								<div class="inflanar-ceo">
									<div class="inflanar-ceo__author">
										<img src="{{ asset($about_us->ceo_avatar) }}">
										<h4 class="inflanar-ceo__title">{{ $about_us->ceo_name }} <span>{{ $about_us->ceo_designation }} </span></h4>
									</div>
									<div class="inflanar-ceo__sign">
										<img src="{{ asset($about_us->ceo_signeture) }}">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End About US -->

		<!-- Services -->
		<section class="pd-top-120 pd-btm-120">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- Section TItle -->
						<div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
							<span class="inflanar-section__badge  inflanar-primary-color m-0" data-aos="fade-in" data-aos-delay="300">
								<span>{{ $home_page->working_title }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
										</span>
								<h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->working_header }}</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="200">
						<!-- Single Card-->
						<div class="inflanar-hcard inflanar-hcard--one">
							<div class="inflanar-hcard__img">
								<img src="{{ asset($working_proccess->home1_image1) }}" alt="#">
							</div>
							<div class="inflanar-hcard__content">
								<div class="inflanar-hcard__line"><img src="{{ asset('frontend/img/in-line-shape1.svg') }}"></div>
								<h4 class="inflanar-hcard__label">
									<span>{{__('admin.Step')}}</span>
									<b>1</b>
								</h4>
								<h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title1 }}</h4>
								<p class="inflanar-hcard__text">{{ $working_proccess->home1_description1 }}</p>
							</div>
						</div>
						<!-- End Single Card-->
					</div>
					<div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
						<!-- Single Card-->
						<div class="inflanar-hcard inflanar-hcard--two">
							<div class="inflanar-hcard__content inflanar-hcard__content__two">
								<h4 class="inflanar-hcard__label">
									<span>{{__('admin.Step')}}</span>
									<b>2</b>
								</h4>
								<h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title2 }}</h4>
								<p class="inflanar-hcard__text">{{ $working_proccess->home1_description2 }}</p>
								<div class="inflanar-hcard__line"><img src="{{ asset('frontend/img/in-line-shape2.svg') }}"></div>
							</div>
							<div class="inflanar-hcard__img">
								<img src="{{ asset($working_proccess->home1_image2) }}" alt="#">
							</div>
						</div>
						<!-- End Single Card-->
					</div>
					<div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="600">
						<!-- Single Card-->
						<div class="inflanar-hcard inflanar-hcard--one">
							<div class="inflanar-hcard__img">
								<img src="{{ asset($working_proccess->home1_image3) }}" alt="#">
							</div>
							<div class="inflanar-hcard__content">
								<div class="inflanar-hcard__line inflanar-hcard__line--v2"><img src="{{ asset('frontend/img/in-line-shape3.svg') }}"></div>
								<h4 class="inflanar-hcard__label">
									<span>{{__('admin.Step')}}</span>
									<b>3</b>
								</h4>
								<h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title3 }}</h4>
								<p class="inflanar-hcard__text">{{ $working_proccess->home1_description3 }}</p>
							</div>
						</div>
						<!-- End Single Card-->
					</div>
					<div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="800">
						<!-- Single Card-->
						<div class="inflanar-hcard inflanar-hcard--two">
							<div class="inflanar-hcard__content inflanar-hcard__content__two">
								<h4 class="inflanar-hcard__label">
									<span>{{__('admin.Step')}}</span>
									<b>4</b>
								</h4>
								<h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title4 }}</h4>
								<p class="inflanar-hcard__text">{{ $working_proccess->home1_description4 }}</p>
								<div class="inflanar-hcard__line inflanar-hcard__line--v3"><img src="{{ asset('frontend/img/in-line-shape2.svg') }}"></div>
							</div>
							<div class="inflanar-hcard__img">
								<img src="{{ asset($working_proccess->home1_image4) }}" alt="#">
							</div>
						</div>
						<!-- End Single Card-->
					</div>
				</div>
			</div>
		</section>
		<!-- End Services -->

		<!-- Brands -->
		<section>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="inflanar-brands inflanar-bg-cover inflanar-section-shape9">
							<div class="row  align-items-center inflanar-row-gap-80">
								<div class="col-lg-6 col-12 mg-top-30">
									<!-- Section TItle -->
									<div class="inflanar-section__head inflanar-section__head--brands">
										<h2 class="inflanar-section__title mg-btm-10">{!! strip_tags(clean($home_page->partner_title),'<span>') !!} </h2>
										<p>{{ $home_page->partner_description }}</p>
										<div class="inflanar-brands-btn mg-top-40">
											<a href="{{ route('contact-us') }}" class="inflanar-btn inflanar-btn__big"><span>{{__('admin.Contact Us')}}</span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="row">
                                        @foreach ($partners as $partner)
                                            <div class="col-lg-4 col-md-4 col-6 mg-top-30">
                                                <div class="brands__single">
                                                    <a href="{{ $partner->link ? $partner->link : 'javascript:;' }}"><img src="{{ asset($partner->logo) }}"></a>
                                                </div>
                                            </div>
                                        @endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Brands -->

		<!-- Funfacts -->
		<section class="pd-top-90 pd-btm-120">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 col-12">
						<div class="row">
							<div class="col-xl-3 col-lg-6 col-md-6 col-12 mg-top-30" data-aos="fade-in" data-aos-delay="300">
								<!-- Fun Fact Sinlge -->
								<div class="funfacts__card funfacts__card--gr1">
									<div class="funfacts__icon">
                                        <img src="{{ asset($home_page->facebook_image) }}">
                                    </div>
                                    <div class="funfacts__number">
                                        <h4 class="funfacts__title"><b>{{ $home_page->facebook_follower }} </b><span>{{__('admin.Followers')}}</span></h4>
                                    </div>
								</div>
								<!-- End Fun Fact Sinlge -->
							</div>
							<div class="col-xl-3 col-lg-6 col-md-6 col-12 mg-top-30" data-aos="fade-in" data-aos-delay="500">
								<!-- Fun Fact Sinlge -->
								<div class="funfacts__card funfacts__card--gr2">
									<div class="funfacts__icon">
                                        <img src="{{ asset($home_page->twitter_image) }}">
                                    </div>
                                    <div class="funfacts__number">
                                        <h4 class="funfacts__title"><b>{{ $home_page->twitter_follower }} </b><span>{{__('admin.Followers')}}</span></h4>
                                    </div>
								</div>
								<!-- End Fun Fact Sinlge -->
							</div>
							<div class="col-xl-3 col-lg-6 col-md-6 col-12 mg-top-30" data-aos="fade-in" data-aos-delay="700">
								<!-- Fun Fact Sinlge -->
								<div class="funfacts__card funfacts__card--gr1">
									<div class="funfacts__icon">
                                        <img src="{{ asset($home_page->tiktok_image) }}">
                                    </div>
                                    <div class="funfacts__number">
                                        <h4 class="funfacts__title"><b>{{ $home_page->tiktok_follower }} </b><span>{{__('admin.Followers')}}</span></h4>
                                    </div>
								</div>
								<!-- End Fun Fact Sinlge -->
							</div>
							<div class="col-xl-3 col-lg-6 col-md-6 col-12 mg-top-30" data-aos="fade-in" data-aos-delay="1000">
								<!-- Fun Fact Sinlge -->
								<div class="funfacts__card funfacts__card--gr2">
									<div class="funfacts__icon">
                                        <img src="{{ asset($home_page->instagram_image) }}">
                                    </div>
                                    <div class="funfacts__number">
                                        <h4 class="funfacts__title"><b>{{ $home_page->instagram_follower }} </b><span>{{__('admin.Followers')}}</span></h4>
                                    </div>
								</div>
								<!-- End Fun Fact Sinlge -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Funfacts -->

		<!-- Testimonials -->
		<section class="inflanar-section-shape16 inflanar-section-bigspace inflanar-bg-cover pd-top-120 pd-btm-120  inflanar-ohidden">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- Section TItle -->
						<div class="inflanar-section__head inflanar-section__center mg-btm-20">
							<span class="inflanar-section__badge inflanar-primary-color m-0" data-aos="fade-in" data-aos-delay="300">
								<span>{{ $home_page->testimonial_title }}</span> <img src="{{ asset('frontend/img/in-section-vector.svg') }}">
							</span>
							<h2 class="inflanar-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $home_page->testimonial_header }}</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<!-- Testimonial Slider -->
						<div class="swiper mySwiper inflanar-slider-testimonial loading">
							<div class="swiper-wrapper mg-top-30">
                                @foreach ($testimonials as $index => $testimonial)
                                    <div class="swiper-slide mg-btm-30">
                                        <!-- Testimonial Single -->
                                        <div class="inflanar-testimonial">
                                            <!-- Testionial Head -->
                                            <div class="inflanar-testimonial__head">
                                                <div class="inflanar-testimonial__logo">
                                                    <img src="{{ asset($testimonial->logo) }}">
                                                </div>
                                                <!-- Quoute Icon -->
                                                <div class="inflanar-testimonial__quote">
                                                    <img src="{{ asset('frontend/img/in-testi-qoute.svg') }}">
                                                </div>
                                            </div>
                                            <!-- Testimonial Text -->
                                            <p class="inflanar-testimonial__text">{{ $testimonial->comment }}</p>
                                            <div class="inflanar-testimonial__bottom mg-top-40">
                                                <!-- Testimonial Author -->
                                                <div class="inflanar-testimonial__author">
                                                    <img src="{{ asset($testimonial->image) }}" alt="#">
                                                    <div class="inflanar-testimonial__author--info">
                                                        <h5 class="inflanar-testimonial__author--title">{{ $testimonial->name }}</h5>
                                                        <p class="inflanar-testimonial__author--position">{{ $testimonial->designation }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Testimonial Single -->
                                    </div>
                                @endforeach


							</div>
						</div>
						<!-- End Testimonial Slider -->
						<!-- Slider Pagination -->
						<div class="swiper-pagination swiper-pagination--v2 swiper-pagination__testimonial mg-top-10"></div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Testimonials  -->
@endsection
