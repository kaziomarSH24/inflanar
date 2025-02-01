@extends('influencer.master_layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('influencer-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ $title }}</h1>
          </div>

          <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">{{__('admin.Booking Id')}}</label>
                                    <input type="text" autocomplete="off" name="booking_id" class="form-control" value="{{ request()->has('booking_id') ? request()->get('booking_id') : '' }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary plus_btn">{{__('admin.Search')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
                @if ($orders->count() > 0)
                    @foreach ($orders as $order)
                        <div class="col-12">
                            <div class="card service_card order_card">
                                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                    <img class="service_image" src="{{ asset($order->service->thumbnail_image) }}" alt="">
                                    <div class="service_detail">
                                        <h4>{{ $order->service->title }}</h4>
                                        <h6>{{__('admin.Price')}} :

                                            {{ currency($order->total_amount - $order->coupon_discount) }}

                                        </h6>
                                        <p>{{__('admin.Booking Id')}} : {{ $order->order_id }}</p>
                                        <p>{{__('admin.Booking Created')}} : {{ $order->created_at->format('h:i A, d-m-Y') }}</p>
                                        <p>{{__('admin.Schedule Date')}} : {{ $order->schedule_time_slot }}, {{ date('d-M-Y', strtotime($order->booking_date)) }}</p>
                                        <p>{{__('admin.Client')}} : {{ $order->client->name }}</p>
                                        <p>{{__('admin.Phone')}} : {{ $order->client->phone }}</p>
                                        <p>{{__('admin.Status')}} :

                                            @if ($order->order_status == 'awaiting_for_influencer_approval')
                                                <span class="badge badge-danger">{{__('admin.awaiting for approval')}}</span>
                                            @elseif ($order->order_status == 'approved_by_influencer')
                                                <span class="badge badge-success">{{__('admin.Approved')}}</span>

                                            @elseif ($order->order_status == 'order_decliened_by_influencer')
                                                <span class="badge badge-danger">{{__('admin.Declined by influencer')}}</span>

                                            @elseif ($order->order_status == 'order_decliened_by_client')
                                                <span class="badge badge-danger">{{__('admin.Declined by Client')}}</span>
                                            @elseif ($order->order_status == 'complete')
                                                <span class="badge badge-success">{{__('admin.Complete')}}</span>
                                            @endif
                                        </p>

                                        @if ($order->order_status == 'awaiting_for_influencer_approval')
                                            <a href="javascript:;"  data-toggle="modal" data-target="#approvedOrder-{{ $order->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('admin.Approved')}}</a>

                                            <a href="javascript:;" data-toggle="modal" data-target="#declinedOrder-{{ $order->id }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> {{__('admin.Declined')}}</a>
                                        @endif

                                        <a href="{{ route('influencer.booking-show', $order->order_id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> {{__('admin.View')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center text-danger">
                        <h4>{{__('admin.Booking not found!')}}</h4>
                    </div>
                @endif

                <div class="col-12">
                    {{ $orders->links() }}
                </div>
            </div>
          </div>
        </section>
      </div>


      @foreach ($orders as $order)
        <div class="modal fade" tabindex="-1" role="dialog" id="declinedOrder-{{ $order->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">{{__('admin.Booking Declined Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>{{__('admin.Are You sure declined this booking')}}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('influencer.booking-declined', $order->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Yes, Declined')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="approvedOrder-{{ $order->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">{{__('admin.Booking Approved Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>{{__('admin.Are You sure approved this booking')}}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('influencer.booking-approved', $order->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @endforeach
@endsection
