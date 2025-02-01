@extends('admin.master_layout')
@section('title')
<title>{{__('admin.FAQ')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit FAQ')}}</h1>
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
                          <li><a href="{{ route('admin.faq.edit', ['faq' => $faq->id, 'lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.faq.update',$faq->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                            <input type="hidden" name="translate_id" value="{{ $translate->id }}">

                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.Question')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="question" class="form-control"  name="question" value="{{ $translate->question }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Answer')}} <span class="text-danger">*</span></label>
                                    <textarea name="answer" id="" cols="30" rows="10" class="summernote">{{ $translate->answer }}</textarea>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
