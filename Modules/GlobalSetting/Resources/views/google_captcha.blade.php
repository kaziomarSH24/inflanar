@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Google reCaptcha')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Google reCaptcha')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-google-captcha') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">{{__('admin.Allow Recaptcha')}}</label>
                                    <select name="allow" id="allow" class="form-control">
                                        <option {{ $google_recaptcha->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                        <option {{ $google_recaptcha->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Captcha Site Key')}}</label>
                                    <input type="text" class="form-control" name="site_key" value="{{ $google_recaptcha->site_key }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Captcha Secret Key')}}</label>
                                    <input type="text" class="form-control" name="secret_key" value="{{ $google_recaptcha->secret_key }}">
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
