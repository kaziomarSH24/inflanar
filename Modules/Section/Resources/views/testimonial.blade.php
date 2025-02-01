@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Testimonial')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Testimonial')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
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
                                    <th>{{__('admin.Designation')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $index => $testimonial)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $testimonial->translate->name }}</td>
                                        <td>{{ $testimonial->translate->designation }}</td>

                                        <td>
                                            @if($testimonial->status == 'enable')
                                                <span class="badge badge-success">{{__('admin.Active')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('admin.Inactive')}}</span>
                                            @endif
                                        </td>
                                        <td>

                                        <a href="{{ route('admin.testimonial.edit', ['testimonial' => $testimonial->id, 'lang_code' => admin_lang()] ) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $testimonial->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
        $("#deleteForm").attr("action",'{{ url("admin/testimonial/") }}'+"/"+id)
    }
</script>
@endsection
