@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Conact Us')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Conact Us')}}</h1>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                            <form action="{{ route('admin.update-contact-us') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                        <textarea name="email" cols="30" rows="10" class="form-control text-area-5">{{ $contact_us->email }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                        <textarea name="phone" cols="30" rows="10" class="form-control text-area-5">{{ $contact_us->phone }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                        <textarea name="address" cols="30" rows="10" class="form-control text-area-5">{{ $contact_us->address }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Google Map')}} <span class="text-danger">*</span></label>
                                        <textarea name="map_code" cols="30" rows="10" class="form-control text-area-5">{{ $contact_us->map_code }}</textarea>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                    </div>
                                </div>
                            </form>

                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
