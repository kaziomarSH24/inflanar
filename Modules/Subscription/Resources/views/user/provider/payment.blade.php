@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Payment Gateway')}}</title>
@endsection
@section('influencer-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Payment Gateway')}}</h1>
          </div>

        <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">


                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link active" id="paypal-tab" data-toggle="tab" href="#paypalTab" role="tab" aria-controls="paypalTab" aria-selected="true">{{__('admin.Paypal')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="stripe-tab" data-toggle="tab" href="#stripeTab" role="tab" aria-controls="stripeTab" aria-selected="true">{{__('admin.Stripe')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="razorpay-tab" data-toggle="tab" href="#razorpayTab" role="tab" aria-controls="razorpayTab" aria-selected="true">{{__('admin.Razorpay')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="flutterwave-tab" data-toggle="tab" href="#flutterwaveTab" role="tab" aria-controls="flutterwaveTab" aria-selected="true">{{__('admin.Flutterwave')}}</a>
                                        </li>



                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="mollie-tab" data-toggle="tab" href="#mollieTab" role="tab" aria-controls="mollieTab" aria-selected="true">{{__('admin.Mollie')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="pay-stack-tab" data-toggle="tab" href="#payStackTab" role="tab" aria-controls="payStackTab" aria-selected="true">{{__('admin.PayStack')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="instamojo-tab" data-toggle="tab" href="#instamojoTab" role="tab" aria-controls="instamojoTab" aria-selected="true">{{__('admin.Instamojo')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="bank-account-tab" data-toggle="tab" href="#bankAccountTab" role="tab" aria-controls="bankAccountTab" aria-selected="true">{{__('admin.Bank Account')}}</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-9">
                                    <div class="border rounded">
                                        <div class="tab-content no-padding" id="settingsContent">

                                            <div class="tab-pane fade show active" id="paypalTab" role="tabpanel" aria-labelledby="paypal-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        @if($paypal)
                                                            <form action="{{ route('influencer.store-paypal-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Paypal Status')}}</label>
                                                                    <div>
                                                                        @if ($paypal->status == 1)
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @else
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Paypal Client Id')}}</label>
                                                                    <input type="text" class="form-control" name="client_id" value="{{ $paypal->client_id }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Paypal Secret Key')}}</label>
                                                                    <input type="text" class="form-control" name="secret_id" value="{{ $paypal->secret_id }}">
                                                                </div>
                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('influencer.store-paypal-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Paypal Status')}}</label>
                                                                    <div>
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Paypal Client Id')}}</label>
                                                                    <input type="text" class="form-control" name="client_id" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Paypal Secret Key')}}</label>
                                                                    <input type="text" class="form-control" name="secret_id" value="">
                                                                </div>
                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="stripeTab" role="tabpanel" aria-labelledby="stripe-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        @if($stripe)
                                                            <form action="{{ route('influencer.store-stripe-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Stripe Status')}}</label>
                                                                    <div>
                                                                        @if ($stripe->status == 1)
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                            @else
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Stripe Key')}}</label>
                                                                    <input type="text" class="form-control" name="stripe_key" value="{{ $stripe->stripe_key }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Stripe Secret')}}</label>
                                                                    <input type="text" class="form-control" name="stripe_secret" value="{{ $stripe->stripe_secret }}">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('influencer.store-stripe-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Stripe Status')}}</label>
                                                                    <div>
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Stripe Key')}}</label>
                                                                    <input type="text" class="form-control" name="stripe_key" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Stripe Secret')}}</label>
                                                                    <input type="text" class="form-control" name="stripe_secret" value="">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="razorpayTab" role="tabpanel" aria-labelledby="razorpay-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        @if($razorpay)
                                                            <form action="{{ route('influencer.store-razorpay-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Razorpay Status')}}</label>
                                                                    <div>
                                                                        @if ($razorpay->status == 1)
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                            @else
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Razorpay Key')}}</label>
                                                                    <input type="text" class="form-control" name="key" value="{{ $razorpay->key }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Razorpay Secret Key')}}</label>
                                                                    <input type="text" class="form-control" name="secret_key" value="{{ $razorpay->secret_key }}">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('influencer.store-razorpay-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Razorpay Status')}}</label>
                                                                    <div>
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Razorpay Key')}}</label>
                                                                    <input type="text" class="form-control" name="key" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Razorpay Secret Key')}}</label>
                                                                    <input type="text" class="form-control" name="secret_key" value="">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="flutterwaveTab" role="tabpanel" aria-labelledby="flutterwave-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        @if($flutterwave)
                                                            <form action="{{ route('influencer.store-flutterwave-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Flutterwave Status')}}</label>
                                                                    <div>
                                                                        @if ($flutterwave->status == 1)
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                            @else
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Public Key')}}</label>
                                                                    <input type="text" class="form-control" name="public_key" value="{{ $flutterwave->public_key }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Secret Key')}}</label>
                                                                    <input type="text" class="form-control" name="secret_key" value="{{ $flutterwave->secret_key }}">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('influencer.store-flutterwave-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Flutterwave Status')}}</label>
                                                                    <div>
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Public Key')}}</label>
                                                                    <input type="text" class="form-control" name="public_key" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Secret Key')}}</label>
                                                                    <input type="text" class="form-control" name="secret_key" value="">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="mollieTab" role="tabpanel" aria-labelledby="mollie-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        @if($mollie)
                                                            <form action="{{ route('influencer.store-mollie-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Mollie Status')}}</label>
                                                                    <div>
                                                                        @if ($mollie->status == 1)
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                            @else
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Mollie Key')}}</label>
                                                                    <input type="text" class="form-control" name="mollie_key" value="{{ $mollie->mollie_key }}">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('influencer.store-mollie-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Mollie Status')}}</label>
                                                                    <div>
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Mollie Key')}}</label>
                                                                    <input type="text" class="form-control" name="mollie_key" value="">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="payStackTab" role="tabpanel" aria-labelledby="pay-stack-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        @if($paystack)
                                                            <form action="{{ route('influencer.store-paystack-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.PayStack Status')}}</label>
                                                                    <div>
                                                                        @if ($paystack->status == 1)
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                            @else
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Public Key')}}</label>
                                                                    <input type="text" name="public_key" class="form-control" value="{{ $paystack->public_key }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Secret Key')}}</label>
                                                                    <input type="text" name="secret_key" class="form-control" value="{{ $paystack->secret_key }}">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('influencer.store-paystack-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.PayStack Status')}}</label>
                                                                    <div>
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Public Key')}}</label>
                                                                    <input type="text" name="public_key" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Secret Key')}}</label>
                                                                    <input type="text" name="secret_key" class="form-control" value="">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="instamojoTab" role="tabpanel" aria-labelledby="instamojo-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        @if($instamojo)
                                                            <form action="{{ route('influencer.store-instamojo-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Instamojo Status')}}</label>
                                                                    <div>
                                                                        @if ($instamojo->status == 1)
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                            @else
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Account Mode')}}</label>
                                                                    <select name="account_mode" id="account_mode" class="form-control">
                                                                        <option {{ $instamojo->account_mode == 'Sandbox' ? 'selected' : '' }} value="Sandbox">{{__('admin.Sandbox')}}</option>
                                                                        <option {{ $instamojo->account_mode == 'Live' ? 'selected' : '' }} value="Live">{{__('admin.Live')}}</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Api Key')}}</label>
                                                                    <input type="text" name="api_key" class="form-control" value="{{ $instamojo->api_key }}">
                                                                </div>



                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Auth Token')}}</label>
                                                                    <input type="text" name="auth_token" class="form-control" value="{{ $instamojo->auth_token }}">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('influencer.store-instamojo-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Instamojo Status')}}</label>
                                                                    <div>
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Account Mode')}}</label>
                                                                    <select name="account_mode" id="account_mode" class="form-control">
                                                                        <option value="Sandbox">{{__('admin.Sandbox')}}</option>
                                                                        <option value="Live">{{__('admin.Live')}}</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Api Key')}}</label>
                                                                    <input type="text" name="api_key" class="form-control" value="">
                                                                </div>



                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Auth Token')}}</label>
                                                                    <input type="text" name="auth_token" class="form-control" value="">
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="bankAccountTab" role="tabpanel" aria-labelledby="bank-account-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        @if($bank)
                                                            <form action="{{ route('influencer.store-bank-handcash-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Bank Payment Status')}}</label>
                                                                    <div>
                                                                        @if ($bank->bank_status == 1)
                                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="bank_status">
                                                                        @else
                                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="bank_status">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Account Information')}}</label>
                                                                    <textarea name="bank_instruction" id="" cols="30" rows="10" class="text-area-5 form-control">{{ $bank->bank_instruction }}</textarea>
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('influencer.store-bank-handcash-gateway') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Bank Payment Status')}}</label>
                                                                    <div>
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="status">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{__('admin.Account Information')}}</label>
                                                                    <textarea name="bank_instruction" id="" cols="30" rows="10" class="text-area-5 form-control"></textarea>
                                                                </div>

                                                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
      </div>

@endsection
