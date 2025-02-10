@extends('layout')
@section('title')
    <title>{{__('admin.Subscrioption Plan')}}</title>
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

                <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content">
                    <div class="inflanar-table p-0">
                        <table id="inflanar-table__order" class="inflanar-table__main inflanar-table__main--order mg-top-30">
                            <!-- sherah Table Head -->
                            <thead class="inflanar-table__head">
                                <tr>
                                    <th class="inflanar-table__column-1 inflanar-table__h1">{{__('admin.SN')}}</th>
                                    <th class="inflanar-table__column-2 inflanar-table__h2">{{__('admin.Plan Type')}}</th>
                                    <th class="inflanar-table__column-3 inflanar-table__h3">{{__('admin.Service')}}</th>
                                    <th class="inflanar-table__column-4 inflanar-table__h4">{{__('admin.Expirated Date')}}</th>
                                    <th class="inflanar-table__column-5 inflanar-table__h5">{{__('admin.Status')}}</th>
                                    <th class="inflanar-table__column-7 inflanar-table__h6">{{__('admin.Created At')}}</th>
                                    <th class="inflanar-table__column-7 inflanar-table__h6">{{__('admin.Action')}}</th>
                                </tr>
                            </thead>
                            {{-- @dd($plans)  --}}
                            <tbody class="inflanar-table__body">
                                @foreach ($plans as $index => $plan)
                                    <tr>
                                        <td class="inflanar-table__column-1 inflanar-table__data-1">
                                            <div class="inflanar-table__content">
                                                <p class="inflanar-table__desc">{{ ++$index }}</p>
                                            </div>
                                        </td>
                                        <td class="inflanar-table__column-2 inflanar-table__data-2">
                                            <div class="inflanar-table__content">
                                                <p class="inflanar-table__desc">{{ $plan->plan_name }}</p>
                                            </div>
                                        </td>
                                        <td class="inflanar-table__column-3 inflanar-table__data-3">
                                            <div class="inflanar-table__content">
                                                <p class="inflanar-table__desc">{{$plan->expiration }}</p>
                                            </div>
                                        </td>
                                        <td class="inflanar-table__column-3 inflanar-table__data-4">
                                            <div class="inflanar-table__content">
                                                <p class="inflanar-table__desc">

                                                    {{ $plan->expiration_date }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="inflanar-table__column-3 inflanar-table__data-4">
                                            <div class="inflanar-table__content">
                                                <p class="inflanar-table__desc">

                                                    @if ($plan->status == 'active')
                                                        <span class="inflanar-table__label">{{__('admin.Active')}}</span>
                                                    @elseif ($plan->status == 'pending')
                                                        <span class="inflanar-table__label inflanar-table__label--Pending">{{__('admin.Pending')}}</span>
                                                    @elseif ($plan->status == 'expired')
                                                        <span class="inflanar-table__label inflanar-table__label--cancel">{{__('admin.Expired')}}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="inflanar-table__column-3 inflanar-table__data-4">
                                            <div class="inflanar-table__content">
                                                <p class="inflanar-table__desc">

                                                    @if ($plan->payment_status == 'success')
                                                        <span class="inflanar-table__label">{{__('admin.Success')}}</span>
                                                    @else
                                                        <span class="inflanar-table__label inflanar-table__label--Pending">{{__('admin.Pending')}}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="inflanar-table__column-6 inflanar-table__data-6">
                                            <div class="inflanar-table__status__group">
                                                <a href="{{ route('user.subscription_plan_show', $plan->id) }}" class="inflanar-table__action inflanar-table__action--view"><img src="{{ asset('frontend/img/in-table-eye-icon.svg') }}"></a>

                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{-- <div class="inflanar-supports__bgroup mg-top-40">
                        {{ $plans->links('custom_pagination') }}
                    </div> --}}
                    <!-- End Pagination -->

                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Features -->

@endsection
