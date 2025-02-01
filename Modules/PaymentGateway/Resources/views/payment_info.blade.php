@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Gateway Information')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Gateway Information')}}</h1>
          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{__('admin.Paymongo Information')}}</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.update-paymongo') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')


                                    <div class="form-group">
                                        <label for="">{{ __('admin.Currency Name')}}</label>
                                        <select name="currency_id" id="" class="form-control select2">
                                            <option value="">{{__('admin.Select Currency')}}
                                            </option>
                                            @foreach ($currencies as $currency)
                                            <option {{ $paymongo->currency_id == $currency->id ? 'selected' : '' }} value="{{ $currency->id }}">{{ $currency->currency_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Public Key')}}</label>
                                        <input type="text" class="form-control" name="public_key" value="{{ $paymongo->public_key }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Secret Key')}}</label>
                                        <input type="text" class="form-control" name="secret_key" value="{{ $paymongo->secret_key }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Webhook Sig')}}</label>
                                        <input type="text" class="form-control" name="webhook_sig" value="{{ $paymongo->webhook_sig }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Status')}}</label>
                                        <select name="status" class="form-control" id="">
                                            <option {{ $paymongo->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                            <option {{ $paymongo->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Paymongo Image')}}</label>
                                                <div>
                                                    <img src="{{ asset($paymongo->paymongo_image) }}" alt="" class="w_200">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{__('admin.New Image')}}</label>
                                                <input type="file" name="paymongo_image" class="form-control-file">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Grabpay Image')}}</label>
                                                <div>
                                                    <img src="{{ asset($paymongo->grabpay_image) }}" alt="" class="w_200">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{__('admin.New Image')}}</label>
                                                <input type="file" name="grabpay_image" class="form-control-file">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{__('admin.GCash Image')}}</label>
                                                <div>
                                                    <img src="{{ asset($paymongo->gcash_image) }}" alt="" class="w_200">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{__('admin.New Image')}}</label>
                                                <input type="file" name="gcash_image" class="form-control-file">
                                            </div>
                                        </div>
                                    </div>






                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{__('admin.Iyzico Information')}}</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.update-iyzico') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')


                                    <div class="form-group">
                                        <label for="">{{ __('admin.Currency Name')}}</label>
                                        <select name="currency_id" id="" class="form-control select2">
                                            <option value="">{{__('admin.Select Currency')}}
                                            </option>
                                            @foreach ($currencies as $currency)
                                            <option {{ $iyzico->currency_id == $currency->id ? 'selected' : '' }} value="{{ $currency->id }}">{{ $currency->currency_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Account Mode')}}</label>
                                        <select name="account_mode" class="form-control" id="">
                                            <option {{ $iyzico->account_mode == 'Sandbox' ? 'selected' : '' }} value="Sandbox">{{__('admin.Sandbox')}}</option>
                                            <option {{ $iyzico->account_mode == 'Live' ? 'selected' : '' }} value="Live">{{__('admin.Live')}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.API Key')}}</label>
                                        <input type="text" class="form-control" name="api_key" value="{{ $iyzico->api_key }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Secret Key')}}</label>
                                        <input type="text" class="form-control" name="secret_key" value="{{ $iyzico->secret_key }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Status')}}</label>
                                        <select name="status" class="form-control" id="">
                                            <option {{ $iyzico->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                            <option {{ $iyzico->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Iyzico Image')}}</label>
                                                <div>
                                                    <img src="{{ asset($iyzico->iyzico_image) }}" alt="" class="w_200">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{__('admin.New Image')}}</label>
                                                <input type="file" name="iyzico_image" class="form-control-file">
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{__('admin.Marcadopago Information')}}</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.update-mercado') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')


                                    <div class="form-group">
                                        <label for="">{{ __('admin.Currency Name')}}</label>
                                        <select name="currency_id" id="" class="form-control select2">
                                            <option value="">{{__('admin.Select Currency')}}
                                            </option>
                                            @foreach ($currencies as $currency)
                                            <option {{ $mercado->currency_id == $currency->id ? 'selected' : '' }} value="{{ $currency->id }}">{{ $currency->currency_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Public Key')}}</label>
                                        <input type="text" class="form-control" name="public_key" value="{{ $mercado->public_key }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Access token')}}</label>
                                        <input type="text" class="form-control" name="access_token" value="{{ $mercado->access_token }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Status')}}</label>
                                        <select name="status" class="form-control" id="">
                                            <option {{ $mercado->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                            <option {{ $mercado->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Mercadopago Image')}}</label>
                                                <div>
                                                    <img src="{{ asset($mercado->mercado_image) }}" alt="" class="w_200">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{__('admin.New Image')}}</label>
                                                <input type="file" name="mercado_image" class="form-control-file">
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </section>
      </div>
@endsection
