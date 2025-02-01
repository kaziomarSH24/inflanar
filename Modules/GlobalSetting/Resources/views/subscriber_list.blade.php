@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Subscribers')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Subscribers')}}</h1>
        </div>

        <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h1>{{__('admin.Send mail to all')}}</h1>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.send-subscriber-email') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{__('admin.Subject')}}</label>
                                    <input type="text" name="subject" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('admin.Message')}}</label>
                                    <textarea name="message" id="message" class="form-control text-area-5" cols="30" rows="10"></textarea>
                                </div>
                                <button class="btn btn-primary">{{__('admin.Send Email')}}</button>
                            </form>
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
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('admin.SN')}}</th>
                                            <th>{{__('admin.Email')}}</th>
                                            <th>{{__('admin.Verified')}}</th>
                                            <th>{{__('admin.Action')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscribers as $index => $subscriber)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>
                                                    @if($subscriber->is_verified == 1)
                                                        <span class="badge badge-success">{{__('admin.Yes')}}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{__('admin.No')}}</span>
                                                    @endif
                                                </td>
                                                <td>

                                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $subscriber->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>


                                            </td>

                                            </tr>
                                          @endforeach
                                    </tbody>
                                </table>
                              </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
  </div>

    <script>
        "use strict";
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-subscriber/") }}'+"/"+id)
        }
    </script>

@endsection
