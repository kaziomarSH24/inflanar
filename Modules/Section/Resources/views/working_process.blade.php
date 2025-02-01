@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Working Proccess')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Working Proccess')}}</h1>
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
                                    <li><a href="{{ route('admin.working-proccess', ['lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
                        <h5>{{__('admin.Home one / Home two')}}</h5>
                        <hr>
                        <form action="{{ route('admin.home1-working-proccess') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">

                            <div class="row">
                                <div class="col-md-6">

                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home1_image1) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="home1_image1" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home1_title1" class="form-control" value="{{ $translate->home1_title1 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home1_description1" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home1_description1 }}</textarea>
                                    </div>

                                </div>


                                <div class="col-md-6">

                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home1_image2) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New image')}}</label>
                                        <input type="file" name="home1_image2" class="form-control-file">
                                    </div>

                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home1_title2" class="form-control" value="{{ $translate->home1_title2 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home1_description2" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home1_description2 }}</textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home1_image3) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New image')}}</label>
                                        <input type="file" name="home1_image3" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home1_title3" class="form-control" value="{{ $translate->home1_title3 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home1_description3" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home1_description3 }}</textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing image')}}</label>
                                        <div>
                                            <img class="w_200" class="w_200" src="{{ asset($why_choose_us->home1_image4) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New image')}}</label>
                                        <input type="file" name="home1_image4" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home1_title4" class="form-control" value="{{ $translate->home1_title4 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home1_description4" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home1_description4 }}</textarea>
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

          <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <h5>{{__('admin.Home Three')}}</h5>
                        <hr>
                        <form action="{{ route('admin.home3-working-proccess') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">

                            <div class="row">
                                <div class="col-md-6">

                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home3_image1) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="home3_image1" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home3_title1" class="form-control" value="{{ $translate->home3_title1 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home3_description1" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home3_description1 }}</textarea>
                                    </div>

                                </div>


                                <div class="col-md-6">

                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home3_image2) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New image')}}</label>
                                        <input type="file" name="home3_image2" class="form-control-file">
                                    </div>

                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home3_title2" class="form-control" value="{{ $translate->home3_title2 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home3_description2" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home3_description2 }}</textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home3_image3) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New image')}}</label>
                                        <input type="file" name="home3_image3" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home3_title3" class="form-control" value="{{ $translate->home3_title3 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home3_description3" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home3_description3 }}</textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home3_image4) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New image')}}</label>
                                        <input type="file" name="home3_image4" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home3_title4" class="form-control" value="{{ $translate->home3_title4 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home3_description4" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home3_description4 }}</textarea>
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
