@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Refund Request')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Refund Request')}}</h1>

          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('admin.SN')}}</th>
                                    <th >{{__('admin.Client')}}</th>
                                    <th >{{__('admin.Total Amount')}}</th>
                                    <th >{{__('admin.Order Id')}}</th>
                                    <th >{{__('admin.Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($refund_requests as $index => $refund_request)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            <a href="{{ route('admin.client-show', $refund_request->client->id) }}">{{ $refund_request->client->name }}</a>
                                        </td>
                                        <td>

                                            {{ currency($refund_request->order->total_amount - $refund_request->order->coupon_discount) }}

                                        </td>
                                        <td>{{ $refund_request->order->order_id }}</td>

                                        <td>
                                            @if ($refund_request->status == 'awaiting_for_admin_approval')
                                                    {{__('admin.awaiting for admin approval')}}
                                                @elseif ($refund_request->status == 'decliened_by_admin')
                                                    {{__('admin.Decliened by admin')}}
                                                @else
                                                    {{__('admin.Complete')}}
                                                @endif
                                        </td>
                                        <td>

                                        <a href="{{ route('admin.booking-show',$refund_request->order->order_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </tr>
                                  @endforeach
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
