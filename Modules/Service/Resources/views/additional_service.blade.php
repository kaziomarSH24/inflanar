@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Additional Service')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Additional Service')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.additional-create', $service->id) }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th>{{__('admin.Title')}}</th>
                                    <th>{{__('admin.Price')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($additionals as $index => $additional)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $additional->translate->title }}</td>
                                        <td>
                                            {{ currency($additional->price) }}
                                        </td>

                                        <td>

                                        <a href="{{ route('admin.additional-edit', ['id' => $additional->id, 'lang_code' => admin_lang()] ) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $additional->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
        $("#deleteForm").attr("action",'{{ url("admin/additional-delete/") }}'+"/"+id)
    }
</script>
@endsection
