@
@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Subscription Fee')}}</title>
@endsection
@section('admin-content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Subscription Fees') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.subscription-plan.index') }}" class="btn btn-primary"><i
                                    class="fa fa-arrow-left"></i> {{ __('admin.Go Back') }}</a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.store-subscription-fee') }}" method="POST">
                                <!-- Subscription Fee Type -->
                                @csrf
                                <div class="form-group col-md-12">
                                    <label for="">{{__('admin.User Type')}} <span class="text-danger">*</span></label>
                                    <select name="user_type" id="userType" class="form-control">
                                        <option value="business">{{__('admin.Business')}}</option>
                                        <option value="influencer">{{__('admin.Influencer')}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fees_type">{{ __('Subscription Fee Type') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="fees_type" id="businessFeesType" class="form-control">
                                        <option {{ isset($busisess_fees) && $busisess_fees->fees_type == 'fixed' ?
                                            'selected' : '' }} value="fixed">{{ __('Fixed Amount ($)') }}</option>
                                        <option {{ isset($busisess_fees) && $busisess_fees->fees_type == 'percentage' ?
                                            'selected' : '' }} value="percentage">{{ __('Percentage (%)') }}</option>
                                    </select>

                                    <select name="fees_type" id="influencerFeesType" class="form-control"
                                        style="display: none;">
                                        <option {{ isset($influencer_fees) && $influencer_fees->fees_type == 'fixed' ?
                                            'selected' : '' }} value="fixed">{{ __('Fixed Amount ($)') }}</option>
                                        <option {{ isset($influencer_fees) && $influencer_fees->fees_type ==
                                            'percentage' ? 'selected' : '' }} value="percentage">{{ __('Percentage (%)')
                                            }}</option>
                                    </select>
                                </div>

                                <!-- Subscription Fee Amount -->
                                <div class="form-group col-md-12">
                                    <label for="fees_amount">{{ __('Subscription Fee Amount') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="business_fees_amount" id="businessFeesAmount"
                                        class="form-control" min="0" step="0.01" placeholder="Enter fee amount"
                                        value="{{ isset($busisess_fees) ? $busisess_fees->fees : '' }}">
                                    <input type="number" name="influencer_fees_amount" id="influencerFeesAmount"
                                        class="form-control" min="0" step="0.01" placeholder="Enter fee amount"
                                        value="{{ isset($influencer_fees) ? $influencer_fees->fees : '' }}"
                                        style="display: none;">
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </section>

    <div class="section-body">
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-dark">
                            Subscription Fees List
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Serial</th>
                                        <th>User Type</th>
                                        <th>Subscription Fee Type</th>
                                        <th>Subscription Fee amount</th>
                                    </tr>

                                   @if (isset($busisess_fees))
                                    <tr>
                                        <td>1</td>
                                        <td>Business</td>
                                        <td>{{ $busisess_fees->fees_type }}</td>
                                        <td>{{ $busisess_fees->fees_type == 'percentage' ? $busisess_fees->fees . '%' : '$' .$busisess_fees->fees }}</td>
                                    </tr>
                                    @endif

                                    @if (isset($influencer_fees))
                                    <tr>
                                        <td>2</td>
                                        <td>Influencer</td>
                                        <td>{{ $influencer_fees->fees_type }}</td>
                                        <td>{{$influencer_fees->fees_type == 'percentage' ? $influencer_fees->fees . '%' : '$' .$influencer_fees->fees  }}</td>
                                    </tr>
                                    @endif

                                    @if (!isset($busisess_fees) && !isset($influencer_fees))
                                    <tr>
                                        <td colspan="4">No data found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery for Dynamic Placeholder -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    $(document).ready(function () {

        $('#userType').change(function () {
            var selectedType = $(this).val();
            if (selectedType === 'business') {
                $('#businessFeesType').show();
                $('#businessFeesAmount').show();
                $('#influencerFeesType').hide();
                $('#influencerFeesAmount').hide();
            } else {
                $('#influencerFeesType').show();
                $('#influencerFeesAmount').show();
                $('#businessFeesType').hide();
                $('#businessFeesAmount').hide();
            }
        });

        $businessFeesType = $('#businessFeesType').val();
        if ($businessFeesType === 'percentage') {
            $('#businessFeesAmount').attr('placeholder', 'Enter percentage (e.g. 10 for 10%)');
        } else {
            $('#businessFeesAmount').attr('placeholder', 'Enter fixed amount (e.g. 50 for $50)');
        }
        $('#businessFeesType').change(function () {
            var selectedType = $(this).val();
            if (selectedType === 'percentage') {
                $('#businessFeesAmount').attr('placeholder', 'Enter percentage (e.g. 10 for 10%)');
            } else {
                $('#businessFeesAmount').attr('placeholder', 'Enter fixed amount (e.g. 50 for $50)');
            }
        });

        $influencerFeesType = $('#influencerFeesType').val();
        if ($influencerFeesType === 'percentage') {
            $('#influencerFeesAmount').attr('placeholder', 'Enter percentage (e.g. 10 for 10%)');
        } else {
            $('#influencerFeesAmount').attr('placeholder', 'Enter fixed amount (e.g. 50 for $50)');
        }
        $('#influencerFeesType').change(function () {
            var selectedType = $(this).val();
            if (selectedType === 'percentage') {
                $('#influencerFeesAmount').attr('placeholder', 'Enter percentage (e.g. 10 for 10%)');
            } else {
                $('#influencerFeesAmount').attr('placeholder', 'Enter fixed amount (e.g. 50 for $50)');
            }
        });

        // $type = $('#fees_type').val();
        // if ($type === 'percentage') {
        //     $('#fees_amount').attr('placeholder', 'Enter percentage (e.g. 10 for 10%)');
        // } else {
        //     $('#fees_amount').attr('placeholder', 'Enter fixed amount (e.g. 50 for $50)');
        // }
        // $('#fees_type').change(function () {
        //     var selectedType = $(this).val();
        //     if (selectedType === 'percentage') {
        //         $('#fees_amount').attr('placeholder', 'Enter percentage (e.g. 10 for 10%)');
        //     } else {
        //         $('#fees_amount').attr('placeholder', 'Enter fixed amount (e.g. 50 for $50)');
        //     }
        // });
    });
</script>
@endsection
