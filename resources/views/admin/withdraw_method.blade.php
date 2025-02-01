@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Withdraw Method')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Withdraw Method')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.withdraw-method.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th>{{__('admin.Name')}}</th>
                                    <th>{{__('admin.Minimum Amount')}}</th>
                                    <th>{{__('admin.Maximum Amount')}}</th>
                                    <th>{{__('admin.Charge')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($methods as $index => $method)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $method->name }}</td>
                                        <td>
                                            {{ currency($method->min_amount) }}

                                        </td>
                                        <td>

                                            {{ currency($method->max_amount) }}

                                        </td>
                                        <td>{{ $method->withdraw_charge }}%</td>
                                        <td>
                                            @if($method->status == 1)
                                                <span class="badge badge-success">{{__('admin.Active')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('admin.Active')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('admin.withdraw-method.edit',$method->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $method->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
        $("#deleteForm").attr("action",'{{ url("admin/withdraw-method/") }}'+"/"+id)
    }

</script>
@endsection
