@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Our Feature')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Our Feature')}}</h1>
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
                                    <li><a href="{{ route('admin.our-feature', ['lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
                        <form action="{{ route('admin.update-our-feature') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">

                            <div class="row">
                                <div class="col-md-6">

                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Icon')}}</label>
                                        <div>
                                            <img src="{{ asset($our_feature->icon1) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Icon')}}</label>
                                        <input type="file" name="icon1" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="title1" class="form-control" value="{{ $translate->title1 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="description1" class="form-control text-area-3" id="" cols="30" rows="10">{{ $translate->description1 }}</textarea>
                                    </div>

                                </div>


                                <div class="col-md-6">

                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Icon')}}</label>
                                        <div>
                                            <img src="{{ asset($our_feature->icon2) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Icon')}}</label>
                                        <input type="file" name="icon2" class="form-control-file">
                                    </div>

                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="title2" class="form-control" value="{{ $translate->title2 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="description2" class="form-control text-area-3" id="" cols="30" rows="10">{{ $translate->description2 }}</textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Icon')}}</label>
                                        <div>
                                            <img src="{{ asset($our_feature->icon3) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Icon')}}</label>
                                        <input type="file" name="icon3" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="title3" class="form-control" value="{{ $translate->title3 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="description3" class="form-control text-area-3" id="" cols="30" rows="10">{{ $translate->description3 }}</textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Icon')}}</label>
                                        <div>
                                            <img src="{{ asset($our_feature->icon4) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Icon')}}</label>
                                        <input type="file" name="icon4" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="title4" class="form-control" value="{{ $translate->title4 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="description4" class="form-control text-area-3" id="" cols="30" rows="10">{{ $translate->description4 }}</textarea>
                                    </div>

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
