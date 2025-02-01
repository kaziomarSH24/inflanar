@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Edit Appointment Schedule')}}</title>
@endsection
@section('influencer-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Edit Appointment Schedule')}}</h1>
      </div>

        <div class="section-body">
            <a href="{{ route('influencer.appointment-schedule.index') }}"  class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Schedule List')}}</a>
            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <form action="{{ route('influencer.appointment-schedule.update', $schedule->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="">{{__('admin.Day')}} <span class="text-danger">*</span></label>
                                        <select name="day" id="" class="form-control">
                                            <option value="">{{__('admin.Select Day')}}</option>
                                            @foreach ($days as $day)
                                            <option {{ $schedule->day == $day ? 'selected' : '' }} value="{{ $day }}">{{ $day }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col-12">
                                        <label for="start_time">{{__('admin.Start Time')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="start_time" class="form-control clockpicker" data-align="top" data-autoclose="true" autocomplete="off" value="{{ $schedule->start_time }}">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="end_time">{{__('admin.End Time')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="end_time" class="form-control clockpicker" data-align="top" data-autoclose="true" autocomplete="off" value="{{ $schedule->end_time }}">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option {{ $schedule->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                            <option {{ $schedule->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">{{__('admin.Update')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
