@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Validation language')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Validation Language')}}</h1>
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
                          <li><a href="{{ route('admin.validation-language', ['lang_code' => $language->lang_code] ) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
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
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-validation-language') }}" method="post">
                            @csrf
                            <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                                <table class="table table-bordered">
                                    @foreach ($data as $index => $value)
                                        <tr>
                                            <td width="50%">{{ $index }}</td>
                                            <td width="50%">
                                                <input type="text" class="form-control" name="values[{{ $index }}]"  value="{{ $value }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
