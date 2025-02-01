@extends('layout')
@section('title')
    <title>{{__('admin.Payment')}}</title>
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
                            <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Payment')}}</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                <li class="active"><a href="javascript:;">{{__('admin.Payment')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->


    		<!-- Features -->
		<section class="pd-top-90 pd-btm-120">
			<div class="container">
				<div class="row">
                    <div class="col-lg-9 col-12 mg-top-30">
                        <div class="inflanar-sdetail">
                            <!-- Service Thumb -->
                            <div class="inflanar-sdetail__thumb">
                                <img src="{{ asset($service->thumbnail_image) }}" alt="#">
                            </div>
                            <!-- Service Content -->
                            <div class="inflanar-sdetail__content">
                                <h2 class="inflanar-sdetail__title mg-btm-20">{{__('admin.Booking Information')}}</h2>
                                <div class="inflanar-sdetail__tcontent mg-top-10">
                                    <ul class="inflanar-booking-info list-none">
                                        <li>
                                            <span class="inflanar-booking-info__label">{{__('admin.Name')}}:</span> <span class="inflanar-booking-info__desc">{{ $booking_info->name }}:</span>
                                        </li>
                                        <li>
                                            <span class="inflanar-booking-info__label">{{__('admin.Email')}}:</span>
                                            <span class="inflanar-booking-info__desc">{{ $booking_info->email }}</span>
                                        </li>
                                        <li>
                                            <span class="inflanar-booking-info__label">{{__('admin.Phone Number')}}:</span>
                                            <span class="inflanar-booking-info__desc">{{ $booking_info->phone }}</span>
                                        </li>


                                        <li>
                                            <span class="inflanar-booking-info__label">{{__('admin.Date')}}:</span>
                                            <span class="inflanar-booking-info__desc">{{ $booking_info->date }}</span>
                                        </li>

                                        <li>
                                            <span class="inflanar-booking-info__label">{{__('admin.Schedule')}}:</span>
                                            <span class="inflanar-booking-info__desc">{{ $booking_info->name }}</span>
                                        </li>


                                        <li>
                                            <span class="inflanar-booking-info__label">{{__('admin.Your Address')}}:</span>
                                            <span class="inflanar-booking-info__desc">{{ $booking_info->address }}</span>
                                        </li>
                                        <li>
                                            <span class="inflanar-booking-info__label">{{__('admin.Order Note')}}:</span>
                                            <span class="inflanar-booking-info__desc inflanar-booking-info__flabel inflanar-font-normal">{{ $booking_info->order_note }}</span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <!-- Payment list -->
                        <div class="inflanar-payment-list mg-top-60">
                            <ul class="inflanar-payment-method__list">
                                @if($provider_stripe)
                                    @if ($provider_stripe->status == 1)
                                        <li>
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#stripeModal">
                                                <input class="form-check-input " type="radio" value="" id="payment-1"  name="payment-method">
                                                <label class="form-check-label inflanar-payment-method__label" for="payment-1"><img src="{{ asset($stripe->image) }}"></label>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                @if($provider_paypal)
                                    @if ($provider_paypal->status == 1)
                                    <li>
                                        <a href="{{ route('provider-pay-with-paypal', $service->slug) }}">
                                            <input class="form-check-input " type="text" value="" id="payment-2"  name="payment-method">
                                            <label class="form-check-label inflanar-payment-method__label" for="payment-2"><img src="{{ asset($paypal->image) }}"></label>
                                        </a>
                                    </li>
                                    @endif
                                @endif
                                @if($provider_razorpay)
                                    @if ($provider_razorpay->status == 1)
                                        <li>
                                            <a href="javascript:;" id="razorpayBtn">
                                                <input class="form-check-input " type="radio" value="" id="payment-3"  name="payment-method">
                                                <label class="form-check-label inflanar-payment-method__label" for="payment-3"><img src="{{ asset($razorpay->image) }}"></label>
                                            </a>
                                        </li>

                                        <form action="{{ route('provider-pay-with-razorpay', $service->slug) }}" method="POST" class="d-none">
                                            @csrf
                                            @php
                                                $payable_amount = $grand_total * $razorpay->currency->currency_rate;
                                                $payable_amount = round($payable_amount, 2);
                                            @endphp
                                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                    data-key="{{ $razorpay->key }}"
                                                    data-currency="{{ $razorpay->currency->currency_code }}"
                                                    data-amount= "{{ $payable_amount * 100 }}"
                                                    data-buttontext="{{__('admin.Pay')}} {{ $payable_amount }} {{ $razorpay->currency->currency_code }}"
                                                    data-name="{{ $razorpay->name }}"
                                                    data-description="{{ $razorpay->description }}"
                                                    data-image="{{ asset($razorpay->image) }}"
                                                    data-prefill.name=""
                                                    data-prefill.email=""
                                                    data-theme.color="{{ $razorpay->color }}">
                                            </script>
                                        </form>

                                    @endif
                                @endif
                                @if($provider_razorpay)
                                    @if ($provider_flutterwave->status == 1)
                                        <li>
                                            <a onclick="flutterwavePayment()" href="javascript:;">
                                                <input class="form-check-input " type="text" value="" id="payment-4"  name="payment-method">
                                                <label class="form-check-label inflanar-payment-method__label" for="payment-4"><img src="{{ asset($flutterwave->logo) }}"></label>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                @if($provider_paystack)
                                    @if ($provider_paystack->status == 1)
                                        <li>
                                            <a onclick="payWithPaystack()" href="javascript:;">
                                                <input class="form-check-input " type="text" value="" id="payment-5"  name="payment-method">
                                                <label class="form-check-label inflanar-payment-method__label" for="payment-5"><img src="{{ asset($paystack->paystack_image) }}"></label>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                @if($provider_mollie)
                                    @if ($provider_mollie->status ==1)
                                    <li>
                                        <a href="{{ route('pay-via-mollie',$service->slug) }}">
                                            <input class="form-check-input payment-bank-button" type="text" value="" id="payment-6"  name="payment-method">
                                            <label class="form-check-label inflanar-payment-method__label" for="payment-6"><img src="{{ asset($mollie->mollie_image) }}"></label>
                                        </a>
                                    </li>
                                    @endif
                                @endif
                                @if($provider_instamojo)
                                    @if ($provider_instamojo->status == 1)
                                    <li>
                                        <a href="{{ route('provider-pay-with-instamojo', $service->slug) }}">
                                            <input class="form-check-input payment-stripe-button " type="text" value="" id="payment-7" name="payment-method">
                                            <label class="form-check-label inflanar-payment-method__label" for="payment-7"><img src="{{ asset($instamojo->image) }}"></label>
                                        </a>
                                    </li>
                                    @endif
                                @endif
                                @if($provider_bank_handcash)
                                    @if ($provider_bank_handcash->bank_status == 1)
                                        <li>
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <input class="form-check-input payment-stripe-button " type="radio" value="" id="payment-10" name="payment-method">
                                                <label class="form-check-label inflanar-payment-method__label" for="payment-10"><img src="{{ asset($bank->image) }}"></label>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                @if (Module::isEnabled('PaymentGateway'))
                                    @include('payment_for_addon')
                                @endif

                            </ul>

                        </div>
                        <!-- End Payment List -->


                    </div>
                    <div class="col-lg-3 col-12 mg-top-30">
						<!-- Single Sidebar -->
						<div class="book-single-sidebar p-0 mg-top-30">
							<div class="book-single-sidebar__summary">
								<h4 class="book-single-sidebar__title">{{__('admin.Booking Summery')}}</h4>
								<ul class="inflanar-list-style inflanar-list-style__white list-style-normal list-none">
									@if ($service->features)
                                    @foreach (json_decode($service->features) as $feature)
                                        @if ($feature)
                                        <li><img src="{{ asset('frontend/img/in-check-icon3.svg') }}">{{ $feature }}</li>
                                        @endif
                                    @endforeach
                                @endif
								</ul>
							</div>
							<div class="inflanar-package-info">
								<div class="inflanar-package-info__group">
									<!-- Single Package Info -->
									<div class="inflanar-package-info__single">
										<p><span><b>{{__('admin.Package Fee')}}</b></span>
                                            <span><b>
                                                {{ currency($service->price) }}
                                            </b></span>
                                        </p>
									</div>
									<!-- Single Package Info -->
									<div class="inflanar-package-info__single">
										<p><span><b>{{__('admin.Extra Service')}}</b></span> <span><b class="extra_service_price">
                                            {{ currency($booking_info->extra_total) }}
                                        </b></span></p>
                                        @if (is_array($booking_info->ids))
                                        @foreach ($booking_info->ids as $extra_index => $extra_id)
										<p><span>(+) {{ $booking_info->names[$extra_index] }}</span> <span>
                                            {{ currency($booking_info->prices[$extra_index]) }}
                                        </span></p>
                                        @endforeach
                                        @endif

									</div>
									<!-- Single Package Info -->
									<div class="inflanar-package-info__single">
										<p><span>{{__('admin.Subtotal')}}</span> <span>
                                            {{ currency($booking_info->total) }}
                                        </span></p>
										<p><span>{{__('admin.Discount')}} (-)</span> <span>
                                            {{ currency($discount, 2) }}
                                        </span></p>
									</div>
									<!-- Single Package Info -->
									<div class="inflanar-package-info__single">
										<p><span><b>{{__('admin.Total')}}</b></span> <span><b>
                                            {{ currency($grand_total) }}
                                        </b></span></p>
									</div>
								</div>
								<!-- Form -->
								<form class="inflanar-discount__form pd-top-15" action="{{ route('apply-coupon') }}" method="POST">
                                    @csrf
									<div class="form-group">
										<input  type="text" name="coupon" placeholder="{{__('admin.Enter Coupon Code')}}"  autocomplete="off" >
                                        <input type="hidden" name="influencer_id" value="{{ $service->influencer_id }}">
										<button class="apply">{{__('admin.Apply')}}</button>
									</div>
								</form>

							</div>

                        </div>
                    </div>
                </div>
			</div>
		</section>
		<!-- End Features -->





    <!-- Bank Payment Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('provider-bank-payment', $service->slug) }}" method="POST">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Pay via Bank')}}</h5>
                </div>
                <div class="modal-body">
                <div>
                    @if($provider_bank_handcash)
                        {!! nl2br($provider_bank_handcash->bank_instruction) !!}
                    @endif
                </div>

                <div class="form-group mt-2">
                    <textarea required cols="3" rows="3" name="tnx_info"  placeholder="{{__('admin.Type your transaction information')}}"></textarea>
                </div>


                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('admin.Close')}}</button>
                <button type="submi" class="btn btn-primary">{{__('admin.Submit now')}}</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!-- Bank Payment Modal -->

    <!-- Stripe Payment Modal -->
    <div class="modal fade" id="stripeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Pay via Stripe')}}</h5>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('pay-via-stripe', $service->slug) }}" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ $stripe->stripe_key }}" id="payment-form">
                    @csrf

                    <div class="row">
                        <div class="col-xl-12 mb-2">
                            <div class="form-group inflanar-form-input">
                                <input type="text" class="card-number ecom-wc__form-input" name="card_number" placeholder="{{__('admin.Card Number')}}">
                            </div>
                        </div>

                        <div class="col-xl-6 col-sm-6 mb-2">
                            <div class="form-group inflanar-form-input">
                                <input type="text" class="card-expiry-month ecom-wc__form-input" name="month" placeholder="{{__('admin.Expired Month')}}">
                            </div>
                        </div>

                        <div class="col-xl-6 col-sm-6 mb-2">
                            <div class="form-group inflanar-form-input">
                                <input type="text" class="card-expiry-year ecom-wc__form-input" name="year" placeholder="{{__('admin.Expired Year')}}">
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="form-group inflanar-form-input">
                                <input type="text" class="card-cvc ecom-wc__form-input" name="cvc" placeholder="{{__('admin.CVV')}}">
                            </div>
                        </div>

                    </div>

                    <div class='form-row row'>
                        <div class='col-md-12 error d-none form-group mt-2'>
                            <div class='alert-danger alert '>{{__('admin.Please provide your valid card information')}}</div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('admin.Close')}}</button>
                <button type="submi" class="btn btn-primary">{{__('admin.Payment now')}}</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    <!-- Stripe Payment Modal -->

    {{-- start stripe payment --}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        "use strict";
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                                    'input[type=text]', 'input[type=file]',
                                    'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;
                $errorMessage.addClass('d-none');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('d-none');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

            $("#razorpayBtn").on("click", function(){
                $(".razorpay-payment-button").click();
            })

        });
    </script>
    {{-- end stripe payment --}}

    {{-- start flutterwave payment --}}
<script src="https://checkout.flutterwave.com/v3.js"></script>
@php
    $payable_amount = $grand_total * $flutterwave->currency->currency_rate;
    $payable_amount = round($payable_amount, 2);

@endphp
@if($provider_flutterwave)
<script>
    "use strict";
    function flutterwavePayment() {

        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }

        FlutterwaveCheckout({
            public_key: "{{ $provider_flutterwave->public_key }}",
            tx_ref: "{{ substr(rand(0,time()),0,10) }}",
            amount: {{ $payable_amount }},
            currency: "{{ $flutterwave->currency->currency_code }}",
            country: "{{ $flutterwave->currency->country_code }}",
            payment_options: " ",
            customer: {
            email: "{{ $user->email }}",
            phone_number: "{{ $user->phone }}",
            name: "{{ $user->name }}",
            },
            callback: function (data) {

                var tnx_id = data.transaction_id;
                var _token = "{{ csrf_token() }}";
                $.ajax({
                    type: 'post',
                    data : {tnx_id,_token},
                    url: "{{ url('pay-via-flutterwave') }}" + "/" + "{{ $service->slug }}",
                    success: function (response) {

                        if(response.status == 'success'){
                            toastr.success(response.message);
                            window.location.href = "{{ route('user.orders') }}";
                        }else{
                            toastr.error(response.message);
                            window.location.reload();
                        }
                    },
                    error: function(err) {
                        toastr.error("{{__('admin.Something went wrong, please try again')}}");
                        window.location.reload();
                    }
                });
            },
            customizations: {
            title: "{{ $flutterwave->title }}",
            logo: "{{ asset($flutterwave->logo) }}",
            },
        });

    }
</script>
{{-- end flutterwave payment --}}
@endif

{{-- paystack start --}}


<script src="https://js.paystack.co/v1/inline.js"></script>
@php
    $public_key = $paystack->paystack_public_key;
    $currency = $paystack->paystack_currency->currency_code;
    $currency = strtoupper($currency);

    $ngn_amount = $grand_total * $paystack->paystack_currency->currency_rate;
    $ngn_amount = $ngn_amount * 100;
    $ngn_amount = round($ngn_amount);
@endphp

<script>
function payWithPaystack(){

    var isDemo = "{{ env('APP_MODE') }}"
    if(isDemo == 'DEMO'){
        toastr.error('This Is Demo Version. You Can Not Change Anything');
        return;
    }

    var handler = PaystackPop.setup({
        key: '{{ $public_key }}',
        email: '{{ $user->email }}',
        amount: '{{ $ngn_amount }}',
        currency: "{{ $currency }}",
        callback: function(response){
            let reference = response.reference;
            let tnx_id = response.transaction;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                type: "get",
                data: {reference, tnx_id, _token},
                url: "{{ url('provider-pay-with-paystack') }}" + "/" + "{{ $service->slug }}",
                success: function(response) {
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        window.location.href = "{{ route('user.orders') }}";
                    }else{
                        toastr.error(response.message);
                        window.location.reload();
                    }
                },
                error: function(response){
                        toastr.error('Server Error');
                        window.location.reload();
                }
            });
        },
        onClose: function(){
            alert('window closed');
        }
    });
    handler.openIframe();
}
</script>
@endsection
