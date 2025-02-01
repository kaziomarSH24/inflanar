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

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th>{{__('admin.Client')}}</th>
                                    <th>{{__('admin.Service')}}</th>
                                    <th>{{__('admin.Rating')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th>{{__('admin.Created At')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $index => $history)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $history->plan_name }}</td>
                                        <td>{{ $history->expiration }}</td>
                                        <td>{{ $history->expiration_date }}</td>
                                        <td class="status">
                                            @if ($history->status == 'active')
                                                <span class="badge badge-success">{{__('admin.Active')}}</span>
                                            @elseif ($history->status == 'pending')
                                                <span class="badge badge-info">{{__('admin.Pending')}}</span>
                                            @elseif ($history->status == 'expired')
                                                <span class="badge badge-danger">{{__('admin.Expired')}}</span>
                                            @endif
                                        </td>
                                        <td class="payment">
                                            @if ($history->payment_status == 'success')
                                                <span class="badge badge-success">{{__('admin.Success')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('influencer.purchase-history-show', $history->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
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
