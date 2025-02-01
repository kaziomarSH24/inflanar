@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Facebook Pixel')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Facebook Pixel')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-facebook-pixel') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">{{__('admin.Allow Facebook Pixel')}}</label>
                                        <div>
                                            @if ($facebook_pixel->status == 1)
                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_facebook_pixel">
                                            @else
                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_facebook_pixel">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Facebook App Id')}}</label>
                                        <input type="text" value="{{ $facebook_pixel->app_id }}" class="form-control" name="app_id">
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
