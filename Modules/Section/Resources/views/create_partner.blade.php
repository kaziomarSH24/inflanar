@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create Partner')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create Partner')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.partner.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Partner List')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.Logo')}} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file"  name="logo">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Link')}} </label>
                                    <input type="text" id="link" class="form-control"  name="link">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Save')}}</button>
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
