@extends('layout')
@section('title')
    <title>{{__('admin.Subscription Plan')}}</title>
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

<!-- Features -->
<section class="inflaner-inner-page pd-top-90 pd-btm-120">
    <div class="container">
        <div class="inflanar-personals">
            <div class="row">
                @include('profile.sidebar')

                <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content mg-top-30">
                    <div class="inflanar-order-detail">
                        <div class="row">
                            <div class="col-12">
                                <div class="inflanar-supports__head">
                                    <div class="inflanar-supports__buttons">
                                        <a href="{{ route('user.subscription-plan') }}" class="inflanar-btn"><i class="fa-solid fa-left-long"></i> {{__('admin.Go Back')}}</a>
                                    </div>
                                </div>
                                <div class="inflanar-order-service">
                                    <h2 class="inflanar-profile-info__heading">{{__('admin.Subscription Plan')}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                   <table class="inflanar-table__main inflanar-table__main--order mg-top-30">
                    <tbody class="inflanar-table__body">
                        <tr>
                            <td class="inflanar-table__column-1 inflanar-table__data-1">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">{{__('admin.Plan Name')}}</p>
                                </div>
                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">{{ $plan->plan_name }}</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="inflanar-table__column-1 inflanar-table__data-1">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">{{__('admin.Expiration')}}</p>
                                </div>
                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">{{ $plan->expiration }}</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="inflanar-table__column-1 inflanar-table__data-1 font-weight-bold">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__dese ">{{__('admin.Expirated Date')}}</p>
                                </div>
                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">{{ $plan->expiration_date }}</p>
                                </div>
                            </td>
                        </tr>
                        @php
                                    // Assuming $plan->expiration_date contains the expiration date
                                    $expirationDate = \Carbon\Carbon::parse($plan->expiration_date);
                                    $currentDate = \Carbon\Carbon::now();

                                    // Calculate the difference in days
                                    $daysRemaining = $currentDate->diffInDays($expirationDate);
                                @endphp
                        <tr>
                            <td class="inflanar-table__column-1 inflanar-table__data-1">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">Remaining Day</p>
                                </div>
                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">{{$daysRemaining}} {{__('admin.Days') }}</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="inflanar-table__column-1 inflanar-table__data-1">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">Number of Applies</p>
                                </div>
                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                <div class="inflanar-table__content">
                                    @if ($plan->maximum_service == -1)
                                        <p class="inflanar-table__desc">{{__('admin.Unlimited')}}</p>
                                    @else
                                        <p class="inflanar-table__desc">{{ $plan->maximum_service }}</p>

                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="inflanar-table__column-1 inflanar-table__data-1">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">Payment Method</p>
                                </div>
                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">{{ $plan->payment_method }}</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="inflanar-table__column-1 inflanar-table__data-1">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">Payment Status</p>
                                </div>
                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                <div class="inflanar-table__content">
                                   @if ($plan->payment_status == 'success')
                                        <strong>{{__('admin.Success')}}</strong>
                                    @else
                                        <strong>{{__('admin.Pending')}}</strong>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="inflanar-table__column-1 inflanar-table__data-1">
                                <div class="inflanar-table__content">
                                    <p class="inflanar-table__desc">Status</p>
                                </div>
                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                <div class="inflanar-table__content">
                                   @if ($plan->status == 'active')
                                        <strong>{{__('admin.Active')}}</strong>
                                    @else
                                        <strong>{{__('admin.Expired')}}</strong>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Features -->
@endsection
