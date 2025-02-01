@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Admin')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Admin')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.admin-list.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Admin List')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.admin-list.update', $admin->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ $admin->name }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                    <input type="email" id="slug" class="form-control"  name="email" value="{{ $admin->email }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Password')}}</label>
                                    <input type="password" id="password" class="form-control"  name="password">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option {{ $admin->status == 'active' ? 'selected' : '' }} value="active">{{__('admin.Active')}}</option>
                                        <option {{ $admin->status == 'inactive' ? 'selected' : '' }} value="inactive">{{__('admin.Inactive')}}</option>
                                    </select>
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
