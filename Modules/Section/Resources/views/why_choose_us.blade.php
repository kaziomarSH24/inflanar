@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Why Choose Us')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Why Choose Us')}}</h1>
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
                                    <li><a href="{{ route('admin.why-choose-us', ['lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
                        <h5>{{__('admin.Home two')}}</h5>
                        <hr>
                        <form action="{{ route('admin.home2-why-choose-us') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">

                            @if (admin_lang() == request()->get('lang_code'))
                            <div class="form-group">
                                <label for="">{{__('admin.Existing Image')}}</label>
                                <div>
                                    <img class="h_300_w_250" src="{{ asset($why_choose_us->home2_image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Image')}}</label>
                                <input type="file" name="home2_image" class="form-control-file">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing foreground')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home2_foreground1) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New foreground')}}</label>
                                        <input type="file" name="home2_foreground1" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing foreground')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($why_choose_us->home2_foreground2) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New foreground')}}</label>
                                        <input type="file" name="home2_foreground2" class="form-control-file">
                                    </div>
                                </div>
                            </div>

                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="home2_title" class="form-control" value="{{ $translate->home2_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Header')}}</label>
                                <input type="text" name="home2_header" class="form-control" value="{{ $translate->home2_header }}">
                            </div>


                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <textarea name="home2_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home2_description }}</textarea>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing icon one')}}</label>
                                        <div>
                                            <img src="{{ asset($why_choose_us->home2_icon1) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="home2_icon1" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home2_item1" class="form-control" value="{{ $translate->home2_item1 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home2_des1" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home2_des1 }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing icon one')}}</label>
                                        <div>
                                            <img src="{{ asset($why_choose_us->home2_icon2) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="home2_icon2" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home2_item2" class="form-control" value="{{ $translate->home2_item2 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home2_des2" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home2_des2 }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing icon one')}}</label>
                                        <div>
                                            <img src="{{ asset($why_choose_us->home2_icon3) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="home2_icon3" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home2_item3" class="form-control" value="{{ $translate->home2_item3 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home2_des3" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home2_des3 }}</textarea>
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
                        <h5>{{__('admin.Home three')}}</h5>
                        <hr>
                        <form action="{{ route('admin.home3-why-choose-us') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">

                            @if (admin_lang() == request()->get('lang_code'))
                            <div class="form-group">
                                <label for="">{{__('admin.Existing Image')}}</label>
                                <div>
                                    <img class="h_300_w_250" src="{{ asset($why_choose_us->home3_image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Image')}}</label>
                                <input type="file" name="home3_image" class="form-control-file">
                            </div>

                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="home3_title" class="form-control" value="{{ $translate->home3_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Header')}}</label>
                                <input type="text" name="home3_header" class="form-control" value="{{ $translate->home3_header }}">
                            </div>


                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <textarea name="home3_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home3_description }}</textarea>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing icon one')}}</label>
                                        <div>
                                            <img src="{{ asset($why_choose_us->home3_icon1) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="home3_icon1" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home3_item1" class="form-control" value="{{ $translate->home3_item1 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home3_des1" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home3_des1 }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing icon one')}}</label>
                                        <div>
                                            <img src="{{ asset($why_choose_us->home3_icon2) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="home3_icon2" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home3_item2" class="form-control" value="{{ $translate->home3_item2 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home3_des2" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home3_des2 }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing icon one')}}</label>
                                        <div>
                                            <img src="{{ asset($why_choose_us->home3_icon3) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="home3_icon3" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home3_item3" class="form-control" value="{{ $translate->home3_item3 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="home3_des3" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->home3_des3 }}</textarea>
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
