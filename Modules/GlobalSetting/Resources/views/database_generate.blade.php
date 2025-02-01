@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Database Generate')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Database Generate')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-database-generate') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="alert alert-warning" role="alert">
                                  <p>{{__('admin.This feature not a regular feature, this will be use for version update. You can not trigger the button as your mind. When need to trigger the button we will mention on our version documentation')}}</p>
                                </div>
                                <button class="btn btn-primary">{{__('admin.Update Database')}}</button>
                        </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
  </div>

@endsection
