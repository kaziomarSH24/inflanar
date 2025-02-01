@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Login Page')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Login Page')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-login-image') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="">{{__('admin.Existing Image')}}</label>
                                    <div>
                                        <img src="{{ asset($setting->login_page_bg) }}" alt="" width="200px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('admin.New Image')}}</label>
                                    <input type="file" name="login_page_bg" class="form-control-file">
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
