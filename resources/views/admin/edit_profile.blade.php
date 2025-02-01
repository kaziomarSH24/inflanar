@extends('admin.master_layout')
@section('title')
<title>{{__('admin.My Profile')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.My Profile')}}</h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="{{ $admin->image ? asset($admin->image) : asset($setting->default_avatar) }}" class="rounded-circle profile-widget-picture">
                  </div>
                  <div class="profile-widget-description">
                    <form action="{{ route('admin.profile-update') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="form-group col-12">
                            <label>{{__('admin.New Image')}}</label>
                            <input type="file" class="form-control-file" name="image">
                            </div>
                            <div class="form-group col-12">
                            <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $admin->name }}" name="name">
                            </div>

                            <div class="form-group col-12">
                                <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="{{ $admin->email }}" name="email">
                            </div>

                            <div class="form-group col-12">
                                <label>{{__('admin.About Me')}}</label>
                                <textarea name="about_me" class="form-control text-area-5" id="" cols="30" rows="10">{{ $admin->about_me }}</textarea>
                            </div>

                            <div class="form-group col-12">
                                <label>{{__('admin.Facebook')}} </label>
                                <input type="text" class="form-control" value="{{ $admin->facebook }}" name="facebook">
                            </div>

                            <div class="form-group col-12">
                                <label>{{__('admin.Linkedin')}} </label>
                                <input type="text" class="form-control" value="{{ $admin->linkedin }}" name="linkedin">
                            </div>

                            <div class="form-group col-12">
                                <label>{{__('admin.Twitter')}} </label>
                                <input type="text" class="form-control" value="{{ $admin->twitter }}" name="twitter">
                            </div>

                            <div class="form-group col-12">
                                <label>{{__('admin.Instagram')}} </label>
                                <input type="text" class="form-control" value="{{ $admin->instagram }}" name="instagram">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card ">
                       <div class="card-body">
                            <form action="{{ route('admin.update-password') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Current Password')}} <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="current_password">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Password')}} <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group col-12">
                                        <label>{{__('admin.Confirm Password')}} <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>

        </section>
      </div>
@endsection
