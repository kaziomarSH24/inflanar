@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create Plan')}}</title>
@endsection
@section('admin-content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Create Plan')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <a href="{{ route('admin.subscription-plan.index') }}" class="btn btn-primary"><i
                                    class="fa fa-arrow-left"></i> {{__('admin.Go Back')}}</a>

                        </div>

                        <div class="card-body">

                            <form action="{{route('admin.subscription-plan.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Plan For')}} <span
                                                class="text-danger">*</span></label>
                                        <select name="type" id="userType" class="form-control">
                                            <option value="business">{{__('admin.Business')}}</option>
                                            <option value="influencer">{{__('admin.Influencer')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Plan Name')}} <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="plan_name" class="form-control form_control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Plan Price')}} <span data-toggle="tooltip"
                                                data-placement="top" class="fa fa-info-circle text--primary"
                                                title="For free plan use(0)"> <span class="text-danger">*</span></label>
                                        <input type="text" name="plan_price" class="form-control form_control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Expiration Date')}} <span
                                                class="text-danger">*</span></label>

                                        <select name="expiration_date" id="" class="form-control">
                                            <option value="daily">{{__('admin.Daily')}}</option>
                                            <option value="monthly">{{__('admin.Monthly')}}</option>
                                            {{-- <option value="yearly">{{__('admin.Yearly')}}</option> --}}
                                            <option value="lifetime">{{__('admin.Lifetime')}}</option>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="" id="maxService">{{__('admin.Maximum Service')}} <span
                                                data-toggle="tooltip" data-placement="top"
                                                class="fa fa-info-circle text--primary"
                                                title="For unlimited service use(-1)"> <span
                                                    class="text-danger">*</span></label>
                                        <label for="" id="maxApplies" style="display: none">{{__('admin.Maximum
                                            Applies')}} <span data-toggle="tooltip" data-placement="top"
                                                class="fa fa-info-circle text--primary"
                                                title="For unlimited applies use(-1)"> <span
                                                    class="text-danger">*</span></label>
                                        <input type="number" name="maximum_service" class="form-control form_control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Serial')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="serial" class="form-control form_control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option value="1">{{__('admin.Active')}}</option>
                                            <option value="0">{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="row" id="addDescriptionBox">
                                            <div class="form-group col-8">
                                                <label>{{__('admin.Add Description')}}</label>
                                                <input type="text" class="form-control" name="description[]"
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <button type="button" type="button" id="addNewDecription"
                                                    class="btn btn-success btn_mt_33"><i class="fa fa-plus"
                                                        aria-hidden="true"></i> {{__('admin.Add New')}}</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function () {
        $('#userType').on('change', function () {
            var type = $(this).val();
            console.log('change');
            console.log(type);
            if (type == 'business') {
                $('#maxService').show();
                $('#maxApplies').hide();
            } else {
                $('#maxService').hide();
                $('#maxApplies').show();
            }
        });


        // Add new description field
        $('#addNewDecription').on('click', function () {
            var newDescription = `<div class="form-group col-8">
                                    <label>{{__('admin.Add Description')}}</label>
                                        <input type="text" class="form-control" name="description[]" autocomplete="off">
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-danger removeDescriptionBtn btn_mt_33"><i class="fa fa-trash"
                                                aria-hidden="true"></i> {{__('admin.Remove')}}</button>
                                    </div>`;
            $('#addDescriptionBox').append(newDescription);
        });

        // Remove description field
        $(document).on('click', '.removeDescriptionBtn', function () {
            var buttonWrapper = $(this).closest('.col-4');
            var inputWrapper = buttonWrapper.prev('.form-group.col-8');
            inputWrapper.remove();
            buttonWrapper.remove();
        });
    });
</script>
@endsection
