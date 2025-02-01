@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Google Analytic')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Google Analytic')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-google-analytic') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">{{__('admin.Allow Google Analytic')}}</label>
                                    <select name="allow" id="tawk_allow" class="form-control">
                                        <option {{ $google_analytic->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                        <option {{ $google_analytic->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Analytic Tracking Id')}}</label>
                                    <input type="text" class="form-control" name="analytic_id" value="{{ $google_analytic->analytic_id }}">
                                </div>

                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
  </div>

@endsection
