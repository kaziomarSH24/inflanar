@extends('layout')
@section('title')
    <title>{{__('admin.Orders')}}</title>
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
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Orders')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.Orders')}}</a></li>
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
                                        <a href="{{ route('user.orders') }}" class="inflanar-btn"><i class="fa-solid fa-left-long"></i> {{__('admin.Go Back')}}</a>
                                    </div>
                                </div>

                                <div class="inflanar-order-service">
                                    <h2 class="inflanar-profile-info__heading">{{__('admin.Included Services')}}</h2>
                                    <div class="inflanar-order__body">
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-10 col-12">
                                                <ul class="inflanar-list-style inflanar-list-style__row list-none">
                                                    @foreach (json_decode($order->package_features) as $package_feature)
                                                        @if ($package_feature)
                                                            <li><img src="{{ asset('frontend/img/in-check-icon4.svg') }}">{{ $package_feature }}</li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (count(json_decode($order->additional_services)) > 0)
                                <div class="inflanar-order-service">
                                    <h2 class="inflanar-profile-info__heading">{{__('admin.Additional Service')}}</h2>
                                    <div class="inflanar-order__body">
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-10 col-12">
                                                @foreach (json_decode($order->additional_services) as $index =>  $additional_service)
                                                    <div class="add_section">
                                                        <h3> {{ ++$index }}. {{ $additional_service->title }}</h3>
                                                        <ul>
                                                            @foreach ($additional_service->features as $feature_indx => $feature )
                                                                @if ($feature)
                                                                <li>{{ $feature }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif



                                <div class="row mg-top-10">
                                    <div class="col-lg-6 col-12">
                                        <div class="inflanar-order-list mg-top-30">
                                            <div class="inflanar-profile-info__head">
                                                <h3 class="inflanar-profile-info__heading">{{__('admin.Booking Information')}}</h3>
                                            </div>
                                            <ul class="inflanar-profile-info__list inflanar-dflex-column list-none">
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Schedule Date')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ date('d-M-Y', strtotime($order->booking_date)) }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Schedule Time')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->schedule_time_slot }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Booking Id')}}:</h4>
                                                    <p class="inflanar-profile-info__text">#{{ $order->order_id }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Name')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->client_name }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Phone')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->client_phone }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Email')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->client_email }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Address')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->client_name }}</p>
                                                </li>

                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Booking Created')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->created_at->format('d-m-Y') }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Booking Created Time')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->created_at->format('h:i A') }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Booking Note')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ html_decode($order->order_note) }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Influencer')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->influencer->name }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Service')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->service->title }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6  col-12">
                                        <div class="inflanar-order-list mg-top-30">
                                            <div class="inflanar-profile-info__head">
                                                <h3 class="inflanar-profile-info__heading">{{__('admin.Payment Information')}}</h3>
                                            </div>
                                            <ul class="inflanar-profile-info__list inflanar-dflex-column list-none">
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Payment Status')}}:</h4>
                                                    <p class="inflanar-profile-info__text">
                                                        @if ($order->payment_status == 'pending')
                                                            {{__('admin.Pending')}}
                                                        @elseif ($order->payment_status == 'success')
                                                            {{__('admin.Success')}}
                                                        @endif
                                                    </p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Payment Method')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ $order->payment_method }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Transaction')}}:</h4>
                                                    <p class="inflanar-profile-info__text">{{ html_decode($order->transection_id) }}</p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Sub Total')}}:</h4>
                                                    <p class="inflanar-profile-info__text">

                                                        {{ currency($order->package_amount) }}
                                                    </p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Additional')}}:</h4>
                                                    <p class="inflanar-profile-info__text">

                                                        {{ currency($order->additional_amount) }}

                                                    </p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Discount')}} (-):</h4>
                                                    <p class="inflanar-profile-info__text">

                                                        {{ currency($order->coupon_discount) }}

                                                    </p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Total Amount')}}:</h4>
                                                    <p class="inflanar-profile-info__text">
                                                        {{ currency($order->total_amount - $order->coupon_discount) }}
                                                    </p>
                                                </li>
                                                <li class="inflanar-dflex">
                                                    <h4 class="inflanar-profile-info__title">{{__('admin.Order Status')}}:</h4>
                                                    <p class="inflanar-profile-info__text">

                                                        @if ($order->order_status == 'awaiting_for_influencer_approval')
                                                        {{__('admin.awaiting for influencer approval')}}
                                                        @elseif ($order->order_status == 'approved_by_influencer')
                                                        {{__('admin.Approved')}}
                                                        @elseif ($order->order_status == 'order_decliened_by_influencer')
                                                        {{__('admin.Declined by influencer')}}
                                                        @elseif ($order->order_status == 'order_decliened_by_client')
                                                        {{__('admin.Declined by me')}}
                                                        @elseif ($order->order_status == 'complete')
                                                        {{__('admin.Complete')}}
                                                        @endif

                                                    </p>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="order_btn_area mg-top-30">

                                            @if ($order->order_status == 'approved_by_influencer')
                                                @if ($order->order_status != 'complete')

                                                    <a data-bs-toggle="modal" data-bs-target="#markAsComplete" href="javascript:;" class="inflanar-btn"> <i class="fa fa-check" aria-hidden="true"></i> {{__('admin.Mark as complete')}}</a>


                                                    <a data-bs-toggle="modal" data-bs-target="#decliendOrder" href="javascript:;" class="inflanar-btn"><i class="fa-solid fa-arrow-rotate-right"></i> {{__('admin.Decliend Order')}}</a>

                                                @endif

                                            @endif

                                            @if ($order->order_status == 'order_decliened_by_client' || $order->order_status == 'order_decliened_by_influencer')
                                            @if (!$refund_request)
                                                <a data-bs-toggle="modal" data-bs-target="#refundRequest" href="javascript:;" class="inflanar-btn"><i class="fa-solid fa-comment-dollar"></i> {{__('admin.Send Refund Request')}}</a>
                                            @endif

                                        @endif
                                        </div>
                                    </div>

                                    @if ($refund_request)
                                        <div class="col-lg-6 col-12">
                                            <div class="inflanar-order-list mg-top-30">
                                                <div class="inflanar-profile-info__head">
                                                    <h3 class="inflanar-profile-info__heading">{{__('admin.Refund Request :')}}</h3>
                                                </div>
                                                <ul class="inflanar-profile-info__list inflanar-dflex-column list-none">
                                                    <li class="inflanar-dflex">
                                                        <h4 class="inflanar-profile-info__title">
                                                            {{__('admin.Request Date')}} :</h4>
                                                        <p class="inflanar-profile-info__text">{{ $refund_request->created_at->format('h:i A, d-M-Y') }}</p>
                                                    </li>
                                                    <li class="inflanar-dflex">
                                                        <h4 class="inflanar-profile-info__title">{{__('admin.Reasone')}} :</h4>
                                                        <div class="inflanar-profile-info__text">
                                                            {!! html_decode(clean(nl2br($refund_request->reasone))) !!}
                                                        </div>
                                                    </li>
                                                    <li class="inflanar-dflex inflanar-dflex-break">
                                                        <h4 class="inflanar-profile-info__title">
                                                            {{__('admin.Account Information')}} :</h4>
                                                        <div class="inflanar-profile-info__text">
                                                            {!! html_decode(clean(nl2br($refund_request->account_information))) !!}
                                                        </div>
                                                    </li>
                                                    <li class="inflanar-dflex">
                                                        <h4 class="inflanar-profile-info__title">{{__('admin.Refund Status')}}:</h4>
                                                        <p class="inflanar-profile-info__text">
                                                            @if ($order->complete_by_admin == 'Yes')
                                                                {{__('admin.Refund request declined and order completed by admin')}}
                                                            @else
                                                                @if ($refund_request->status == 'awaiting_for_admin_approval')
                                                                    {{__('admin.awaiting for admin approval')}}
                                                                @elseif ($refund_request->status == 'decliened_by_admin')
                                                                {{__('admin.Decliened by admin')}}
                                                                @else
                                                                {{__('admin.Complete')}}
                                                                @endif
                                                            @endif
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Features -->


  <!-- Complete Order Modal -->
  <div class="modal fade" id="markAsComplete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Confirmation Alert')}}</h5>
        </div>
        <div class="modal-body">
            <p>{{__('admin.Are you realy want to complete this booking ?')}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin.Close')}}</button>
          <form action="{{ route('user.mark-as-a-complete', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

              <button type="submit" class="btn btn-primary">{{__('admin.Yes, Complete')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Decliend Order Modal -->
  <div class="modal fade" id="decliendOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Confirmation Alert')}}</h5>
        </div>
        <div class="modal-body">
            <p>{{__('admin.Are you realy want to Declined this booking ?')}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin.Close')}}</button>
          <form action="{{ route('user.mark-as-a-declined', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

              <button type="submit" class="btn btn-primary">{{__('admin.Yes, Declined')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Refund Request Modal -->
  <div class="modal fade" id="refundRequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Make refund request')}}</h5>
        </div>
        <div class="modal-body">
            <form action="{{ route('user.send-refund-request',$order->id) }}" method="POST">
                @csrf
                <div class="form-group inflanar-form-input mb-3">
                    <label for="">{{__('admin.Reasone')}} *</label>
                    <input type="text" class="ecom-wc__form-input" name="reasone" autocomplete="off" placeholder="{{__('admin.Type your reasone')}}">
                </div>

                <div class="form-group inflanar-form-input">
                    <label for="">{{__('admin.Account Information for get payment')}} *</label>
                    <textarea cols="3" rows="3" name="account_information"  placeholder="{{__('admin.Type your bank information')}}"></textarea>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin.Close')}}</button>
            <button type="submit" class="btn btn-primary">{{__('admin.Send Request')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>




@endsection
