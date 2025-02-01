@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Complete Request')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Complete Request')}}</h1>

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
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($complete_requests as $index => $complete_request)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            <a href="{{ route('admin.influencer-show', $complete_request->influencer_id) }}">{{ $complete_request->influencer->name }}</a>
                                        </td>
                                        <td>

                                        {{ currency($complete_request->order->total_amount -  $complete_request->order->coupon_discount) }}

                                        </td>
                                        <td>{{ $complete_request->order->order_id }}</td>
                                        <td>

                                        <a href="{{ route('admin.booking-show',$complete_request->order->order_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
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

      <script>
        "use strict"
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-provider-withdraw/") }}'+"/"+id)
        }
    </script>
@endsection
