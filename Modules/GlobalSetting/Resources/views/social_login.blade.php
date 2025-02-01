@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Social Login')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Social Login')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-social-login') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="">{{__('admin.Allow Login with Facebook')}}</label>
                                    <div>
                                        @if ($login_info->is_facebook == 1)
                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_facebook_login">
                                        @else
                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_facebook_login">
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Facebook App Id')}}</label>
                                    <input type="text" value="{{ $login_info->facebook_client_id }}" class="form-control" name="facebook_app_id">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Facebook App Secret')}}</label>
                                    <input type="text" value="{{ $login_info->facebook_secret_id }}" class="form-control" name="facebook_app_secret">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Facebook Redirect Url')}}</label>
                                    <input type="text" value="{{ $login_info->facebook_redirect_url}}" class="form-control" name="facebook_redirect_url">
                                </div>



                                <div class="form-group">
                                    <label for="">{{__('admin.Allow Login with Gmail')}}</label>
                                    <div>
                                        @if ($login_info->is_gmail == 1)
                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_gmail_login">
                                        @else
                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_gmail_login">
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Gmail Client Id')}}</label>
                                    <input type="text" value="{{ $login_info->gmail_client_id }}" class="form-control" name="gmail_client_id">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Gmail Secret Id')}}</label>
                                    <input type="text" value="{{ $login_info->gmail_secret_id }}" class="form-control" name="gmail_secret_id">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Gmail Redirect Url')}}</label>
                                    <input type="text" value="{{ $login_info->gmail_redirect_url }}" class="form-control" name="gmail_redirect_url">
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
