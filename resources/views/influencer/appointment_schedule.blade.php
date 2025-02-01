@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Appointment Schedule')}}</title>
@endsection
@section('influencer-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Appointment Schedule')}}</h1>
      </div>

        <div class="section-body">
            <a href="{{ route('influencer.appointment-schedule.create') }}"  class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('admin.SN')}}</th>
                                            <th>{{__('admin.Day')}}</th>
                                            <th>{{__('admin.Start time')}}</th>
                                            <th>{{__('admin.End time')}}</th>
                                            <th>{{__('admin.Status')}}</th>
                                            <th>{{__('admin.Action')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $index => $schedule)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $schedule->day }}</td>
                                                <td>{{ date('h:i A', strtotime($schedule->start_time)) }}</td>
                                                <td>{{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                                                <td>
                                                    @if ($schedule->status == 1)
                                                    <span class="badge badge-success">{{__('admin.Active')}}</span>
                                                    @else

                                                    <span class="badge badge-danger">{{__('admin.Inactive')}}</span>

                                                    @endif
                                                </td>

                                                <td>

                                                    <a href="{{ route('influencer.appointment-schedule.edit', $schedule->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $schedule->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
     "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("influencer/appointment-schedule/") }}'+"/"+id)
    }

</script>
@endsection

