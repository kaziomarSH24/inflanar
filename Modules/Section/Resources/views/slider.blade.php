@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Intro section')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Intro section')}}</h1>
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
                                    <li><a href="{{ route('admin.slider', ['lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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

            @php
                $label = 'For colorfull header, write the header inside "<span>Header Here</span>" tag'
            @endphp
          <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <h5>{{__('admin.Home One')}}</h5>
                        <hr>
                        <form action="{{ route('admin.home1-slider') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">

                            @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing client image')}}</label>
                                        <div>
                                            <img src="{{ asset($slider->client_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New client image')}}</label>
                                        <input type="file" name="client_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="h_300_w_250"src="{{ asset($slider->home1_feature_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="home1_feature_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Satisfied client')}}</label>
                                        <input type="text" name="client_qty" class="form-control" value="{{ $slider->client_qty }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Popular Tags')}}</label>
                                        <input type="text" name="tags" class="form-control tags" value="{{ $slider->tags }}">
                                    </div>

                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home1_title" class="form-control" value="{{ $translate->home1_title }}">
                                    </div>

                                    <div class="form-group">

                                        <label for="">{{__('admin.Header')}} <span class="text-danger">({{ $label }}) </span></label>
                                        <input type="text" name="home1_header" class="form-control" value="{{ $translate->home1_header }}">
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
                        <h5>{{__('admin.Home Two')}}</h5>
                        <hr>
                        <form action="{{ route('admin.home2-slider') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">

                            @if (admin_lang() == request()->get('lang_code'))

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_200"src="{{ asset($slider->home2_bg) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="home2_bg" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing slider')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($slider->home2_feature_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New slider')}}</label>
                                        <input type="file" name="home2_feature_image" class="form-control-file">
                                    </div>



                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="home2_title" class="form-control" value="{{ $translate->home2_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Header')}} <span class="text-danger">({{ $label }}) </span></label>
                                        <input type="text" name="home2_header" class="form-control" value="{{ $translate->home2_header }}">
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
                        <form action="{{ route('admin.home3-slider') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">

                                @if (admin_lang() == request()->get('lang_code'))

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="h_300_w_250"src="{{ asset($slider->home3_feature_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="home3_feature_image" class="form-control-file">
                                    </div>

                                @endif

                                <div class="form-group">
                                    <label for="">{{__('admin.Title')}}</label>
                                    <input type="text" name="home3_title" class="form-control" value="{{ $translate->home3_title }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Header')}} </label>
                                    <input type="text" name="home3_header" class="form-control" value="{{ $translate->home3_header }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Item one')}} </label>
                                    <input type="text" name="home3_item1" class="form-control" value="{{ $translate->home3_item1 }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Item two')}} </label>
                                    <input type="text" name="home3_item2" class="form-control" value="{{ $translate->home3_item2 }}">
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
