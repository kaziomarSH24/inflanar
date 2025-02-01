
<!DOCTYPE html>
<html class="no-js" lang="ZXX">
	<head>
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		@yield('title')

		<!-- Fav Icon -->
		<link rel="icon" href="{{ asset($setting->favicon) }}">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
		<!-- Jquery UI CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
		<!-- Animate CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
		<!-- AOS CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/aos.min.css') }}">
		<!-- Fontawesome -->
		<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome-all.min.css') }}">
		<!-- Swiper Slider CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/swiper-slider.min.css') }}">
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/select2-min.css') }}">
		<!-- Data Tables -->
		<link rel="stylesheet" href="{{ asset('frontend/css/datatables.min.css') }}">
		<!-- Video Popup -->
		<link rel="stylesheet" href="{{ asset('frontend/css/video-popup.min.css') }}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/theme-default.css') }}">

        @if (Session::get('lang_dir'))
            @if (Session::get('lang_dir') == 'right_to_left')
                <link rel="stylesheet" href="{{ asset('frontend/rtl.css') }}">
            @else
                <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
            @endif
        @else
            <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
        @endif


        <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

        <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script src="{{ asset('frontend/js/flatpickr.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('frontend/css/flatpickr.min.css') }}">

        @if ($google_analytic->status == 1)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $google_analytic->analytic_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $google_analytic->analytic_id }}');
        </script>
        @endif

        @if ($facebook_pixel->status == 1)
            <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $facebook_pixel->app_id }}');
            fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id={{ $facebook_pixel->app_id }}&ev=PageView&noscript=1"
        /></noscript>
        @endif

	</head>

    @if (Session::get('lang_dir'))
        @if (Session::get('lang_dir') == 'right_to_left')
            <body class="rtl-theme">
        @else
            <body>
        @endif
    @else
        <body>
    @endif

        @if ($setting->preloader_status == 'enable')
            <div id="loading">
                <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                    <div class="object" id="object_five"></div>
                </div>
                </div>
            </div>
        @endif

		<!-- End Preloader -->

		<!-- Mobile Menu Modal -->
		<div class="modal offcanvas-modal inflanar-mobile-menu fade" id="offcanvas-modal">
			<div class="modal-dialog offcanvas-dialog">
				<div class="modal-content">
					<div class="modal-header offcanvas-header">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<i class="fas fa-remove"></i>
						</button>
					</div>
					<!-- offcanvas-logo-start -->
					 <div class="offcanvas-logo">
						<a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}" alt="#"></a>
					</div>
					<!-- offcanvas-logo-end -->
					<!-- offcanvas-menu start -->
					<nav id="offcanvas-menu" class="offcanvas-menu">
						<!-- Main Menu -->
						<ul class="nav-menu menu navigation list-none">
							@if ($setting->selected_theme == 'all_theme')
                            <li class="menu-item-has-children active"><a href="{{ route('home', ['theme' => 'one']) }}">{{__('admin.Home')}}</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('home', ['theme' => 'one']) }}">{{__('admin.Homepage V1')}}</a></li>
                                    <li><a href="{{ route('home', ['theme' => 'two']) }}">{{__('admin.Homepage V2')}}</a></li>
                                    <li><a href="{{ route('home', ['theme' => 'three']) }}">{{__('admin.Homepage V3')}}</a></li>
                                </ul>
                            </li>
                            @else
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            @endif

							<li><a href="{{ route('about-us') }}">{{__('admin.About Us')}}</a></li>

							<li><a href="{{ route('influencers') }}">{{__('admin.Influencers')}}</a></li>

                            <li><a href="{{ route('services') }}">{{__('admin.Services')}}</a></li>

							<li class="menu-item-has-children"><a href="#">{{__('admin.Pages')}}</a>
                                <ul class="sub-menu">
                                    @if ($setting->commission_type == 'subscription')
                                        @php
                                            $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                                            $module_status = json_decode($json_module_data);
                                        @endphp

                                        @if ($module_status->Subscription)

                                            <li>
                                                <a class="{{ Route::is('pricing-plan') ? 'active':'' }}" href="{{ route('pricing-plan') }}">{{__('admin.Subscription')}}</a>
                                            </li>
                                        @endif
                                    @endif
                                    <li><a href="{{ route('blogs') }}">{{__('admin.Our Blogs')}}</a></li>
                                    <li><a href="{{ route('faq') }}">{{__('admin.FAQ')}}</a></li>
                                    <li><a href="{{ route('terms-conditions') }}">{{__('admin.Terms & Conditions')}}</a></li>
                                    <li><a href="{{ route('privacy-policy') }}">{{__('admin.Privacy Policy')}}</a></li>
                                    @foreach ($custom_pages as $custom_page)
                                        <li><a href="{{ route('custom-page', $custom_page->slug) }}">{{ $custom_page->page_name }}</a></li>
                                    @endforeach

                                </ul>
                            </li>

							<li><a href="{{ route('contact-us') }}">{{__('admin.Contact')}}</a></li>
						</ul>
						<!-- End Main Menu -->
					</nav>
					<!-- offcanvas-menu end -->
				</div>
			</div>
		</div>
		<!-- End Mobile Menu Modal -->

		<!-- Header -->
		<header id="active-sticky" class="inflanar-header inflanar-header--v2">
            <!-- Topbar -->
			<div class="inflanar-header__top">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="inflanar-topbar-flex">
								<!-- Contact -->
								<ul class="inflanar-header__list">
									<li>
										<a href="tel:{{ $setting->phone }}">
											<img src="{{ asset('frontend/img/phone-icon.svg') }}" alt="#">
											<span>{{ $setting->phone }}</span>
										</a>
									</li>
									<li>
										<a href="mailto:{{ $setting->email }}">
											<img src="{{ asset('frontend/img/email-icon.svg') }}" alt="#">
											<span>{{ $setting->email }}</span>
										</a>
									</li>
								</ul>
								<!-- End Contact -->
								<!-- Header Right -->
								<div class="inflanar-header__right">
									<!-- Language Dropdown -->
                                    <form action="{{ route('language-switcher') }}" id="lang_swithcer_form">
									<div class="inflanar-header__lang">
										<img src="{{ asset('frontend/img/global.svg') }}">
										<select id="lang_swithcer" class="inflanar-header__lang--list" name="lang_code">
                                            @if (Session::get('front_lang'))
                                                @foreach ($language_list as $language)
                                                    <option {{ Session::get('front_lang') == $language->lang_code ? 'selected' : '' }} value="{{ $language->lang_code }}">{{ $language->lang_name }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($language_list as $language)
                                                    <option value="{{ $language->lang_code }}">{{ $language->lang_name }}</option>
                                                @endforeach
                                            @endif


										</select>
									</div>
                                </form>
									<!-- Login Register -->
									<div class="inflanar-header__signup">

                                        @guest('web')
                                            <a href="{{ route('login') }}"><img src="{{ asset('frontend/img/in-user2.svg') }}"> {{__('admin.Login / Registration')}}</a>
                                        @else
                                            @php
                                                $auth_user = Auth::guard('web')->user();
                                            @endphp
                                            @if ($auth_user->is_influencer == 'yes')
                                                <a href="{{ route('influencer.dashboard') }}"><img src="{{ asset('frontend/img/in-user2.svg') }}"> {{__('admin.Dashboard')}}</a>
                                            @else
                                                <a href="{{ route('user.dashboard') }}"><img src="{{ asset('frontend/img/in-user2.svg') }}"> {{__('admin.Dashboard')}}</a>
                                            @endif
                                        @endguest

									</div>
								</div>
								<!-- End Header Right -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<div class="inflanar-header__middle">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-12">
							<div class="inflanar-header__inside">
								<div class="inflanar-header__group">
									<div class="inflanar-header__logo">
										<a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}" alt="#"></a>
									</div>
									<div class="inflanar-header__menu inflanar-header__menu--v2">
										<div class="navbar">
											<div class="nav-item">
												<!-- Main Menu -->
												<ul class="nav-menu menu navigation list-none">
                                                    @if ($setting->selected_theme == 'all_theme')
													<li class="menu-item-has-children"><a href="{{ route('home', ['theme' => 'one']) }}">{{__('admin.Home')}}</a>
														<ul class="sub-menu">
															<li><a href="{{ route('home', ['theme' => 'one']) }}">{{__('admin.Homepage V1')}}</a></li>
															<li><a href="{{ route('home', ['theme' => 'two']) }}">{{__('admin.Homepage V2')}}</a></li>
															<li><a href="{{ route('home', ['theme' => 'three']) }}">{{__('admin.Homepage V3')}}</a></li>
														</ul>
													</li>
                                                    @else
                                                        <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                                    @endif


                                                    <li><a href="{{ route('about-us') }}">{{__('admin.About Us')}}</a></li>

													<li><a href="{{ route('influencers') }}">{{__('admin.Influencers')}}</a></li>

                                                    <li><a href="{{ route('services') }}">{{__('admin.Services')}}</a></li>

													<li class="menu-item-has-children"><a href="#">{{__('admin.Pages')}}</a>
														<ul class="sub-menu">
                                                            @if ($setting->commission_type == 'subscription')
                                                                @php
                                                                    $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                                                                    $module_status = json_decode($json_module_data);
                                                                @endphp

                                                                @if ($module_status->Subscription)

                                                                    <li>
                                                                        <a class="{{ Route::is('pricing-plan') ? 'active':'' }}" href="{{ route('pricing-plan') }}">{{__('admin.Subscription')}}</a>
                                                                    </li>
                                                                @endif
                                                            @endif
															<li><a href="{{ route('blogs') }}">{{__('admin.Our Blogs')}}</a></li>
															<li><a href="{{ route('faq') }}">{{__('admin.FAQ')}}</a></li>
															<li><a href="{{ route('terms-conditions') }}">{{__('admin.Terms & Conditions')}}</a></li>
															<li><a href="{{ route('privacy-policy') }}">{{__('admin.Privacy Policy')}}</a></li>
                                                            @foreach ($custom_pages as $custom_page)
															    <li><a href="{{ route('custom-page', $custom_page->slug) }}">{{ $custom_page->page_name }}</a></li>
                                                            @endforeach

														</ul>
													</li>
													<li><a href="{{ route('contact-us') }}">{{__('admin.Contact')}}</a></li>
												</ul>
												<!-- End Main Menu -->
											</div>
										</div>
									</div>
								</div>
								<button type="button" class="offcanvas-toggler" data-bs-toggle="modal" data-bs-target="#offcanvas-modal"><span class="line"></span><span class="line"></span><span class="line"></span>
								</button>
								<div class="inflanar-header__button inflanar-header__button--v2">
									<a href="javascript:;" class="inflanar-btn inflanar-btn__search"><img src="{{ asset('frontend/img/search-icon2.svg') }}"></a>

                                    @guest('web')

                                    <a href="{{ route('login') }}" class="inflanar-btn inflanar-btn__secondary">{{__('admin.Dashboard')}}</a>
                                    @else
                                        @php
                                            $auth_user = Auth::guard('web')->user();
                                        @endphp
                                        @if ($auth_user->is_influencer == 'yes')
                                            <a href="{{ route('influencer.dashboard') }}" class="inflanar-btn inflanar-btn__secondary">{{__('admin.Dashboard')}}</a>
                                        @else
                                            <a href="{{ route('user.dashboard') }}" class="inflanar-btn inflanar-btn__secondary">{{__('admin.Dashboard')}}</a>
                                        @endif
                                    @endguest

									<!-- Header Search Popup -->
									<div class="inflanar-header__search">
                                        <form action="{{ route('services') }}">
                                            <div class="form-group inflanar-form-input">
                                                <input type="text" name="search" placeholder="{{__('admin.Type here..')}}" >
                                                <button class="infalnar-btn" type="submit"><i class="fas fa-search"></i></button>
                                            </div>
                                        </form>
									</div>
									<!-- End Header Search Popup -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- End Header -->

        @yield('frontend-content')

		<!-- Footer CTA -->
		<section  class="footer-cta inflanar-bg-cover section-padding">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="footer-cta__inner inflanar-scolor-bg">
							<div class="footer-cta__content">
								<h3 class="footer-cta__title text-white">{{ $home_page->provider_joining_title }}</h3>
								<a href="{{ route('register') }}" class="inflanar-btn inflanar-btn__third"><span>{{__('admin.Join as Influencer')}}</span></a>
							</div>
							<div class="footer-cta__img">
								<img src="{{ asset($home_page->provider_joining_image) }}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Footer CTA -->

		<!-- Footer -->
		<footer class="footer-area footer-area--v2 p-relative">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="footer-top-inner pd-top-30 pd-btm-100">
							<div class="row">
								<div class="col-lg-4 col-md-6 col-12">
									<!-- Footer Widget -->
									<div class="footer-about-widget">
										<div class="footer-logo inflanar-header__logo">
											<a class="logo" href="{{ route('home') }}"><img src="{{ asset($setting->footer_logo) }}" alt="#"></a>
										</div>
										<h4 class="footer-about-widget__title">{{ $setting->about_us }}</h4>
										<div class="footer-get-touch">
											<p>{{__('admin.Get in Touch..')}} <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></p>
										</div>

									</div>
									<!-- End Footer Widget -->
								</div>
								<div class="col-lg-4 col-md-6 col-12">
									<!-- Footer Widget -->
									<div class="single-widget footer-useful-links">
										<h3 class="widget-title">{{__('admin.Quick Links')}}</h3>
										<ul class="footer__list list-none">
											<li><a href="{{ route('about-us') }}">{{__('admin.About Us')}}</a></li>
											<li><a href="{{ route('services') }}">{{__('admin.Our Services')}}</a></li>
											<li><a href="{{ route('influencers') }}">{{__('admin.Our Influencers')}}</a></li>
											<li><a href="{{ route('blogs') }}">{{__('admin.Our Blogs')}}</a></li>
											<li><a href="{{ route('contact-us') }}">{{__('admin.Contact Us')}}</a></li>
											<li><a href="{{ route('terms-conditions') }}">{{__('admin.Terms And Conditions')}}</a></li>
											<li><a href="{{ route('privacy-policy') }}">{{__('admin.Privacy Policy')}}</a></li>
											<li><a href="{{ route('faq') }}">{{__('admin.FAQ')}}</a></li>
											<li><a href="{{ route('user.dashboard') }}">{{__('admin.My Profile')}}</a></li>
											<li><a href="{{ route('user.change-password') }}">{{__('admin.Change Password')}}</a></li>
										</ul>
									</div>
									<!-- End Footer Widget -->
								</div>
								<div class="col-lg-4 col-md-6 col-12">
									<!-- Footer Widget -->
									<div class="single-widget footer-contact">
										<h3 class="widget-title">{{__('admin.Working Hour')}}</h3>
										<div class="f-contact__form-top">
											<ul class="f-contact-list list-none">
												<li>{{ $setting->open_day }}</li>
												<li>{{ $setting->closed_day }}</li>
											</ul>
										</div>
									</div>
									<!-- End Footer Widget -->

									<!-- Footer Widget -->
									<div class="single-widget footer-contact mg-top-30">
										<h3 class="widget-title">{{__('admin.Our Location')}}</h3>
										<div class="f-contact__form-top">
											<p>{{ $setting->address }}</p>
										</div>
									</div>
									<!-- End Footer Widget -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="copyright__inner">
								<!-- Copyright Text -->
								<p class="copyright-text">{{ $setting->copyright }}</p>
								<!-- Social -->
								<ul class="inflanar-social inflanar-social__v2">
                                    @if ($setting->twitter)
                                        <li><a href="{{ $setting->twitter }}"><i class="fa-brands fa-twitter"></i></a></li>
                                    @endif

                                    @if ($setting->behance)
                                        <li><a href="{{ $setting->behance }}"><i class="fa-brands fa-behance"></i></a></li>
                                    @endif

                                    @if ($setting->instagram)
                                        <li><a href="{{ $setting->instagram }}"><i class="fa-brands fa-instagram"></i></a></li>
                                    @endif

                                    @if ($setting->linkedin)
                                        <li><a href="{{ $setting->linkedin }}"><i class="fa-brands fa-linkedin"></i></a></li>
                                    @endif

                                    @if ($setting->facebook)
                                        <li><a href="{{ $setting->facebook }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    @endif

								</ul>
								<!-- End Social -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Copyright -->
		</footer>
		<!-- End Footer -->

        <!-- Scrool Top -->
        <a href="#" class="scrollToTop"><img src="{{ asset('frontend/img/in-scroll-up.svg') }}"></a>

        @if ($tawk_chat->status == 1)
            <script type="text/javascript">
                var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                (function(){
                    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                    s1.async=true;
                    s1.src='{{ $tawk_chat->chat_link }}';
                    s1.charset='UTF-8';
                    s1.setAttribute('crossorigin','*');
                    s0.parentNode.insertBefore(s1,s0);
                })();
            </script>
        @endif

        @if ($cookie_consent->status == 1)
            <script src="{{ asset('frontend/js/cookieconsent.min.js') }}"></script>

            <script>
            window.addEventListener("load",function(){window.wpcc.init({"border":"{{ $cookie_consent->border }}","corners":"{{ $cookie_consent->corners }}","colors":{"popup":{"background":"{{ $cookie_consent->background_color }}","text":"{{ $cookie_consent->text_color }} !important","border":"{{ $cookie_consent->border_color }}"},"button":{"background":"{{ $cookie_consent->btn_bg_color }}","text":"{{ $cookie_consent->btn_text_color }}"}},"content":{"href":"{{ route('privacy-policy') }}","message":"{{ $cookie_consent->message }}","link":"{{ $cookie_consent->link_text }}","button":"{{ $cookie_consent->btn_text }}"}})});
            </script>
        @endif

        <!-- Jquery JS -->

        <script src="{{ asset('frontend/js/jquery-migrate.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <!-- Aos JS -->
        <script src="{{ asset('frontend/js/aos.min.js') }}"></script>
        <!-- CK Editor JS -->
        <script src="{{ asset('frontend/js/ckeditor.min.js') }}"></script>
        <!-- Full Calendar JS -->
        <script src="{{ asset('frontend/js/fullcalendar.min.js') }}"></script>
        <!-- Select2 JS-->
        <script src="{{ asset('frontend/js/select2-js.min.js') }}"></script>
        <!-- Video Popup JS -->
        <script src="{{ asset('frontend/js/video-popup.min.js') }}"></script>
        <!-- Swiper SLider JS -->
        <script src="{{ asset('frontend/js/swiper-slider.min.js') }}"></script>
        <!-- Waypoints JS -->
        <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
        <!-- Counterup JS -->
        <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
        <!-- Main JS -->
        <script src="{{ asset('frontend/js/active.js') }}"></script>

        <script src="{{ asset('toastr/toastr.min.js') }}"></script>

        <script>
            @if(Session::has('messege'))
            var type="{{Session::get('alert-type','info')}}"
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
            @endif
        </script>

        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}');
            </script>
        @endforeach
        @endif

		<script>
            "use strict";
			/* Testimonial Slider */
			var swiper = new Swiper(".inflanar-slider-testimonial", {
				autoplay: {
					 delay: 3333500,
				},
				mousewheel: true,
				keyboard: true,
				loop: true,
				grabCursor: true,
				spaceBetween: 0,
				centeredSlides: false,
				pagination: {
					el: '.swiper-pagination__testimonial',
					type: 'bullets',
					clickable: true,
				},
				breakpoints: {
				  320: {
					slidesPerView: "1",
				  },
				  428: {
					slidesPerView:"1",
				  },
				  768: {
					slidesPerView:"1",
				  },
				  1024: {
					slidesPerView:"2",
				  },
				},
			});

		</script>

        <script>
            (function($) {
            "use strict";
                $(document).ready(function () {

                    $(".add_to_wishlist").on('click',function(e) {
                        e.preventDefault();

                        var isDemo = "{{ env('APP_MODE') }}"
                        if(isDemo == 'DEMO'){
                            toastr.error('This Is Demo Version. You Can Not Change Anything');
                            return;
                        }

                        let id = $(this).data("service_id");
                        let current_list = $(this);
                        $.ajax({
                            url: "{{ url('user/add-to-wishlist') }}" + "/" + id,
                            type:"get",
                            success:function(response){
                                toastr.success(response.message)
                                current_list.addClass('active');
                            },
                            error:function(error){
                                if(error.status == 401){
                                    toastr.error("{{__('admin.Please login to first')}}");
                                }

                                if(error.status == 403){
                                    toastr.error(error.responseJSON.message);
                                }
                            }

                        });

                    })

                    $("#lang_swithcer").on("change", function(e){
                        $("#lang_swithcer_form").submit();
                    })
                });
            })(jQuery);
        </script>

        @stack('frontend_js')
	</body>
</html>
