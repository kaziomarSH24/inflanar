@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Blog')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Blog')}}</h1>
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
                                    <li><a href="{{ route('admin.blog.edit', ['blog' => $blog->id, 'lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
                        <form action="{{ route('admin.blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="translate_id" value="{{ $blog_translate->id }}">
                            <input type="hidden" name="lang_code" value="{{ $blog_translate->lang_code }}">

                            <div class="row">
                                @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group col-12">
                                        <label>{{__('admin.Image Preview')}}</label>
                                        <div>
                                            <img id="preview-img" class="admin-img" src="{{ asset($blog->image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.New Thumbnail Image')}} <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file"  name="image">
                                    </div>
                                @endif


                                <div class="form-group col-12">
                                    <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="title" class="form-control"  name="title" value="{{ $blog_translate->title }}">
                                </div>

                                @if (admin_lang() == request()->get('lang_code'))
                                    <div class="form-group col-12">
                                        <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                                        <input type="text" id="slug" class="form-control"  name="slug" value="{{ $blog->slug }}">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Category')}} <span class="text-danger">*</span></label>
                                        <select name="category" class="form-control select2" id="category">
                                            <option value="">{{__('admin.Select Category')}}</option>
                                            @foreach ($categories as $category)
                                                <option {{ $category->id == $blog->blog_category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>
                                    <textarea name="description" id="" cols="30" rows="10" class="summernote">{!! $blog_translate->description !!}</textarea>
                                </div>

                                @if (admin_lang() == request()->get('lang_code'))

                                    <div class="form-group col-12">
                                        <label >
                                        <input {{ $blog->show_homepage == 'yes' ? 'checked' : '' }} type="checkbox" name="show_homepage" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">{{__('admin.Show on homepage')}}</span>
                                        </label>
                                    </div>

                                    <div class="form-group col-12">
                                        <label >
                                        <input {{ $blog->is_popular == 'yes' ? 'checked' : '' }} type="checkbox" name="is_popular" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">{{__('admin.Mark as a Popular')}}</span>
                                        </label>
                                    </div>

                                    <div class="form-group col-12">
                                        <label >
                                        <input {{ $blog->status == 1 ? 'checked' : '' }} type="checkbox" name="status" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">{{__('admin.Status')}}</span>
                                        </label>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Tags')}}</label>
                                       <input type="text" class="form-control tags" name="tags" value="{{ $blog->tags }}">
                                    </div>

                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.SEO Title')}}</label>
                                   <input type="text" class="form-control" name="seo_title" value="{{ $blog_translate->seo_title }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.SEO Description')}}</label>
                                    <textarea name="seo_description" id="" cols="30" rows="10" class="form-control text-area-5">{{ $blog_translate->seo_description }}</textarea>
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

<script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $("#title").on("focusout",function(e){
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
