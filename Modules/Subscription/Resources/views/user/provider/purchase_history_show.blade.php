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
                                    $expirationDate = \Carbon\Carbon::parse($history->expiration_date);
                                    $currentDate = \Carbon\Carbon::now();

                                    // Calculate the difference in days
                                    $daysRemaining = $currentDate->diffInDays($expirationDate);
                                @endphp
                                <tr>
                                    <td>Expirated Date</td>
                                    <td>{{ $history->expiration_date }}</td>
                                </tr>
                                <tr>
                                    <td>Remaining Day</td>
                                    <td>{{$daysRemaining}} {{__('admin.Days') }}</td>
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
