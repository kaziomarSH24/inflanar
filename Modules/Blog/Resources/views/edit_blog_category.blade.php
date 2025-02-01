@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Blog Category')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Blog Category')}}</h1>
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
                        <li><a href="{{ route('admin.blog-category.edit', ['blog_category' => $category->id, 'lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
                        <form action="{{ route('admin.blog-category.update',$category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ $cat_translate->name }}">
                                </div>

                                <input type="hidden" name="lang_code" value="{{ $cat_translate->lang_code }}">
                                <input type="hidden" name="translate_id" value="{{ $cat_translate->id }}">

                                @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group col-12">
                                        <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                                        <input type="text" id="slug" class="form-control"  name="slug" value="{{ $category->slug }}">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option {{ $category->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                            <option {{ $category->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>

                                @endif


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

<script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })
        });
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
