@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Service')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Edit Service')}}</h1>

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
                      <li><a href="{{ route('admin.service.edit', ['service' => $service->id, 'lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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


      <form action="{{ route('admin.service.update', $service->id) }}" method="POST" enctype="multipart/form-data" id="serviceForm">
        @csrf
        @method('PUT')

        <input type="hidden" name="lang_code" value="{{ $translate->lang_code }}">
        <input type="hidden" name="translate_id" value="{{ $translate->id }}">

      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('admin.Basic Information')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">

                        @if (admin_lang() == request()->get('lang_code'))
                        <div class="form-group col-12">
                            <label>{{__('admin.Existing image')}} </label>
                            <div>
                                <img src="{{ asset($service->thumbnail_image) }}" alt="" class="w_120">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Image')}}</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Influencer')}} <span class="text-danger">*</span></label>
                            <select name="influencer_id" id="" class="form-control select2">
                                <option value="">{{__('admin.Select Influencer')}}</option>
                                @foreach ($providers as $provider)
                                <option {{ $provider->id == $service->influencer_id ? 'selected' : '' }} value="{{ $provider->id }}">{{ $provider->name .' - '. $provider->username }}</option>
                                @endforeach
                            </select>
                        </div>

                       @endif

                        <div class="form-group col-12">
                            <label>{{__('admin.Service Name')}} <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $translate->title }}">
                        </div>

                        @if (admin_lang() == request()->get('lang_code'))
                        <div class="form-group col-12">
                            <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                            <input id="slug" type="text" class="form-control" name="slug" value="{{ $service->slug }}">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Price')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="price" value="{{ $service->price }}">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Category')}} <span class="text-danger">*</span></label>
                            <select name="category_id" id="" class="form-control select2">
                                <option value="">{{__('admin.Select')}}</option>
                                @foreach ($categories as $category)
                                <option {{ $category->id == $service->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->translate->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @endif

                        <div class="form-group col-12">
                            <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>
                            <textarea name="description" id="" class="summernote" cols="30" rows="10">{{ $translate->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('admin.Package Features')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row" id="package_feature_box">
                        @if ($translate->features)
                            @foreach (json_decode($translate->features) as $feature)
                                @if ($feature)
                                    <div class="col-12 pacakge_feature_row">
                                        <div class="row">
                                            <div class="form-group col-md-10">
                                                <label>{{__('admin.Feature')}}</label>
                                                <input type="text" class="form-control" name="package_features[]" autocomplete="off" value="{{ $feature }}">
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
                                    <input type="text" class="form-control" name="package_features[]" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" type="button" id="addNewPackageFeature" class="btn btn-success btn_mt_33"><i class="fa fa-plus" aria-hidden="true"></i> {{__('admin.Add New')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('admin.Seo Information & Others')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if (admin_lang() == request()->get('lang_code'))
                        <div class="form-group col-12">
                            <label>{{__('admin.Tags')}}</label>
                            <input type="text" class="form-control tags" name="tags" autocomplete="off" value="{{ $service->tags }}">
                        </div>
                        @endif

                        <div class="form-group col-12">
                            <label>{{__('admin.Seo Title')}}</label>
                            <input type="text" class="form-control" name="seo_title" autocomplete="off" value="{{ $translate->seo_title }}">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Seo Description')}}</label>
                            <textarea name="seo_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->seo_description }}</textarea>
                        </div>

                        @if (admin_lang() == request()->get('lang_code'))
                        <div class="form-group col-12">
                            <label>{{__('admin.Status')}}</label>
                            <select name="status" id="" class="form-control">
                                <option {{ $service->status == 'active' ? 'selected' : '' }} value="active">{{__('admin.Active')}}</option>
                                <option {{ $service->status == 'inactive' ? 'selected' : '' }} value="inactive">{{__('admin.Inactive')}}</option>
                            </select>
                        </div>

                        @if ($service->approve_by_admin == 'disable')
                            <div class="form-group col-12">
                                <label>{{__('admin.Service approval request')}}</label>
                                <select name="approve_by_admin" id="" class="form-control">
                                    <option value="disable">{{__('admin.Reject')}}</option>
                                    <option value="enable">{{__('admin.Yes, Approved')}}</option>
                                </select>
                            </div>
                        @endif

                        @if ($service->approve_by_admin == 'enable')
                            <div class="form-group col-12">
                                <label>{{__('admin.Want to banned ?')}}</label>
                                <select name="is_banned" id="" class="form-control">
                                    <option {{ $service->is_banned == 'enable' ? 'selected' : '' }} value="enable">{{__('admin.Yes, Banned')}}</option>
                                    <option {{ $service->is_banned == 'disable' ? 'selected' : '' }} value="disable">{{__('admin.No')}}</option>
                                </select>
                            </div>
                        @endif


                        @endif
                    </div>

                    <button class="btn btn-primary" type="submit">{{__('admin.Update Service')}}</button>
                </div>


            </div>
          </div>
        </div>
      </div>

    </form>

    </section>
  </div>

 <script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })
            // start package feature section
            $("#addNewPackageFeature").on("click", function(){
                let package_feature = `
                    <div class="col-12 pacakge_feature_row">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>{{__('admin.Feature')}}</label>
                                <input type="text" class="form-control" name="package_features[]" autocomplete="off">
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

    function convertToSlug(Text)
    {
        return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-');
    }
</script>

@endsection
