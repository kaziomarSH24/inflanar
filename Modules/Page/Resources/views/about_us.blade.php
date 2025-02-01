@extends('admin.master_layout')
@section('title')
<title>{{__('admin.About Us')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.About Us')}}</h1>
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
                            <li><a href="{{ route('admin.about-us', ['lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
                            <form action="{{ route('admin.update-about-us') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">

                                @if (admin_lang() == request()->get('lang_code'))

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="h_300_w_250" src="{{ asset($about_us->about_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" class="form-control-file" name="about_image">
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Existing CEO Image')}}</label>
                                                <div>
                                                    <img src="{{ asset($about_us->ceo_avatar) }}" alt="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{__('admin.New Image')}}</label>
                                                <input type="file" class="form-control-file" name="ceo_avatar">
                                            </div>


                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Existing Signeture')}}</label>
                                                <div>
                                                    <img src="{{ asset($about_us->ceo_signeture) }}" alt="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{__('admin.New Signeture')}}</label>
                                                <input type="file" class="form-control-file" name="ceo_signeture">
                                            </div>
                                        </div>

                                    </div>

                                @endif

                                <div class="form-group">
                                    <label for="">{{__('admin.Header')}}</label>
                                    <input type="text" class="form-control" name="header" value="{{ $translate->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Title')}}</label>
                                    <input type="text" class="form-control" name="title" value="{{ $translate->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Description')}}</label>
                                    <textarea name="description" class="summernote" id="" cols="30" rows="10">{{ $translate->description }}</textarea>

                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.CEO Name')}}</label>
                                    <input type="text" class="form-control" name="ceo_name" value="{{ $translate->ceo_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.CEO Designation')}}</label>
                                    <input type="text" class="form-control" name="ceo_designation" value="{{ $translate->ceo_designation }}">
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
