@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Partner')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Partner')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.partner.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.Link')}}</th>
                                    <th>{{__('admin.Logo')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $index => $partner)
                                    <tr>

                                        <td><a href="{{ $partner->link }}">{{__('admin.Click Me')}}</a></td>

                                        <td> <img src="{{ asset($partner->logo) }}" alt="" ></td>

                                        <td>
                                        <a href="{{ route('admin.partner.edit',$partner->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $partner->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
        </section>
      </div>

<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/partner/") }}'+"/"+id)
    }
</script>
@endsection
