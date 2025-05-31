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

        <form action="{{ route('influencer.store-service-in-session') }}" method="POST" enctype="multipart/form-data"
            id="serviceForm">
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

                                    @isset($business_subscription_fees)
                                    {{-- @dd($business_subscription_fees) --}}
                                    <div class="form-group pl-3 col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="agree_fees" class="custom-control-input"
                                                id="agree_fees" data-fees="{{ $business_subscription_fees->fees }}"
                                                data-fees-type="{{ $business_subscription_fees->fees_type }}">
                                            <label class="custom-control-label" for="agree_fees">I agree to a {{
                                                $business_subscription_fees->fees_type == 'percentage' ?
                                                $business_subscription_fees->fees . '%' : '$' .
                                                $business_subscription_fees->fees }} processing fee <span
                                                    data-toggle="tooltip" data-placement="top"
                                                    class="fa fa-info-circle text--primary" title=""
                                                    data-original-title="This fee applies when paying for campaigns a {{ $business_subscription_fees->fees_type == 'percentage' ? $business_subscription_fees->fees . '%' : '$' . $business_subscription_fees->fees }} platform fee will be taken from the total amount.">
                                                    <span class="text-danger">*</span>
                                                </span>
                                            </label>
                                        </div>
                                        <small id="checkboxMessage" class="text-danger ">Please check this box to
                                            proceed.</small>
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
                                        <input id="price" type="text" class="form-control" name="price">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Category')}} <span class="text-danger">*</span></label>
                                        <select name="category_id" id="" class="form-control select2">
                                            <option value="">{{__('admin.Select')}}</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->translate->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>
                                        <textarea name="description" id="" class="summernote" cols="30"
                                            rows="10"></textarea>
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
                                                <input type="text" class="form-control" name="package_features[]"
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" type="button" id="addNewPackageFeature"
                                                    class="btn btn-success btn_mt_33"><i class="fa fa-plus"
                                                        aria-hidden="true"></i> {{__('admin.Add New')}}</button>
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
                                        <textarea name="seo_description" class="form-control text-area-5" id=""
                                            cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>{{__('admin.Total Campaign Spand')}}</label>
                                        <input id="totalCampaign" type="text" class="form-control" name="total_campaign"
                                            autocomplete="off">
                                    </div>
                                </div>


                                <button class="btn btn-primary disabled-button" type="submit" disabled
                                    id="submitBtn">{{__('admin.Pay Now')}}</button>
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
        $("#agree_fees, #price").on('change keyup',function () {
            let isChecked = $("#agree_fees").is(":checked");
            let fees = $('#agree_fees').data('fees');
            let feesType = $('#agree_fees').data('fees-type');
            let priceInput = $("#price").val();
            let price = parseFloat(priceInput);
            let totalCampaign = $("#totalCampaign");

            if (isChecked) {
                $("#submitBtn").prop("disabled", false).removeClass("disabled-button");
                $("#checkboxMessage").addClass("d-none"); // Hide message
            } else {
                $("#submitBtn").prop("disabled", true).addClass("disabled-button");
                $("#checkboxMessage").removeClass("d-none"); // Show message
            }

            if (isChecked && priceInput !== "" && !isNaN(price)) {
        if (feesType === 'percentage') {
            let totalAmount = price + (price * fees / 100);
            totalCampaign.val(totalAmount.toFixed(2));
        } else if (feesType === 'fixed') {
            let totalAmount = price + parseFloat(fees);
            totalCampaign.val(totalAmount.toFixed(2));
        }
    } else {
        if (!isNaN(price)) {
            totalCampaign.val(price.toFixed(2));
        } else {
            totalCampaign.val('');
        }
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
