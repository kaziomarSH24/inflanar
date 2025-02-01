@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Header & Footer')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Header & Footer')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-header-footer') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="">{{__('admin.Email')}}</label>
                                    <input type="email" name="email" class="form-control" value="{{ $setting->email }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Phone')}}</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $setting->phone }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Address')}}</label>
                                    <input type="text" name="address" class="form-control" value="{{ $setting->address }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Opening Day')}}</label>
                                    <input type="text" name="open_day" class="form-control" value="{{ $setting->open_day }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Closed Day')}}</label>
                                    <input type="text" name="closed_day" class="form-control" value="{{ $setting->closed_day }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.About Us')}}</label>
                                    <input type="text" name="about_us" class="form-control" value="{{ $setting->about_us }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Copyright')}}</label>
                                    <input type="text" name="copyright" class="form-control" value="{{ $setting->copyright }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Twitter')}}</label>
                                    <input type="text" name="twitter" class="form-control" value="{{ $setting->twitter }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Behance')}}</label>
                                    <input type="text" name="behance" class="form-control" value="{{ $setting->behance }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Instagram')}}</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ $setting->instagram }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Linkedin')}}</label>
                                    <input type="text" name="linkedin" class="form-control" value="{{ $setting->linkedin }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Facebook')}}</label>
                                    <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook }}">
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
