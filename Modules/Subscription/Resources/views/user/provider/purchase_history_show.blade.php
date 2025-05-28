@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Purchase History')}}</title>
@endsection
@section('influencer-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Purchase History')}}</h1>

        </div>

        {{-- @include('subscription::pricing_plan',[
        'business_plans' => $business_plans,
        'influencer_plans' => $influencer_plans,
        ]) --}}

        <div class="section-body">
            <div class="tab-content mg-top-30" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="row">
                        {{-- @dd($business_plans) --}}
                        @foreach ($business_plans as $index => $plan )
                        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                            <div class="pricing-pack highlighted">
                                <div class="price-header-wrapper">
                                    <div
                                        class="position-relative price-header d-flex justify-content-center flex-column align-items-center">
                                        <h4 class="pack-name">{{ $plan->plan_name }}</h4>
                                        <div class="price-circle">
                                            <p class="m-0 pack-price">
                                                @if ($setting->currency_position == 'before_price')
                                                {{ $setting->currency_icon }}{{ $plan->plan_price }}
                                                @else
                                                {{$plan->plan_price }}{{ $setting->currency_icon }}
                                                @endif
                                                <br>
                                                <span class="pack-duration">
                                                    @if ($plan->expiration_date == 'monthly')
                                                    {{__('admin.Monthly')}}
                                                    @elseif ($plan->expiration_date == 'yearly')
                                                    {{__('admin.Yearly')}}
                                                    @elseif ($plan->expiration_date == 'lifetime')
                                                    {{__('admin.Lifetime')}}
                                                    @endif
                                                </span>
                                            </p>

                                        </div>
                                    </div>
                                    <svg class="price-shape" width="307" height="193" viewBox="0 0 307 193" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M45.8004 119.05C64.0918 119.05 80.3605 130.217 87.4876 147.093C98.72 173.677 124.991 192.33 155.622 192.33C186.254 192.33 212.05 173.083 223.28 146.499C230.41 129.624 240.225 119.05 265.442 119.05L362.825 119.05L362.825 -0.00178528L-55.811 -0.00182188L-55.811 119.05L45.8004 119.05Z"
                                            fill="#FE2C55" />
                                    </svg>
                                </div>
                                <div class="pack-content d-flex flex-column align-items-center">
                                    <ul class="pack-feature m-0">
                                        @if ($plan->description)
                                         @foreach ($plan->description as $des )
                                            <li class="d-flex pack-feature-item gap-2 py-1 align-items-center">
                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                                    fill="#FE2C55" />
                                            </svg>
                                            {{ $des }}
                                        </li>
                                         @endforeach
                                        @else
                                        <li class="d-flex pack-feature-item gap-2 py-1 align-items-center">
                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                                    fill="#FE2C55" />
                                            </svg>
                                            {{ $plan->maximum_service }} {{__('admin.Service Upload')}}
                                        </li>
                                        <li class="d-flex pack-feature-item gap-2 py-1 align-items-center">
                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                                    fill="#FE2C55" />
                                            </svg>
                                            {{__('admin.Personal Profile Page')}}
                                        </li>
                                        <li class="d-flex pack-feature-item gap-2 py-1 align-items-center">
                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                                    fill="#FE2C55" />
                                            </svg>
                                            {{__('admin.Payment getway')}}
                                        </li>
                                        <li class="d-flex pack-feature-item gap-2 py-1 align-items-center">
                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                                    fill="#FE2C55" />
                                            </svg>
                                            {{__('admin.Widrow System')}}
                                        </li>
                                        <li class="d-flex pack-feature-item gap-2 py-1 align-items-center">
                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                                    fill="#FE2C55" />
                                            </svg>
                                            {{__('admin.Portfolio Page')}}
                                        </li>
                                        <li class="d-flex pack-feature-item gap-2 py-1 align-items-center">
                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                                    fill="#FE2C55" />
                                            </svg>
                                            {{__('admin.Messageing System')}}
                                        </li>
                                        <li class="d-flex pack-feature-item gap-2 py-1 align-items-center">
                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.17233 6.25635C4.52039 5.86472 4.85298 5.4802 5.20103 5.10281C6.77888 3.38674 8.49982 1.80597 10.4721 0.474411C10.6771 0.335559 10.8898 0.203828 11.1064 0.0756565C11.176 0.0364932 11.2649 0.00445038 11.3461 0.00445038C11.7909 -0.00267023 12.2356 0.000890077 12.6765 0.000890077C12.8157 0.000890077 12.9279 0.0436138 12.9781 0.168225C13.0284 0.289275 12.9897 0.392524 12.8853 0.481532C11.0793 1.99822 9.59039 3.76413 8.17497 5.58701C6.8717 7.26392 5.6651 9.00135 4.53199 10.7851C4.49332 10.8491 4.44304 10.9168 4.3773 10.956C4.23808 11.045 4.07952 10.9951 3.9751 10.842C3.80108 10.5857 3.63865 10.3222 3.45302 10.073C2.36631 8.63107 1.27187 7.18915 0.181301 5.75079C0.138761 5.69738 0.0923532 5.64398 0.0536803 5.58701C-0.0236653 5.47308 -0.019798 5.34847 0.0807513 5.2559C0.370797 4.98532 0.668578 4.71474 0.966359 4.44771C1.08238 4.34447 1.20613 4.35159 1.36082 4.44771C1.84036 4.7539 2.31991 5.06365 2.79558 5.36983C3.25192 5.66534 3.70826 5.95728 4.17233 6.25635Z"
                                                    fill="#FE2C55" />
                                            </svg>
                                            {{__('admin.24/7 Hour Support')}}
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="pack-btn-wrapper">
                                    @if($history->status == 'active')
                                        @if ($plan->plan_price == 0)
                                            @if ($history->plan_id == $plan->id)
                                            <a class="pack-action-btn highlighted-btn"
                                                href="{{ route('subscription-payment', $plan->id) }}">{{__('admin.Current Plan')}}</a>
                                            @else
                                            <a class="pack-action-btn highlighted-btn"
                                                href="{{ route('subscription-payment', $plan->id) }}">{{__('admin.Trail Now')}}</a>

                                            @endif
                                        @else
                                            @if ($history->plan_id == $plan->id)
                                            <a class="pack-action-btn highlighted-btn"
                                                href="{{ route('subscription-payment', $plan->id) }}">{{__('admin.Current Plan')}}</a>
                                            @else
                                            <a class="pack-action-btn highlighted-btn"
                                                href="{{ route('subscription-payment', $plan->id) }}">{{__('admin.Upgrade')}}</a>
                                            @endif
                                        @endif
                                    @else
                                        @if ($plan->plan_price == 0)
                                        <a class="pack-action-btn highlighted-btn"
                                            href="{{ route('subscription.free-enroll', $plan->id) }}">{{__('admin.Trail Now')}}</a>
                                        @else
                                        <a class="pack-action-btn highlighted-btn"
                                            href="{{ route('subscription-payment', $plan->id) }}">{{__('admin.Purchase Now')}}</a>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Plan</td>
                                        <td>{{ $history->plan_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Expiration</td>
                                        <td>{{ $history->expiration }}</td>
                                    </tr>
                                    @php
                                    // Assuming $history->expiration_date contains the expiration date
                                    $daysRemaining = 0; // Default value
                                    if ($history->expiration_date !== 'lifetime'){

                                    $expirationDate = \Carbon\Carbon::parse($history->expiration_date);
                                    $currentDate = \Carbon\Carbon::now();

                                    // Calculate the difference in days
                                    $daysRemaining = $currentDate->diffInDays($expirationDate);
                                    }
                                    @endphp
                                    <tr>
                                        <td>Expirated Date</td>
                                        <td>{{ $history->expiration_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Remaining Day</td>
                                        <td>{{$daysRemaining === 0 ? 'lifetime' : $daysRemaining.' '. __('admin.Days')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Number of Product</td>
                                        <td>{{$history->maximum_service}}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td>{{$history->payment_method}}</td>
                                    </tr>
                                    <tr>
                                        <td>Transaction</td>
                                        <td>{{$history->transaction}}</td>
                                    </tr>

                                    <tr>
                                        <td>Payment Status</td>
                                        <td>
                                            @if ($history->payment_status == 'success')
                                            <strong>{{__('admin.Success')}}</strong>
                                            @else
                                            <strong>{{__('admin.Pending')}}</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @if ($history->status == 'active')
                                            <strong>{{__('admin.Active')}}</strong>
                                            @else
                                            <strong>{{__('admin.Expired')}}</strong>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
