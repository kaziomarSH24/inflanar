
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">{{ $setting->app_name }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">{{ $setting->app_name }}</a>
      </div>
      <ul class="sidebar-menu">
          <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> <span>{{__('admin.Dashboard')}}</span></a></li>

          <li class="nav-item dropdown {{ Route::is('admin.all-booking') || Route::is('admin.booking-show') || Route::is('admin.awaiting-booking') || Route::is('admin.complete-request') || Route::is('admin.active-booking') || Route::is('admin.completed-booking') || Route::is('admin.declined-booking')  ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i><span>{{__('admin.All Bookings')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.all-booking') || Route::is('admin.booking-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.all-booking') }}">{{__('admin.All Bookings')}}</a></li>

                <li class="{{ Route::is('admin.awaiting-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.awaiting-booking') }}">{{__('admin.Awaiting Approval')}}</a></li>

                <li class="{{ Route::is('admin.active-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.active-booking') }}">{{__('admin.Active Bookings')}}</a></li>

                <li class="{{ Route::is('admin.completed-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.completed-booking') }}">{{__('admin.Completed Bookings')}}</a></li>

                @php
                    $complete_request_count = App\Models\CompleteRequest::WhereHas('order', function($order){
                        $order->where('order_status', '!=', 'complete');
                    })->count();
                @endphp

                <li class="{{ Route::is('admin.complete-request') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.complete-request') }}">{{__('admin.Complete Request')}}
                    @if ($complete_request_count > 0)
                    <sup class="badge badge-danger ml-1">{{ $complete_request_count }}</sup>
                    @endif

                </a></li>

                <li class="{{ Route::is('admin.declined-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.declined-booking') }}">{{__('admin.Declined Bookings')}}</a></li>


              </ul>
            </li>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.service-category.*') || Route::is('admin.service.*') || Route::is('admin.awaiting-for-approval-service') || Route::is('admin.active-service') ||  Route::is('admin.banned-service') || Route::is('admin.review-list') || Route::is('admin.show-review') || Route::is('admin.additional-create') || Route::is('admin.additional-service') || Route::is('admin.additional-edit') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Manage Services')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.service-category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.service-category.index') }}">{{__('admin.Category')}}</a></li>

                <li class="{{ Route::is('admin.service.*') || Route::is('admin.additional-create') || Route::is('admin.additional-service') || Route::is('admin.additional-edit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.service.index') }}">{{__('admin.All Service')}}</a></li>

                <li class="{{ Route::is('admin.awaiting-for-approval-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.awaiting-for-approval-service') }}">{{__('admin.Awaiting for Approval')}}</a></li>

                <li class="{{ Route::is('admin.active-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.active-service') }}">{{__('admin.Active Service')}}</a></li>

                <li class="{{ Route::is('admin.banned-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.banned-service') }}">{{__('admin.Banned Service')}}</a></li>

                <li class="{{ Route::is('admin.review-list') || Route::is('admin.show-review') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.review-list') }}">{{__('admin.Service Review')}}</a></li>


            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.coupon.*') || Route::is('admin.coupon-history') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Manage Coupon')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.coupon.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.coupon.index') }}">{{__('admin.Coupon')}}</a></li>

                <li class="{{ Route::is('admin.coupon-history') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.coupon-history') }}">{{__('admin.Coupon Histories')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{  Route::is('admin.influencer-list') || Route::is('admin.send-email-to-all-influencer') || Route::is('admin.send-email-to-influencer') || Route::is('admin.pending-influencer') || Route::is('admin.influencer-show') ? 'active' : '' }}">
            {{-- <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Manage Influencers')}}</span></a> --}}
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Manage Businesses')}}</span></a>
            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.influencer-list') || Route::is('admin.influencer-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.influencer-list') }}">{{__('admin.Business List')}}</a></li>

                <li class="{{ Route::is('admin.pending-influencer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-influencer') }}">{{__('admin.Pending Business')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{  Route::is('admin.client-list') || Route::is('admin.client-show') || Route::is('admin.pending-client') || Route::is('admin.send-email-to-all-client') ? 'active' : '' }}">
            {{-- <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Manage Client')}}</span></a> --}}
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Manage Influencers')}}</span></a>
            <ul class="dropdown-menu">
                {{-- <li class="{{ Route::is('admin.client-list') || Route::is('admin.client-show') || Route::is('admin.send-email-to-all-client') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.client-list') }}">{{__('admin.Influencer List')}}</a></li> --}}
                <li class="{{ Route::is('admin.client-list') || Route::is('admin.client-show') || Route::is('admin.send-email-to-all-client') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.client-list') }}">{{__('admin.Influencer List')}}</a></li>

                <li class="{{ Route::is('admin.pending-client') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-client') }}">{{__('admin.Pending Influencer')}}</a></li>
                {{-- <li class="{{ Route::is('admin.pending-client') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-client') }}">{{__('admin.Pending Influencer')}}</a></li> --}}
            </ul>
          </li>

        @php
            $unseenMessages = App\Models\TicketMessage::where('unseen_admin', 0)->groupBy('ticket_id')->get();
            $count = $unseenMessages->count();
        @endphp

        <li class="{{ Route::is('admin.ticket') || Route::is('admin.ticket-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.ticket') }}"><i class="fas fa-envelope-open-text"></i> <span>{{__('admin.Support Ticket')}} <sup class="badge badge-danger">{{ $count }}</sup></span></a></li>

          <li class="{{ Route::is('admin.refund-request') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.refund-request') }}"><i class="fas fa-undo"></i> <span>{{__('admin.Refund Request')}}</span></a></li>
          @if ($setting->commission_type == 'subscription')

          @php
            $json_module_data = file_get_contents(base_path('modules_statuses.json'));
            $module_status = json_decode($json_module_data);
          @endphp

          <li class="nav-item dropdown {{ Route::is('admin.subscription-plan.*') || Route::is('admin.purchase-history') || Route::is('admin.assign-plan') || Route::is('admin.purchase-history-show') || Route::is('admin.pending-plan-payment') ? 'active' : '' }}">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>{{__('admin.Subscription')}}
                  @if (env('APP_VERSION') == 'demo')
                  <span class="badge badge-danger addon_text">{{__('Addon')}}</span>
                  @endif
              </span>

              </a>
              <ul class="dropdown-menu">
                  <li class="{{  Route::is('admin.subscription-plan.*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.subscription-plan.index')}}">{{__('admin.Subscription Plan')}}</a></li>

                  <li class="{{ Route::is('admin.purchase-history') || Route::is('admin.purchase-history-show') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.purchase-history')}}">{{__('admin.Purchase History')}}</a></li>

                  <li class="{{ Route::is('admin.pending-plan-payment') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.pending-plan-payment')}}">{{__('admin.Pending Payment')}}</a></li>

                  <li class="{{ Route::is('admin.assign-plan') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.assign-plan')}}">{{__('admin.Assign Plan')}}</a></li>

                  <li class="{{ Route::is('admin.subscription-fees') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.subscription-fees')}}">{{__('admin.Subscription Fees')}}</a></li>

              </ul>
          </li>
      @else
      <li class="nav-item dropdown {{ Route::is('admin.withdraw-method.*') || Route::is('admin.influencer-withdraw') || Route::is('admin.pending-influencer-withdraw') || Route::is('admin.show-influencer-withdraw')  ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-newspaper"></i><span>{{__('admin.Withdraw Payment')}}</span></a>

        <ul class="dropdown-menu">
            <li class="{{ Route::is('admin.withdraw-method.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.withdraw-method.index') }}">{{__('admin.Withdraw Method')}}</a></li>

            {{-- <li class="{{ Route::is('admin.influencer-withdraw') || Route::is('admin.show-influencer-withdraw') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.influencer-withdraw') }}">{{__('admin.Influencer Withdraw')}}</a></li> --}}
            <li class="{{ Route::is('admin.influencer-withdraw') || Route::is('admin.show-influencer-withdraw') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.influencer-withdraw') }}">{{__('admin.Business Withdraw')}}</a></li>

            <li class="{{ Route::is('admin.pending-influencer-withdraw') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-influencer-withdraw') }}">{{__('admin.Withdraw Request')}}</a></li>

        </ul>
      @endif


        <li class="nav-item dropdown {{ Route::is('admin.our-feature') || Route::is('admin.testimonial.*') || Route::is('admin.partner.*') || Route::is('admin.slider') || Route::is('admin.working-proccess') || Route::is('admin.why-choose-us') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Manage Section')}}</span></a>
            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.slider') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.slider',['lang_code' => admin_lang()]) }}">{{__('admin.Intro section')}}</a></li>

                <li class="{{ Route::is('admin.our-feature') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.our-feature',['lang_code' => admin_lang()]) }}">{{__('admin.Our Feature')}}</a></li>


                <li class="{{ Route::is('admin.testimonial.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.testimonial.index',['lang_code' => admin_lang()]) }}">{{__('admin.Testimonial')}}</a></li>

                <li class="{{ Route::is('admin.partner.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.partner.index',['lang_code' => admin_lang()]) }}">{{__('admin.Partner')}}</a></li>

                <li class="{{ Route::is('admin.working-proccess') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.working-proccess',['lang_code' => admin_lang()]) }}">{{__('admin.Working Proccess')}}</a></li>

                <li class="{{ Route::is('admin.why-choose-us') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.why-choose-us',['lang_code' => admin_lang()]) }}">{{__('admin.Why Choose Us')}}</a></li>

            </ul>
          </li>

            <li class="nav-item dropdown {{ Route::is('admin.about-us') || Route::is('admin.contact-us') || Route::is('admin.custom-page.*') ||  Route::is('admin.terms-and-conditions') || Route::is('admin.privacy-policy') || Route::is('admin.faq.*') || Route::is('admin.error-image') || Route::is('admin.home-page') || Route::is('admin.login-image') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i><span>{{__('admin.Pages')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.home-page') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.home-page',['lang_code' => admin_lang()]) }}">{{__('admin.Home Page')}}</a></li>


                <li class="{{ Route::is('admin.about-us') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about-us',['lang_code' => admin_lang()]) }}">{{__('admin.About Us')}}</a></li>

                <li class="{{ Route::is('admin.contact-us') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.contact-us') }}">{{__('admin.Contact Us')}}</a></li>

                <li class="{{ Route::is('admin.custom-page.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.custom-page.index') }}">{{__('admin.Custom Page')}}</a></li>


                <li class="{{ Route::is('admin.terms-and-conditions') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.terms-and-conditions',['lang_code' => admin_lang()]) }}">{{__('admin.Terms and Conditions')}}</a></li>

                <li class="{{ Route::is('admin.privacy-policy') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.privacy-policy',['lang_code' => admin_lang()]) }}">{{__('admin.Privacy Policy')}}</a></li>

                <li class="{{ Route::is('admin.faq.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.faq.index') }}">{{__('admin.FAQ')}}</a></li>

                <li class="{{ Route::is('admin.error-image') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.error-image') }}">{{__('admin.Error Page')}}</a></li>


                <li class="{{ Route::is('admin.login-image') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.login-image') }}">{{__('admin.Login Page')}}</a></li>

            </ul>
          </li>

        </li>

        <li class="nav-item dropdown {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') || Route::is('admin.blog-comment') || Route::is('admin.show-comment') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Blogs')}}</span></a>

            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.blog-category.create') }}">{{__('admin.Create Category')}}</a></li>

                <li class="{{ Route::is('admin.blog-category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog-category.index') }}">{{__('admin.Categories')}}</a></li>

                <li><a class="nav-link" href="{{ route('admin.blog.create') }}">{{__('admin.Create Blog')}}</a></li>

                <li class="{{ Route::is('admin.blog.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog.index') }}">{{__('admin.Blog List')}}</a></li>

                <li class="{{ Route::is('admin.blog-comment') || Route::is('admin.show-comment') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog-comment') }}">{{__('admin.Blog Comments')}}</a></li>

            </ul>
          </li>


            @if (Module::isEnabled('PaymentGateway'))
                <li class="{{ Route::is('admin.payment-addon') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.payment-addon') }}"><i class="fas fa-dollar-sign"></i> <span>{{__('admin.Gateway')}}<span class="badge badge-danger addon_text">{{__('addon')}}</span></span></a></li>
            @endif

            @if (Module::isEnabled('Currency'))
                @include('currency::sidebar')
            @endif



          <li class="nav-item dropdown {{ Route::is('admin.general-setting') || Route::is('admin.logo-favicon') || Route::is('admin.cookie-consent') || Route::is('admin.google-captcha') || Route::is('admin.tawk-chat') || Route::is('admin.google-analytic') || Route::is('admin.facebook-pixel') || Route::is('admin.custom-pagination') || Route::is('admin.database-generate') || Route::is('admin.payment-method') || Route::is('admin.social-login') || Route::is('admin.header-footer') || Route::is('admin.default-avatar') || Route::is('admin.breadcrumb') || Route::is('admin.database-clear') || Route::is('admin.seo-setting') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>{{__('admin.General Setting')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.general-setting') }}">{{__('admin.General Setting')}}</a></li>


                <li class="{{ Route::is('admin.seo-setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seo-setting') }}">{{__('admin.SEO Setup')}}</a></li>

                <li class="{{ Route::is('admin.payment-method') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.payment-method') }}">{{__('admin.Payment Gateway')}}</a></li>

                <li class="{{ Route::is('admin.logo-favicon') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.logo-favicon') }}">{{__('admin.Logo & Favicon')}}</a></li>

                <li class="{{ Route::is('admin.cookie-consent') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.cookie-consent') }}">{{__('admin.Cookie Consent')}}</a></li>

                <li class="{{ Route::is('admin.google-captcha') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.google-captcha') }}">{{__('admin.Google reCaptcha')}}</a></li>

                <li class="{{ Route::is('admin.tawk-chat') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.tawk-chat') }}">{{__('admin.Tawk Chat')}}</a></li>

                <li class="{{ Route::is('admin.google-analytic') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.google-analytic') }}">{{__('admin.Google Analytic')}}</a></li>

                <li class="{{ Route::is('admin.social-login') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.social-login') }}">{{__('admin.Social Login')}}</a></li>

                <li class="{{ Route::is('admin.facebook-pixel') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.facebook-pixel') }}">{{__('admin.Facebook Pixel')}}</a></li>

                <li class="{{ Route::is('admin.custom-pagination') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.custom-pagination') }}">{{__('admin.Custom Pagination')}}</a></li>

                <li class="{{ Route::is('admin.header-footer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.header-footer') }}">{{__('admin.Header & Footer')}}</a></li>

                <li class="{{ Route::is('admin.default-avatar') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.default-avatar') }}">{{__('admin.Default avatar')}}</a></li>

                <li class="{{ Route::is('admin.breadcrumb') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.breadcrumb') }}">{{__('admin.Breadcrumb image')}}</a></li>

                <li class="{{ Route::is('admin.cache-clear') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.cache-clear') }}">{{__('admin.Clear cache')}}</a></li>

                <li class="{{ Route::is('admin.database-clear') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.database-clear') }}">{{__('admin.Database Clear')}}</a></li>

                <li class="{{ Route::is('admin.database-generate') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.database-generate') }}">{{__('admin.Database Generate')}}</a></li>


              </ul>
            </li>
          </li>


          <li class="nav-item dropdown {{ Route::is('admin.email-configuration') || Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i><span>{{__('admin.Email Configuration')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.email-configuration') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.email-configuration') }}">{{__('admin.Setting')}}</a></li>

                <li class="{{ Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.email-template') }}">{{__('admin.Email Template')}}</a></li>
            </ul>
          </li>


        <li class="nav-item dropdown {{ Route::is('admin.language.*') || Route::is('admin.theme-language') || Route::is('admin.validation-language') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Language')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.language.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.language.index') }}">{{__('admin.Language')}}</a></li>

                <li class="{{ Route::is('admin.theme-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.theme-language',['lang_code' => admin_lang()]) }}">{{__('admin.Theme Language')}}</a></li>

                <li class="{{ Route::is('admin.validation-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.validation-language',['lang_code' => admin_lang()]) }}">{{__('admin.Validation Language')}}</a></li>

            </ul>
          </li>

          <li class="{{ Route::is('admin.contact-message') || Route::is('admin.show-message') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.contact-message') }}"><i class="fas fa-fa fa-envelope"></i> <span>{{__('admin.Contact Message')}}</span></a></li>


        <li class="{{ Route::is('admin.subscriber-list') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.subscriber-list') }}"><i class="fas fa-fire"></i> <span>{{__('admin.Subscribers')}}</span></a></li>

          @if ($header_admin->admin_type == 1)
            <li class="{{ Route::is('admin.admin-list.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin-list.index') }}"><i class="fas fa-users"></i> <span>{{__('admin.Admin list')}}</span></a></li>
          @endif



        </ul>

    </aside>
  </div>
