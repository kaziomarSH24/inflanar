@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Additional Service')}}</title>
@endsection
@section('influencer-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Additional Service')}}</h1>
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
                          <li><a href="{{ route('influencer.additional-edit', ['id' => $additional->id, 'lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
            <a href="{{ route('influencer.additional-service', $service->id) }}" class="btn btn-primary"><i class="fas fa-backward"></i> {{__('admin.Go Back')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('influencer.additional-update', $additional->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">
                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">

                            @if (front_lang() == request()->get('lang_code'))
                            <div class="form-group">
                                <label for="">{{__('admin.Existing Image')}}</label>
                                <div>
                                    <img class="w_120" src="{{ asset($additional->image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Image')}}</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>

                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="title" class="form-control" value="{{ $translate->title }}">
                            </div>

                            @if (front_lang() == request()->get('lang_code'))
                            <div class="form-group">
                                <label for="">{{__('admin.Price')}}</label>
                                <input type="text" name="price" class="form-control" value="{{ $additional->price }}">
                            </div>

                            @endif
                            <div class="row" id="package_feature_box">
                                @if ($translate->features)
                                    @foreach (json_decode($translate->features) as $feature)
                                        @if ($feature)
                                            <div class="col-12 pacakge_feature_row">
                                                <div class="row">
                                                    <div class="form-group col-md-10">
                                                        <label>{{__('admin.Feature')}}</label>
                                                        <input type="text" class="form-control" name="features[]" autocomplete="off" value="{{ $feature }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn_mt_33 delete_package_feature"><i class="fa fa-trash" aria-hidden="true"></i> {{__('admin.Remove')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <label>{{__('admin.Feature')}}</label>
                                            <input type="text" class="form-control" name="features[]" autocomplete="off">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" type="button" id="addNewPackageFeature" class="btn btn-success btn_mt_33"><i class="fa fa-plus" aria-hidden="true"></i> {{__('admin.Add New')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary">{{__('admin.Save')}}</button>
                        </form>

                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>



 <script>
    (function($) {
        "use strict";
        $(document).ready(function () {

            // start package feature section
            $("#addNewPackageFeature").on("click", function(){
                let package_feature = `
                    <div class="col-12 pacakge_feature_row">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>{{__('admin.Feature')}}</label>
                                <input type="text" class="form-control" name="features[]" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn_mt_33 delete_package_feature"><i class="fa fa-trash" aria-hidden="true"></i> {{__('admin.Remove')}}</button>
                            </div>
                        </div>
                    </div>`;
                $("#package_feature_box").append(package_feature)
            });

            $(document).on('click', '.delete_package_feature', function () {
                $(this).closest('.pacakge_feature_row').remove();
            });

            // end package feature

        })
    })(jQuery);

</script>

@endsection
