@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Create Service')}}</title>
@endsection
@section('influencer-content')
<style>
    .disabled-button {
        cursor: not-allowed !important;
        opacity: 0.6;
    }
</style>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Create Service')}}</h1>

      </div>

      <form action="{{ route('influencer.service.store') }}" method="POST" enctype="multipart/form-data" id="serviceForm">
        @csrf
      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('admin.Basic Information')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>{{__('admin.Image')}} <span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" name="image">
                        </div>

                        @isset($influencer_subscription_fees)
                        <div class="form-group pl-3 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree_fees" class="custom-control-input" id="agree_fees">
                                <label class="custom-control-label" for="agree_fees">I agree to the {{ $influencer_subscription_fees->fees_type == 'percentage' ? $influencer_subscription_fees->fees . '%' : '$' . $influencer_subscription_fees->fees }} processing fee <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title=""
                                    data-original-title="This fee applies to influencers. When an influencer books this service, a {{ $influencer_subscription_fees->fees_type == 'percentage' ? $influencer_subscription_fees->fees . '%' : '$' . $influencer_subscription_fees->fees }} fee will be added to their total charge.">
                                    <span class="text-danger">*</span>
                                </span>
                                </label>
                            </div>
                            <small id="checkboxMessage" class="text-danger ">Please check this box to proceed.</small>
                        </div>
                        @endisset

                        <div class="form-group col-12">
                            <label>{{__('admin.Service Name')}} <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                            <input id="slug" type="text" class="form-control" name="slug">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Price')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="price">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Category')}} <span class="text-danger">*</span></label>
                            <select name="category_id" id="" class="form-control select2">
                                <option value="">{{__('admin.Select')}}</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->translate->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>
                            <textarea name="description" id="" class="summernote" cols="30" rows="10"></textarea>
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

                        <div class="form-group col-12">
                            <label>{{__('admin.Tags')}}</label>
                            <input type="text" class="form-control tags" name="tags" autocomplete="off">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Seo Title')}}</label>
                            <input type="text" class="form-control" name="seo_title" autocomplete="off">
                        </div>
                        <div class="form-group col-12">
                            <label>{{__('admin.Seo Description')}}</label>
                            <textarea name="seo_description" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                        </div>

                    </div>

                    <button class="btn btn-primary disabled-button" type="submit" disabled id="submitBtn">{{__('admin.Save Service')}}</button>
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

    $(document).ready(function () {
        $("#agree_fees").change(function () {
            if ($(this).is(":checked")) {
                $("#submitBtn").prop("disabled", false).removeClass("disabled-button");
                $("#checkboxMessage").addClass("d-none"); // Hide message
            } else {
                $("#submitBtn").prop("disabled", true).addClass("disabled-button");
                $("#checkboxMessage").removeClass("d-none"); // Show message
            }
        });

        // Show message when clicking disabled button
        $("#submitBtn").click(function (event) {
            if ($(this).prop("disabled")) {
                event.preventDefault(); // Prevent form submission
                $("#checkboxMessage").removeClass("d-none"); // Show message
            }
        });
    });
</script>

@endsection
