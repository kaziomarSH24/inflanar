@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Assign Plan')}}</title>
@endsection
@section('admin-content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Assign Plan')}}</h1>

        </div>

        <div class="section-body">
            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <a href="{{ route('admin.purchase-history') }}" class="btn btn-primary"><i
                                    class="fa fa-arrow-left"></i>
                                {{__('admin.Go Back')}}</a>

                        </div>

                        <div class="card-body">

                            <form action="{{route('admin.store-assign-plan')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.User Type')}} <span
                                                class="text-danger">*</span></label>
                                        <select name="type" id="userType" class="form-control">
                                            <option value="business">{{__('admin.Business')}}</option>
                                            <option value="influencer">{{__('admin.Influencer')}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Select Plan')}} <span class="text-danger">*</span></label>
                                        <select name="plan_id" id="planSelect" class="form-control">
                                            <option value="">{{__('admin.Select')}}</option>
                                            @foreach ($business_plans as $plan)
                                                <option value="{{ $plan->id }}" data-type="business">{{ $plan->plan_name }}</option>
                                            @endforeach
                                            @foreach ($influencer_plans as $plan)
                                                <option value="{{ $plan->id }}" data-type="influencer" style="display: none;">{{ $plan->plan_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="" id="maxService">{{__('admin.Maximum Service')}} <span data-toggle="tooltip"
                                                data-placement="top" class="fa fa-info-circle text--primary"
                                                title="For unlimited service use(-1)"> <span
                                                    class="text-danger">*</span></label>
                                        <label for="" id="maxApplies" style="display: none">{{__('admin.Maximum Applies')}} <span data-toggle="tooltip"
                                                data-placement="top" class="fa fa-info-circle text--primary"
                                                title="For unlimited service use(-1)"> <span
                                                    class="text-danger">*</span></label>
                                        <input type="number" name="maximum_service" class="form-control form_control">
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

                                    {{-- @dd($business_providers['user_type']) --}}

                                    <div class="form-group col-12">
                                        <label for="" id="businessLbl">{{__('admin.Select Business Provider')}} <span
                                                class="text-danger">*</span></label>
                                        <label for="" id="influencerLbl" style="display: none">{{__('admin.Select Influencer')}} <span
                                                class="text-danger">*</span></label>
                                        @if ($business_providers['user_type'] == 'business')
                                        <div id="businessProviders">
                                            <select name="provider_id" id="" class="form-control select2 " data-type="business">
                                                <option value="" >{{__('admin.Select')}}</option>

                                                @foreach ($business_providers['users'] as $provider)
                                                <option value="{{ $provider->id }}">{{ $provider->name }} - {{
                                                    $provider->phone }} - {{ $provider->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                        @if ($influencers['user_type'] == 'influencer')
                                        <div id="influencerProviders" style="display: none">
                                            <select name="influncer_id"  class="form-control select2" style="display: none" data-type="influencer">
                                                <option value="">{{__('admin.Select')}}</option>
                                                @foreach ($influencers['users'] as $provider)
                                                <option value="{{ $provider->id }}" >{{ $provider->name }} - {{
                                                    $provider->phone }} - {{ $provider->email }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">{{__('admin.Assign Plan')}}</button>
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
@endsection

@push('subscription-script')
<script>
    $(document).ready(function () {
        $('#userType').change(function () {
            var selectedType = $(this).val();
            $('#planSelect option').each(function () {
                if ($(this).data('type') === selectedType) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#planSelect').val($('#planSelect option:visible:first').val());



            //select provider
            if(selectedType == 'business'){
                $('#businessLbl').show();
                $('#influencerLbl').hide();
                $('#businessLbl select').show();
                $('#influencerLbl select').hide();

                $('#maxService').show();
                $('#maxApplies').hide();

                $('#businessProviders').show();
                $('#influencerProviders').hide();
            }else{
                $('#businessLbl').hide();
                $('#influencerLbl').show();
                $('#businessLbl select').hide();
                $('#influencerLbl select').show();

                $('#maxService').hide();
                $('#maxApplies').show();

                $('#businessProviders').hide();
                $('#influencerProviders').show();

            }

        });
    });
</script>
@endpush

