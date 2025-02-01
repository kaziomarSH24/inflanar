@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Home Page')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Home Page')}}</h1>
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
                          <li><a href="{{ route('admin.home-page', ['lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
            $label = 'For colorfull text, write the text inside "<span>Text Here</span>" tag'
        @endphp

          <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.home-page-update') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Category title')}}</label>
                                    <input type="text" name="category_title" value="{{ $translate->category_title }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Category header')}}</label>
                                    <input type="text" name="category_header" value="{{ $translate->category_header }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Feature title')}}</label>
                                    <input type="text" name="feature_title" value="{{ $translate->feature_title }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Feature header')}}</label>
                                    <input type="text" name="feature_header" value="{{ $translate->feature_header }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Influencer title')}}</label>
                                    <input type="text" name="influencer_title" value="{{ $translate->influencer_title }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Influencer header')}}</label>
                                    <input type="text" name="influencer_header" value="{{ $translate->influencer_header }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Service title')}}</label>
                                    <input type="text" name="service_title" value="{{ $translate->service_title }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Service header')}}</label>
                                    <input type="text" name="service_header" value="{{ $translate->service_header }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Working process title')}}</label>
                                    <input type="text" name="working_title" value="{{ $translate->working_title }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{__('admin.Working process header')}}</label>
                                    <input type="text" name="working_header" value="{{ $translate->working_header }}" class="form-control" required>
                                </div>
                            </div>


                            @if (admin_lang() == request()->get('lang_code'))
                            <div class="form-group">
                                <label for="">{{__('admin.Video thumbnail')}}</label>
                                <div>
                                    <img class="video_image" src="{{ asset($home_page->video_image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New thumbnail')}}</label>
                                <input type="file" name="video_image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Youtube video id')}}</label>
                                <input type="text" name="video_id" value="{{ $home_page->video_id }}" class="form-control" required>
                            </div>

                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Video title')}}</label>
                                <input type="text" name="video_title" value="{{ $translate->video_title }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Video description')}}</label>
                                <textarea name="video_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $translate->video_description }}</textarea>

                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Partner title')}} <span class="text-danger">({{ $label }}) </span></label>
                                <input type="text" name="partner_title" value="{{ $translate->partner_title }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Partner description')}}</label>
                                <textarea name="partner_description" class="form-control text-area-3" id="" cols="30" rows="10">{{ $translate->partner_description }}</textarea>
                            </div>

                            @if (admin_lang() == request()->get('lang_code'))
                            <div class="form-group">
                                <label for="">{{__('admin.FAQ image')}}</label>
                                <div>
                                    <img class="video_image" src="{{ asset($home_page->faq_image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New image')}}</label>
                                <input type="file" name="faq_image" class="form-control-file">
                            </div>

                            @endif


                            <div class="form-group">
                                <label for="">{{__('admin.FAQ title')}}</label>
                                <input type="text" name="faq_title" value="{{ $translate->faq_title }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.FAQ header')}}</label>
                                <input type="text" name="faq_header" value="{{ $translate->faq_header }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.FAQ description')}}</label>
                                <input type="text" name="faq_description" value="{{ $translate->faq_description }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Testimonial title')}}</label>
                                <input type="text" name="testimonial_title" value="{{ $translate->testimonial_title }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Testimonial header')}}</label>
                                <input type="text" name="testimonial_header" value="{{ $translate->testimonial_header }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Blog title')}}</label>
                                <input type="text" name="blog_title" value="{{ $translate->blog_title }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Blog header')}}</label>
                                <input type="text" name="blog_header" value="{{ $translate->blog_header }}" class="form-control" required>
                            </div>

                            @if (admin_lang() == request()->get('lang_code'))
                            <div class="form-group">
                                <label for="">{{__('admin.Provider joining image')}}</label>
                                <div>
                                    <img class="video_image" src="{{ asset($home_page->provider_joining_image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New image')}}</label>
                                <input type="file" name="provider_joining_image" class="form-control-file">
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Provider joining title')}}</label>
                                <input type="text" name="provider_joining_title" value="{{ $translate->provider_joining_title }}" class="form-control" required>
                            </div>


                            @if (admin_lang() == request()->get('lang_code'))
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Facebook icon')}}</label>
                                        <div>
                                            <img src="{{ asset($home_page->facebook_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="facebook_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Facebook follower')}}</label>
                                        <input type="text" name="facebook_follower" class="form-control" value="{{ $home_page->facebook_follower }}">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Twitter icon')}}</label>
                                        <div>
                                            <img src="{{ asset($home_page->twitter_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="twitter_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Twitter follower')}}</label>
                                        <input type="text" name="twitter_follower" class="form-control" value="{{ $home_page->twitter_follower }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Tiktok icon')}}</label>
                                        <div>
                                            <img src="{{ asset($home_page->tiktok_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="tiktok_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Tiktok follower')}}</label>
                                        <input type="text" name="tiktok_follower" class="form-control" value="{{ $home_page->tiktok_follower }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Instagram icon')}}</label>
                                        <div>
                                            <img src="{{ asset($home_page->instagram_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New icon')}}</label>
                                        <input type="file" name="instagram_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Instagram follower')}}</label>
                                        <input type="text" name="instagram_follower" class="form-control" value="{{ $home_page->instagram_follower }}">
                                    </div>
                                </div>

                            </div>

                            @endif

                            <button class="btn btn-primary">{{__('admin.Update')}}</button>


                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
