@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Edit Portfolio')}}</title>
@endsection
@section('influencer-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Edit Portfolio')}}</h1>

      </div>



      <form action="{{ route('influencer.portfolio-update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" id="serviceForm">
        @csrf
        @method('PUT')
      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('admin.Basic Information')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>{{__('admin.Existing image')}} </label>
                            <div>
                                <img src="{{ asset($portfolio->image) }}" alt="" class="w_120">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Image')}}</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $portfolio->name }}">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('admin.Status')}}</label>
                            <select name="status" id="" class="form-control">
                                <option {{ $portfolio->status == '1' ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                <option {{ $portfolio->status == '0' ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                            </select>
                        </div>

                        <button class="btn btn-primary" type="submit">{{__('admin.Update Portfolio')}}</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    </section>
  </div>

@endsection
