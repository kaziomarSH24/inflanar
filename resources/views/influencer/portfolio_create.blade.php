@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Create Portfolio')}}</title>
@endsection
@section('influencer-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Create Portfolio')}}</h1>

      </div>

      <form action="{{ route('influencer.portfolio-store') }}" method="POST" enctype="multipart/form-data" id="serviceForm">
        @csrf
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
                            <label>{{__('admin.Image')}} <span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" name="image">
                        </div>


                        <div class="form-group col-12">
                            <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" name="name">
                        </div>


                        <button class="btn btn-primary" type="submit">{{__('admin.Save Portfolio')}}</button>

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
