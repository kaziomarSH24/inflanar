@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Booking Details')}}</title>
@endsection
@section('influencer-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Booking Details')}}</h1>
          </div>

          <div class="section-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 >{{__('admin.Schedule Date')}}</h6>
                                <hr>
                                <p>{{__('admin.Date')}} : {{ date('d-M-Y', strtotime($order->booking_date)) }}</p>
                                <p>{{__('admin.Time')}} : {{ $order->schedule_time_slot }}</p>

                                <h6 class="mt-4">{{__('admin.Booking Information')}}</h6>
                                <hr>
                                <p>{{__('admin.Booking Id')}} : {{ $order->order_id }}</p>
                                <p>{{__('admin.Name')}} : {{ html_decode($order->client_name) }}</p>
                                <p>{{__('admin.Phone')}} : {{ html_decode($order->client_phone) }}</p>
                                <p>{{__('admin.Email')}} : {{ html_decode($order->client_email) }}</p>
                                <p>{{__('admin.Address')}} : {{ html_decode($order->client_address) }}</p>
                                <p>{{__('admin.Booking Created')}} : {{ $order->created_at->format('d-m-Y') }}</p>
                                <p>{{__('admin.Booking Created Time')}} : {{ $order->created_at->format('h:i A') }}</p>


                                @if ($order->order_note)
                                <h6 class="mt-4">{{__('admin.Booking Note')}}</h6>
                                <hr>
                                    <p>{!! html_decode(clean(nl2br($order->order_note))) !!}</p>
                                @endif

                                <h6 class="mt-4">{{__('admin.Client Details')}}</h6>
                                <hr>
                                <p>{{__('admin.Name')}} : {{ $client->name }}</p>
                                <p>{{__('admin.Phone')}} : {{ $client->Phone }}</p>
                                <p>{{__('admin.Email')}} : {{ $client->email }}</p>
                                <p>{{__('admin.Address')}} : {{ $client->address }}</p>

                                <h6 class="mt-4">{{__('admin.Payment Information')}}</h6>
                                <hr>
                                @if ($order->payment_status == 'pending')
                                <p>{{__('admin.Payment Status')}} : <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                @elseif ($order->payment_status == 'success')
                                <p>{{__('admin.Payment Status')}} : <span class="badge badge-success">{{__('admin.Success')}}</span>
                                @endif
                                <p>{{__('admin.Payment Gateway')}} : {{ $order->payment_method }}</p>
                                <p>{{__('admin.Sub Total')}} :

                                    {{ currency($order->package_amount) }}
                                </p>
                                <p>{{__('admin.Additional')}} :

                                    {{ currency($order->additional_amount) }}

                                </p>

                                <p>{{__('admin.Discount')}} (-) :

                                    {{ currency($order->coupon_discount) }}

                                </p>

                                <p>{{__('admin.Total Amount')}} :

                                    {{ currency($order->total_amount - $order->coupon_discount) }}

                                </p>

                                <h6 class="mt-4">{{__('admin.Order Status')}}</h6>
                                <hr>
                                <p>{{__('admin.Status')}} :
                                    @if ($order->order_status == 'awaiting_for_influencer_approval')
                                    {{__('admin.awaiting for approval')}}
                                    @elseif ($order->order_status == 'approved_by_influencer')
                                    {{__('admin.Approved')}}
                                    @elseif ($order->order_status == 'order_decliened_by_influencer')
                                    {{__('admin.Declined by me')}}
                                    @elseif ($order->order_status == 'complete')
                                    {{__('admin.Complete')}}
                                    @elseif ($order->order_status == 'order_decliened_by_client')
                                    <span class="badge badge-danger">{{__('admin.Declined by Client')}}</span>
                                    @endif
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{__('admin.Include Services')}}</th>
                                        </tr>
                                    </thead>
                                    @if ($package_features)
                                        @foreach ($package_features as $package_feature)
                                        @if ($package_feature)
                                        <tr>
                                            <td>{{ $package_feature }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    @endif
                                </table>

                                @if ($order->order_status == 'awaiting_for_influencer_approval')
                                        <a href="javascript:;"  data-toggle="modal" data-target="#approvedOrder-{{ $order->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('admin.Approved')}}</a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#declinedOrder-{{ $order->id }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> {{__('admin.Declined')}}</a>
                                @endif

                                @if (!$complete_request && $order->order_status != 'complete')
                                    @if($order->order_status == 'order_decliened_by_client')
                                        <a href="javascript:;" data-toggle="modal" data-target="#completeRequest" class="btn btn-success btn-sm"><i class="fa fa-rocket"></i> {{__('admin.Complete Request')}}</a>
                                    @endif
                                @endif
                            </div>
                        </div>

                        @if (count(json_decode($order->additional_services)) > 0)
                            <div class="card add_service_section">
                                <div class="card-header pb-2">
                                    <h4>
                                        {{__('admin.Additional Service')}}
                                    </h4>
                                </div>
                                <div class="card-body">
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
                        @endif

                        @if ($complete_request)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6>{{__('admin.Order Complete Request by Provider')}}</h6>
                                    <table class="table">
                                        <tr>
                                            <td>{{__('admin.Request Date')}}</td>
                                            <td>{{ $complete_request->created_at->format('h:i A, d-M-Y') }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Resone')}}</td>
                                            <td>
                                                {!! clean(nl2br($complete_request->reasone)) !!}
                                            </td>
                                        </tr>

                                        @if ($order->complete_by_admin == 'Yes')
                                            <tr>
                                                <td>{{__('admin.Order status')}}</td>
                                                <td>
                                                    @if ($order->complete_by_admin == 'Yes')
                                                    {{__('admin.Order completed by admin')}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                    </table>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
          </div>



        </section>
      </div>


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

    <div class="modal fade" tabindex="-1" role="dialog" id="completeRequest">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('admin.Send Order Complete Request To Admin')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('influencer.send-order-complete-request', $order->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{__('admin.Reasone')}}</label>
                            <textarea name="reasone" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                        </div>

                        <button class="btn btn-primary">{{__('admin.Send')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
