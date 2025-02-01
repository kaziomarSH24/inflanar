@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Testimonial')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Testimonial')}}</h1>
          </div>


          <div class="section-body row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 service_card">{{__('admin.Language Translation')}}</h5>
                        <hr>
                        <div class="lang_list_top">
                            <ul class="lang_list">
                                @foreach ($language_list as $language)
                                <li><a href="{{ route('admin.testimonial.edit', ['testimonial' => $testimonial,'lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="alert alert-danger mt-2" role="alert">
                            @php
                                $current_language = $language_list->where('lang_code', request()->get('lang_code'))->first();
                            @endphp
                            <p>{{__('admin.Your editing mode')}} : <b>{{ $current_language->lang_name }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

          <div class="section-body">

            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.testimonial.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">
                                <input type="hidden" name="translate_id" value="{{ $translate->id }}">

                            <div class="row">

                                @if (admin_lang() == request()->get('lang_code'))
                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing Logo')}}</label>
                                    <div>
                                        <img src="{{ asset($testimonial->logo) }}" alt="" width="150px">
                                    </div>
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('admin.Logo')}} <span class="text-danger">*</span></label>
                                    <input type="file" id="title" class="form-control-file"  name="logo">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing Image')}}</label>
                                    <div>
                                        <img src="{{ asset($testimonial->image) }}" alt="" width="150px">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Image')}} <span class="text-danger">*</span></label>
                                    <input type="file" id="title" class="form-control-file"  name="image">
                                </div>
                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ $translate->name }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Desgination')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="designation" class="form-control"  name="designation" value="{{ $translate->designation }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Comment')}} <span class="text-danger">*</span></label>
                                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control text-area-5">{{ $translate->comment }}</textarea>
                                </div>

                                @if (admin_lang() == request()->get('lang_code'))
                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option  {{ $testimonial->status == 'enable' ? 'selected' : '' }} value="enable">{{__('admin.Active')}}</option>
                                        <option  {{ $testimonial->status == 'disable' ? 'selected' : '' }} value="disable">{{__('admin.Inactive')}}</option>
                                    </select>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Save')}}</button>
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
