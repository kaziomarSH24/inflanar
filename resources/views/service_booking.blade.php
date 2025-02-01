@extends('layout')
@section('title')
    <title>{{ $service->seo_title }}</title>
    @php
        $tags = '';
        if($service->tags){
            foreach (json_decode($service->tags) as $service_tag) {
                $tags .= $service_tag->value.', ';
            }
        }
    @endphp

    <meta name="keywords" content="{{ $tags }}">
    <meta name="title" content="{{ $service->seo_title }}">
    <meta name="description" content="{{ $service->seo_description }}">
@endsection
@section('frontend-content')

    <!-- Breadcrumbs -->
    <section class="inflanar-breadcrumb" style="background-image: url({{ asset($breadcrumb) }});">
        <div class="container">
            <div class="row">
                <!-- Breadcrumb-Content -->
                <div class="col-12">
                    <div class="inflanar-breadcrumb__inner">
                        <div class="inflanar-breadcrumb__content">
                            <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Services')}}</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                                <li class="active"><a href="javascript:;">{{__('admin.Services')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->


    <!-- Features -->
    <section class="pd-top-90 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 mg-top-30">

                    <!--Tab Nav -->
                    <div class="list-group inflanar-bdetail__tabnav" id="list-tab" role="tablist">
                        <a class="list-group-item active service_tab" data-bs-toggle="list" href="#in-tab6" role="tab">
                            <span>1</span> {{__('admin.Service')}}
                        </a>
                        <a class="list-group-item information_tab" data-bs-toggle="list" href="#in-tab7" role="tab">
                            <span>2</span> {{__('admin.Information')}}
                        </a>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content mg-top-30" id="nav-tabContent">
                        <!-- Single Tab -->
                        <div class="tab-pane fade active show basic_info_tab" id="in-tab6" role="tabpanel">

                            <div class="inflanar-sdetail">
                                <!-- Service Thumb -->
                                <div class="inflanar-sdetail__thumb">
                                    <img src="{{ asset($service->thumbnail_image) }}" alt="#">
                                </div>
                                <!-- Service Content -->
                                <div class="inflanar-sdetail__content">
                                    <h2 class="inflanar-sdetail__title mg-btm-20">{{ $service->title }}</h2>

                                    <div class="inflanar-sdetail__tcontent">

                                        {!! clean($service->description) !!}

                                         <h4 class="inflanar-sdetail__tcontent--title mg-top-40">{{__('admin.Package Features')}}</h4>
                                        <div class="row mg-btm-20">
                                            <div class="col-lg-6 col-12">
                                                <ul class="inflanar-list-style inflanar-list-style__grey  inflanar-list-style__row list-none">
                                                    @if ($service->features)
                                                        @foreach (json_decode($service->features) as $feature)
                                                            @if ($feature)
                                                            <li><img src="{{ asset('frontend/img/in-check-icon2.svg') }}">{{ $feature }}</li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Addon List -->
                            @if ($additionals->count() > 0)
                                <div class="inflanar-opackage mg-top-60">
                                    <h3 class="inflanar-opackage__title">{{__('admin.Upgrade your order with extras')}}</h3>
                                    <!-- Single Addon -->
                                    @foreach ($additionals as $additional)
                                        <div class="inflanar-opackage__single">
                                            <div class="inflanar-opackage__thumb">
                                                <img src="{{ asset($additional->image) }}" alt="#">
                                            </div>
                                            <div class="inflanar-opackage__scontent">
                                                <div class="inflanar-opackage__list">
                                                    <h4 class="inflanar-opackage__ltitle">{{ $additional->title }}</h4>
                                                    <ul class="inflanar-list-style inflanar-list-style__grey  inflanar-list-style__row list-none">
                                                        @if ($additional->features)
                                                            @foreach (json_decode($additional->features) as $add_feature)
                                                                @if ($add_feature)
                                                                <li><img src="{{ asset('frontend/img/in-check-circle.svg') }}">{{ $add_feature }}</li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="inflanar-opackage__aprice">
                                                    <div class="inflanar-opackage__apgroup">
                                                        <h4 class="inflanar-opackage__aamount">
                                                            {{ currency($additional->price) }}
                                                        </h4>
                                                        <a  href="javascript:;" class="inflanar-btn inflanar-btn__border add_extra_item" data-service_id="{{ $additional->id }}" data-service_price="{{ $additional->price }}" data-service_name="{{ $additional->title }}">{{__('admin.Add Now')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- End Single Addon -->
                                </div>
                            @endif
                            <div class="inflanar-step-buttons mg-top-60">
                                <button href="javascript:;" id="next_btn" class="inflanar-btn">{{__('admin.Next Step')}}</button>
                            </div>
                        </div>
                        <!-- End Single Tab -->

                        <!-- Single Tab -->
                        <div class="tab-pane fade booking_form_tab" id="in-tab7" role="tabpanel">

                            <div class="inflanar-sdetail">
                                <!-- Service Content -->
                                <div class="inflanar-sdetail__content">
                                    <h2 class="inflanar-sdetail__title m-0">{{__('admin.Booking Information')}}</h2>
                                    <form id="submitReadyToBooking">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12 mg-top-20">
                                                <div class="form-group inflanar-form-input">
                                                    <label>{{__('admin.Name')}}*</label>
                                                    <input class="ecom-wc__form-input" type="text" name="name" placeholder="{{__('admin.Name')}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 mg-top-20">
                                                <div class="form-group inflanar-form-input">
                                                    <label>{{__('admin.Email')}}</label>
                                                    <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('admin.Email')}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 mg-top-20">
                                                <div class="form-group inflanar-form-input">
                                                    <label>{{__('admin.Phone')}} *</label>
                                                    <input class="ecom-wc__form-input" type="text" name="phone" placeholder="{{__('admin.Phone')}}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-12 mg-top-20">
                                                <div class="form-group inflanar-form-input">
                                                    <label>{{__('admin.Your Address')}}*</label>
                                                    <input class="ecom-wc__form-input" type="text" name="address" placeholder="{{__('admin.Your Address')}}">
                                                </div>
                                            </div>
                                            <div class="col-12 mg-top-20">
                                                <div class="form-group inflanar-form-input">
                                                    <label>{{__('admin.Write Note')}}</label>
                                                    <div class="form-group inflanar-form-input">
                                                        <textarea placeholder="{{__('admin.Write something')}}" name="order_note"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="input_extra_total" name="extra_total" value="0.00">
                                        <input type="hidden" id="input_sub_total" name="sub_total" value="{{ $service->price }}">
                                        <input type="hidden" id="input_total" name="total" value="{{ $service->price }}">
                                        <input type="hidden" id="input_date" name="date" value="">
                                        <input type="hidden" id="schedule_time_slot" name="schedule_time_slot" value="">

                                        <div id="extra_input">
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="inflanar-step-buttons mg-top-60">
                                <button id="step-prev-button" type="submit" class="inflanar-btn inflanar-btn__border"><span>{{__('admin.Previous')}}</span></button>
                                <button id="goToPayment" class="inflanar-btn">{{__('admin.Next Step')}}</button>
                            </div>
                        </div>
                        <!-- End Single Tab -->
                    </div>
                </div>

                <div class="col-lg-3 col-12 mg-top-30">
                    <!-- Single Sidebar -->
                    <div class="book-single-sidebar">
                        <div id="service_available_dates" ></div>
                    </div>
                    <!-- Single Sidebar -->
                    <div class="book-single-sidebar mg-top-30">
                        <h4 class="book-single-sidebar__title">{{__('admin.Select Schedule')}}</h4>
                        <select class="property-sidebar__group inflanar-border" id="schedule_box">
                            <option value="">{{__('admin.Select')}}</option>
                        </select>
                    </div>
                    <!-- Single Sidebar -->
                    <div class="book-single-sidebar p-0 mg-top-30">
                        <div class="book-single-sidebar__summary">
                            <h4 class="book-single-sidebar__title">{{__('admin.Booking Summery')}}</h4>
                            <ul class="inflanar-list-style inflanar-list-style__white list-style-normal list-none">

                                @if ($service->features)
                                    @foreach (json_decode($service->features) as $feature)
                                        @if ($feature)
                                        <li><img src="{{ asset('frontend/img/in-check-icon3.svg') }}">{{ $feature }}</li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="inflanar-package-info">
                            <div class="inflanar-package-info__group">
                                <!-- Single Package Info -->
                                <div class="inflanar-package-info__single">
                                    <p><span><b>{{__('admin.Package Fee')}}</b></span>
                                        <span><b>
                                            {{ currency($service->price) }}
                                        </b></span>
                                    </p>
                                </div>
                                <!-- Single Package Info -->
                                <div class="inflanar-package-info__single">
                                    <p><span><b>{{__('admin.Extra Service')}}</b></span> <span><b class="extra_service_price">

                                        {{ currency(0.00) }}
                                    </b></span></p>
                                    <div class="extra_service_area">

                                    </div>

                                </div>

                                <!-- Single Package Info -->
                                <div class="inflanar-package-info__single">
                                    <p><span><b>{{__('admin.Total')}}</b></span> <span><b class="total_price">
                                        {{ currency($service->price) }}
                                    </b></span></p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features -->

<script>
    let currency_icon = "{{ Session::get('currency_icon') }}"
    let currency_position = "{{ Session::get('currency_position') }}"
    let currency_rate = "{{ Session::get('currency_rate') }}"


    let extra_services = [];

    (function($) {
    "use strict";
        $(document).ready(function () {

            $("#goToPayment").on("click", function(e){
                e.preventDefault();

                $.ajax({
                    type: 'post',
                    data: $('#submitReadyToBooking').serialize(),
                    url: "{{ route('store-booking-info-to-session') }}",
                    success: function (response) {
                        if(response.status == 'success'){
                            window.location = "{{ route('payment', $service->slug) }}";
                        }
                    },
                    error: function(error) {
                       console.log(error);
                       if(error.status == 422){
                            if(error.responseJSON.errors.address)toastr.error(error.responseJSON.errors.address[0])
                            if(error.responseJSON.errors.date)toastr.error(error.responseJSON.errors.date[0])
                            if(error.responseJSON.errors.name)toastr.error(error.responseJSON.errors.name[0])
                            if(error.responseJSON.errors.phone)toastr.error(error.responseJSON.errors.phone[0])
                            if(error.responseJSON.errors.schedule_time_slot)toastr.error(error.responseJSON.errors.schedule_time_slot[0])
                        }
                    }
                });

            })

            //Date and time
            $("#service_available_dates").flatpickr({
                minDate: "today",
                inline: true,
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "d-m-Y"
            });

            $("#service_available_dates").on("change", function(){
                let date_string = $(this).val();
                console.log(date_string);
                $("#input_date").val(date_string)
                let influencer_id = "{{ $service->influencer_id }}";
                $.ajax({
                    type: 'get',
                    data: {date : date_string, influencer_id : influencer_id},
                    url: "{{ route('get-available-schedule') }}",
                    success: function (response) {
                        if(response.is_available){
                            $("#schedule_box").html(response.available_schedules);
                        }else{
                            let html = `<option value="">{{__('admin.Select')}}</option>`;
                            $("#schedule_box").html(html);
                            $("#schedule_time_slot").val('');

                            toastr.error("{{__('admin.Schedule Not Found')}}")
                        }
                    },
                    error: function(error) {
                        let html = `<option value="">{{__('admin.Select')}}</option>`;
                        $("#schedule_box").html(html);
                        $("#schedule_time_slot").val('');

                        toastr.error("{{__('admin.Something went wrong')}}")
                    }
                });

            })

            $("#schedule_box").on("change", function(){
                $("#schedule_time_slot").val($(this).val());
            })

            $(".add_extra_item").on("click", function(){
                let add_id = $(this).data('service_id');
                let add_price = $(this).data('service_price');
                let add_name = $(this).data('service_name');
                let current_this = $(this);
                if(!extra_services.some(service => service.id == add_id)){
                    let arr = {
                        id : add_id,
                        name : add_name,
                        price : add_price,
                    };
                    extra_services.push(arr);

                    current_this.html("{{__('admin.Remove')}}");
                }else{
                    extra_services = extra_services.filter(service => service.id !== add_id)
                    current_this.html("{{__('admin.Add Now')}}");
                }

                load_extra_service()

            })
        });
    })(jQuery);


    function load_extra_service(){
        let html_service = '';
        let extra_price = 0.00;
        let extra_input = '';
        extra_services.forEach(service => {
            extra_price = (parseFloat(extra_price) +  parseFloat(service.price)).toFixed(2);

            if(currency_position == 'before_price'){
                html_service += `<p><span>(+) ${service.name}</span> <span>${currency_icon}${service.price * currency_rate}</span></p>`;

            }else if(currency_position == 'before_price_with_space'){
                html_service += `<p><span>(+) ${service.name}</span> <span>${currency_icon} ${service.price * currency_rate}</span></p>`;
            }else if(currency_position == 'after_price'){
                html_service += `<p><span>(+) ${service.name}</span> <span>${service.price * currency_rate}${currency_icon}</span></p>`;
            }else if(currency_position == 'after_price_with_space'){
                html_service += `<p><span>(+) ${service.name}</span> <span>${service.price * currency_rate} ${currency_icon}</span></p>`;
            }

            extra_input += `
                <input type="hidden" value="${service.id}" name="ids[]">
                <input type="hidden" value="${service.price}" name="prices[]">
                <input type="hidden" value="${service.name}" name="names[]">
            `;
        });

        $(".extra_service_area").html(html_service);
        $("#extra_input").html(extra_input);

        let extra_price_html = '';
        let total_price_html = '';
        let total_price = 0.00;

        if(currency_position == 'before_price'){
            total_price = (parseFloat(extra_price) +  parseFloat({{ $service->price }})).toFixed(2);
            extra_price_html += `${currency_icon}${extra_price * currency_rate}`;
            total_price_html += `${currency_icon}${total_price * currency_rate}`;

        }else if(currency_position == 'before_price_with_space'){
            total_price = (parseFloat(extra_price) +  parseFloat({{ $service->price }})).toFixed(2);
            extra_price_html += `${currency_icon} ${extra_price * currency_rate}`;
            total_price_html += `${currency_icon} ${total_price * currency_rate}`;
        }else if(currency_position == 'after_price'){
            total_price = (parseFloat(extra_price) +  parseFloat({{ $service->price }})).toFixed(2);
            extra_price_html += `${extra_price * currency_rate}${currency_icon}`;
            total_price_html += `${total_price * currency_rate}${currency_icon}`;
        }else if(currency_position == 'after_price_with_space'){
            total_price = (parseFloat(extra_price) +  parseFloat({{ $service->price }})).toFixed(2);
            extra_price_html += `${extra_price * currency_rate} ${currency_icon}`;
            total_price_html += `${total_price * currency_rate} ${currency_icon}`;
        }


        $(".extra_service_price").html(extra_price_html);
        $("#input_extra_total").val(extra_price);

        $(".total_price").html(total_price_html);
        $("#input_total").val(total_price);

    }

</script>
@endsection
