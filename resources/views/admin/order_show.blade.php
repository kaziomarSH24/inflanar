@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Booking Details')}}</title>
@endsection
@section('admin-content')
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
                                <p>{{__('admin.Name')}} : <a href="{{ route('admin.client-show', $client->id) }}">{{ $client->name }}</a></p>
                                <p>{{__('admin.Phone')}} : {{ $client->Phone }}</p>
                                <p>{{__('admin.Email')}} : {{ $client->email }}</p>
                                <p>{{__('admin.Address')}} : {{ $client->address }}</p>

                                <h6 class="mt-4">{{__('admin.Influencer Details')}}</h6>
                                <hr>
                                <p>{{__('admin.Name')}} : <a href="{{ route('admin.influencer-show', $influencer->id) }}">{{ $influencer->name }}</a></p>
                                <p>{{__('admin.Phone')}} : {{ $influencer->Phone }}</p>
                                <p>{{__('admin.Email')}} : {{ $influencer->email }}</p>
                                <p>{{__('admin.Address')}} : {{ $influencer->address }}</p>



                                <h6 class="mt-4">{{__('admin.Payment Information')}}</h6>
                                <hr>

                                <p> {{__('admin.Transaction')}}:  {{ html_decode($order->transection_id) }}</p>

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


                                @if ($order->payment_status == 'pending')
                                    <button data-toggle="modal" data-target="#approvedPayment-{{ $order->id }}" class="btn btn-success btn-sm">{{__('admin.Approve Payment')}}</button>
                                @endif

                                <h6 class="mt-4">{{__('admin.Order Status')}}</h6>
                                <hr>
                                <p>{{__('admin.Status')}} :
                                    @if ($order->order_status == 'awaiting_for_influencer_approval')
                                    {{__('admin.awaiting for influencer approval')}}
                                    @elseif ($order->order_status == 'approved_by_influencer')
                                    {{__('admin.Approved')}}
                                    @elseif ($order->order_status == 'order_decliened_by_influencer')
                                    {{__('admin.Declined by influencer')}}
                                    @elseif ($order->order_status == 'order_decliened_by_client')
                                    <span class="badge badge-danger">{{__('admin.Declined by Client')}}</span>
                                    @elseif ($order->order_status == 'complete')
                                    {{__('admin.Complete')}}
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

                                    <a href="javascript:;" data-toggle="modal" data-target="#declinedOrder-{{ $order->id }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> {{__('admin.Declined')}}</a>

                                    <a href="javascript:;"  data-toggle="modal" data-target="#approvedOrder-{{ $order->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('admin.Approved')}}</a>


                                @endif

                                <a data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{ $order->id }})" href="javascript:;" data-toggle="modal" data-target="#declinedOrder-{{ $order->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i> {{__('admin.Delete Booking')}}</a>


                                @if ($order->order_status != 'complete')
                                <a href="javascript:;"  data-toggle="modal" data-target="#markAsCompelete-{{ $order->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('admin.Mark as complete')}}</a>
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


                        @if ($refund_request)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6>{{__('admin.Rofund Request by Client')}}</h6>
                                    <table class="table">
                                        <tr>
                                            <td>{{__('admin.Request Date')}}</td>
                                            <td>{{ $refund_request->created_at->format('h:i A, d-M-Y') }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Reasone')}}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($refund_request->reasone))) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Account Information')}}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($refund_request->account_information))) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Refund Status')}}</td>
                                            <td>
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
                                            </td>
                                        </tr>


                                    </table>

                                    @if ($order->complete_by_admin != 'Yes')
                                        @if ($refund_request->status == 'awaiting_for_admin_approval')
                                            <a href="javascript:;" data-toggle="modal" data-target="#declinedRefundRequest-{{ $refund_request->id }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> {{__('admin.Declined')}}</a>
                                        @endif


                                        @if ($order->order_status != 'complete')
                                            @if ($refund_request->status != 'complete')
                                                <a href="javascript:;"  data-toggle="modal" data-target="#approvedRefundRequest-{{ $refund_request->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('admin.Approved')}}</a>
                                            @endif
                                        @endif
                                    @endif



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
                                            <td>{{__('admin.Reasone')}}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($complete_request->reasone))) !!}
                                            </td>
                                        </tr>

                                        @if ($order->complete_by_admin == 'Yes')
                                        <tr>
                                            <td>{{__('admin.Order status')}}</td>
                                            <td>
                                                {{__('admin.Order completed by admin')}}
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
                    <form action="{{ route('admin.booking-declined', $order->id) }}" method="POST">
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
                    <form action="{{ route('admin.booking-approved', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="approvedPayment-{{ $order->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('admin.Payment Approved Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('admin.Are You sure approved this payment')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.payment-approved', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="markAsCompelete-{{ $order->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('admin.Booking Complete Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('admin.Are You sure complete this booking')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.mark-as-a-complete', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, complete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($refund_request)
        <div class="modal fade" tabindex="-1" role="dialog" id="declinedRefundRequest-{{ $refund_request->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">{{__('admin.Refund Request Declined Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>{{__('admin.Are You sure declined this refund request')}}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('admin.refund-request-declined', $refund_request->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Yes, Declined')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="approvedRefundRequest-{{ $refund_request->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">{{__('admin.Refund Request Approved Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>{{__('admin.Are You sure approved this refund request')}}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('admin.refund-request-approved', $refund_request->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        "use strict";
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-order/") }}'+"/"+id)
        }
    </script>
@endsection
