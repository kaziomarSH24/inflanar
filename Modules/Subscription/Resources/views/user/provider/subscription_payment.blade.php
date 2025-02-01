@extends('layout')
@section('title')
    <title>{{__('admin.Subscription Plan')}}</title>
    <meta name="keywords" content="{{__('admin.Subscription Plan')}}">
    <meta name="title" content="{{__('admin.Subscription Plan')}}">
    <meta name="description" content="{{__('admin.Subscription Plan')}}">
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
                            <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Subscription Plan')}}</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                <li class="active"><a href="javascript:;">{{__('admin.Subscription Plan')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <!-- Subscription Plan -->
    <section class="pd-top-120 pd-btm-120">
      <div class="container">
        <div
          class="package-details"
          style="
            background: url('{{ asset("frontend/img/package-details-bg.png") }}') no-repeat center
              center/cover;
          "
        >
          <div class="">
            <div
              class="package-details-header d-flex justify-content-between align-items-center"
            >
              <h4 class="m-0">Package Details</h4>
              <button class="border-0 bg-transparent">
                <svg
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <circle cx="16" cy="16.002" r="16" fill="#FE2C55" />
                  <path
                    d="M22.2188 9.78125L8.88614 23.1146"
                    stroke="white"
                    stroke-width="1.8"
                    stroke-linecap="round"
                  />
                  <path
                    d="M22.2188 23.1133L8.88614 9.77996"
                    stroke="white"
                    stroke-width="1.8"
                    stroke-linecap="round"
                  />
                </svg>
              </button>
            </div>
            <div class="package-detail-info">
              <div class="row">
                <div class="col-lg-4 col-xl-4">
                        <div class="pricing-pack highlighted">
                           <div class="price-header-wrapper">
                              <div
                                 class="position-relative price-header d-flex justify-content-center flex-column align-items-center"
                                 >
                                 <h4 class="pack-name">{{ $plan->plan_name }}</h4>
                                 <div class="price-circle">
                                  <p class="m-0 pack-price">
                                      @if ($setting->currency_position == 'before_price')
                                      {{ $setting->currency_icon }}{{ $plan->plan_price }}
                                      @else
                                      {{$plan->plan_price }}{{ $setting->currency_icon }}
                                      @endif
                                      <span class="pack-duration">
                                          @if ($plan->expiration_date == 'monthly')
                                              /{{__('admin.m')}}
                                          @elseif ($plan->expiration_date == 'yearly')
                                              /{{__('admin.y')}}
                                          @elseif ($plan->expiration_date == 'lifetime')
                                              /{{__('admin.l')}}
                                          @endif</span>
                                  </p>

                                 </div>
                              </div>
                              <svg
                                 class="price-shape"
                                 width="307"
                                 height="193"
                                 viewBox="0 0 307 193"
                                 fill="none"
                                 xmlns="http://www.w3.org/2000/svg"
                                 >
                                 <path
                                    d="M45.8004 119.05C64.0918 119.05 80.3605 130.217 87.4876 147.093C98.72 173.677 124.991 192.33 155.622 192.33C186.254 192.33 212.05 173.083 223.28 146.499C230.41 129.624 240.225 119.05 265.442 119.05L362.825 119.05L362.825 -0.00178528L-55.811 -0.00182188L-55.811 119.05L45.8004 119.05Z"
                                    fill="#FE2C55"
                                    />
                              </svg>
                           </div>
                           <div
                              class="pack-content d-flex flex-column align-items-center"
                              >
                              <ul class="pack-feature m-0">
                                 <li
                                    class="d-flex pack-feature-item gap-2 py-1 align-items-center"
                                    >
                                    <svg
                                       width="13"
                                       height="11"
                                       viewBox="0 0 13 11"
                                       fill="none"
                                       xmlns="http://www.w3.org/2000/svg"
                                       >
                                       <path
                                          d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                          fill="#FE2C55"
                                          />
                                    </svg>
                                    {{ $plan->maximum_service }} {{__('admin.Service Upload')}}
                                 </li>

                                 <li
                                    class="d-flex pack-feature-item gap-2 py-1 align-items-center"
                                    >
                                    <svg
                                       width="13"
                                       height="11"
                                       viewBox="0 0 13 11"
                                       fill="none"
                                       xmlns="http://www.w3.org/2000/svg"
                                       >
                                       <path
                                          d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                          fill="#FE2C55"
                                          />
                                    </svg>
                                    {{__('admin.Personal Profile Page')}}
                                 </li>
                                 <li
                                 class="d-flex pack-feature-item gap-2 py-1 align-items-center"
                                 >
                                 <svg
                                    width="13"
                                    height="11"
                                    viewBox="0 0 13 11"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    >
                                    <path
                                       d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                       fill="#FE2C55"
                                       />
                                 </svg>
                                 {{__('admin.Payment getway')}}
                              </li>
                              <li
                                 class="d-flex pack-feature-item gap-2 py-1 align-items-center"
                                 >
                                 <svg
                                    width="13"
                                    height="11"
                                    viewBox="0 0 13 11"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    >
                                    <path
                                       d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                       fill="#FE2C55"
                                       />
                                 </svg>
                                 {{__('admin.Widrow System')}}
                              </li>
                                 <li
                                    class="d-flex pack-feature-item gap-2 py-1 align-items-center"
                                    >
                                    <svg
                                       width="13"
                                       height="11"
                                       viewBox="0 0 13 11"
                                       fill="none"
                                       xmlns="http://www.w3.org/2000/svg"
                                       >
                                       <path
                                          d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                          fill="#FE2C55"
                                          />
                                    </svg>
                                    {{__('admin.Portfolio Page')}}
                                 </li>
                                 <li
                                    class="d-flex pack-feature-item gap-2 py-1 align-items-center"
                                    >
                                    <svg
                                       width="13"
                                       height="11"
                                       viewBox="0 0 13 11"
                                       fill="none"
                                       xmlns="http://www.w3.org/2000/svg"
                                       >
                                       <path
                                          d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                          fill="#FE2C55"
                                          />
                                    </svg>
                                    {{__('admin.Messageing System')}}
                                 </li>
                                 <li
                                    class="d-flex pack-feature-item gap-2 py-1 align-items-center"
                                    >
                                    <svg
                                       width="13"
                                       height="11"
                                       viewBox="0 0 13 11"
                                       fill="none"
                                       xmlns="http://www.w3.org/2000/svg"
                                       >
                                       <path
                                          d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                          fill="#FE2C55"
                                          />
                                    </svg>
                                    {{__('admin.24/7 Hour Support')}}
                                 </li>
                              </ul>
                           </div>
                        </div>
                </div>

                <div class="col-lg-8 col-xl-8">
                  <div class="payment-vendor">
                    <div class="payment-vendor-header">
                      <h4 class="m-0">Payment</h4>
                    </div>

                    <div class="inflanar-payment-list mg-top-60">
                        <div class="inflanar-payment-list mg-top-60">
                            <ul class="inflanar-payment-method__list">
                                @if ($stripe->status == 1)
                                    <li>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#stripeModal">
                                            <input class="form-check-input " type="radio" value="" id="payment-1"  name="payment-method">
                                            <label class="form-check-label inflanar-payment-method__label" for="payment-1"><img src="{{ asset($stripe->image) }}"></label>
                                        </a>
                                    </li>
                                @endif

                                @if ($paypal->status == 1)
                                <li>
                                    <a href="{{ route('subscription.paypal-payment', $plan->id) }}">
                                        <input class="form-check-input " type="text" value="" id="payment-2"  name="payment-method">
                                        <label class="form-check-label inflanar-payment-method__label" for="payment-2"><img src="{{ asset($paypal->image) }}"></label>
                                    </a>
                                </li>
                                @endif

                                @if ($razorpay->status == 1)
                                    <li>
                                        <a href="javascript:;" id="razorpayBtn">
                                            <input class="form-check-input " type="radio" value="" id="payment-3"  name="payment-method">
                                            <label class="form-check-label inflanar-payment-method__label" for="payment-3"><img src="{{ asset($razorpay->image) }}"></label>
                                        </a>
                                    </li>

                                    <form action="{{ route('subscription.razorpay-payment', $plan->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @php
                                            $plan_price = $plan->plan_price;
                                            $payable_amount = round($plan_price * $razorpay->currency->currency_rate,2);
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

                                @if ($flutterwave->status == 1)
                                    <li>
                                        <a onclick="flutterwavePayment()" href="javascript:;">
                                            <input class="form-check-input " type="text" value="" id="payment-4"  name="payment-method">
                                            <label class="form-check-label inflanar-payment-method__label" for="payment-4"><img src="{{ asset($flutterwave->logo) }}"></label>
                                        </a>
                                    </li>
                                @endif

                                @if ($paystack->paystack_status == 1)
                                    <li>
                                        <a onclick="payWithPaystack()" href="javascript:;">
                                            <input class="form-check-input " type="text" value="" id="payment-5"  name="payment-method">
                                            <label class="form-check-label inflanar-payment-method__label" for="payment-5"><img src="{{ asset($paystack->paystack_image) }}"></label>
                                        </a>
                                    </li>
                                @endif

                                @if ($mollie->mollie_status ==1)
                                <li>
                                    <a href="{{ route('subscription.mollie-payment',$plan->id) }}">
                                        <input class="form-check-input payment-bank-button" type="text" value="" id="payment-6"  name="payment-method">
                                        <label class="form-check-label inflanar-payment-method__label" for="payment-6"><img src="{{ asset($mollie->mollie_image) }}"></label>
                                    </a>
                                </li>
                                @endif

                                @if ($instamojo->status == 1)
                                <li>
                                    <a href="{{ route('subscription.instamojo-payment', $plan->id) }}">
                                        <input class="form-check-input payment-stripe-button " type="text" value="" id="payment-7" name="payment-method">
                                        <label class="form-check-label inflanar-payment-method__label" for="payment-7"><img src="{{ asset($instamojo->image) }}"></label>
                                    </a>
                                </li>
                                @endif


                                @if ($bank_payment->status == 1)
                                    <li>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#bankPaymentModal">
                                            <input class="form-check-input payment-stripe-button " type="radio" value="" id="payment-10" name="payment-method">
                                            <label class="form-check-label inflanar-payment-method__label" for="payment-10"><img src="{{ asset($bank_payment->image) }}"></label>
                                        </a>
                                    </li>
                                @endif
                            </ul>

                        </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Subscription Plan End-->

    <!-- Stripe Payment Modal -->
    <div class="modal fade" id="stripeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Pay via Stripe')}}</h5>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('subscription.stripe-payment', $plan->id) }}" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ $stripe->stripe_key }}" id="payment-form">
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



    <!-- Bank Payment Modal -->
    <div class="modal fade" id="bankPaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('subscription.bank-payment', $plan->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Pay via Bank')}}</h5>
                </div>
                <div class="modal-body">
                <div>
                    {!! nl2br($bank_payment->account_info) !!}
                </div>

                <div class="form-group mt-2">
                    <textarea required cols="3" rows="3" name="transaction"  placeholder="{{__('admin.Type your transaction information')}}"></textarea>
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


    <!--=============================
        PRICING END
    ==============================-->

    @php
        $plan_price = $plan->plan_price;

        // start paystack
        $public_key = $paystack->paystack_public_key;
        $currency = $paystack->paystack_currency_code;
        $currency = strtoupper($currency);

        $ngn_amount = $plan_price * $paystack->paystack_currency_rate;
        $ngn_amount = $ngn_amount * 100;
        $ngn_amount = round($ngn_amount);
        // end paystack

        // start fluttewave
        $payable_amount = $plan_price * $flutterwave->currency_rate;
        $payable_amount = round($payable_amount, 2);
    @endphp

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
<script>
    "use strict";
    function flutterwavePayment() {

        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }

        FlutterwaveCheckout({
            public_key: "{{ $flutterwave->public_key }}",
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
                    url: "{{ url('subscription.flutterwave-payment') }}" + "/" + "{{$plan->id }}",
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

{{-- paystack start --}}


<script src="https://js.paystack.co/v1/inline.js"></script>
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
                url: "{{ url('subscription.paystack-payment') }}" + "/" + "{{ $plan->id }}",
                success: function(response) {
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        window.location.href = "{{ route('influencer.purchase-history') }}";
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


