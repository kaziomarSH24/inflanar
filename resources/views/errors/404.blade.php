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
		<link rel="stylesheet" href="{{ asset('frontend/style.css') }}">

        <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script src="{{ asset('frontend/js/flatpickr.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('frontend/css/flatpickr.min.css') }}">

	</head>

	<body>

        <section class="inflanar-error mg-top-80 pd-top-130 pd-btm-130">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12">
						<div class="inflanar-error-inner">
							<!-- Eror Content Image -->
							<div class="inflanar-error-inner__img">
								<img src="{{ asset($setting->error_image) }}" alt="#">
							</div>
                            <h1 class="inflanar-error-inner__title">{{__('admin.Oops! Page Not Found.')}}</h1>
							<div class="inflanar-error-inner__button">
								<a href="{{ route('home') }}" class="inflanar-btn"><span>{{__('admin.Back to Home Page')}}</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>




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
	</body>
</html>
