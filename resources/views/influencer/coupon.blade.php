@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Manage Coupon')}}</title>
@endsection
@section('influencer-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Manage Coupon')}}</h1>
      </div>

        <div class="section-body">
            <a href="javascript:;" data-toggle="modal" data-target="#create_coupon_id"  class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('admin.SN')}}</th>
                                            <th>{{__('admin.Coupon Code')}}</th>
                                            <th>{{__('admin.Offer')}}</th>
                                            <th>{{__('admin.End time')}}</th>
                                            <th>{{__('admin.Status')}}</th>
                                            <th>{{__('admin.Action')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $index => $coupon)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $coupon->coupon_code }}</td>
                                                <td>{{ $coupon->offer_percentage }}%</td>

                                                <td>{{ date('d M Y', strtotime($coupon->expired_date)) }}</td>

                                                <td>
                                                    @if ($coupon->status == 1)
                                                    <span class="badge badge-success">{{__('admin.Active')}}</span>
                                                    @else

                                                    <span class="badge badge-danger">{{__('admin.Inactive')}}</span>

                                                    @endif
                                                </td>

                                                <td>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#edit_coupon_id_{{ $coupon->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $coupon->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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

@foreach ($coupons as $index => $coupon)
    <div class="modal fade" id="edit_coupon_id_{{ $coupon->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Create Coupon')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('influencer.coupon.update', $coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">{{__('admin.Coupon Code')}} <span class="text-danger">*</span></label>
                                <input type="text" name="coupon_code" autocomplete="off" class="form-control" value="{{ $coupon->coupon_code }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Offer')}}(%) <span class="text-danger">*</span></label>
                                <input type="text" name="offer_percentage" autocomplete="off" class="form-control" value="{{ $coupon->offer_percentage }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.End time')}} <span class="text-danger">*</span></label>
                                <input type="text" name="expired_date" autocomplete="off" class="form-control datepicker" value="{{ $coupon->expired_date }}">
                            </div>

                        <div class="form-group">
                                <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                <select name="status" id="" class="form-control">
                                    <option {{ $coupon->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                    <option {{ $coupon->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endforeach


<!-- Modal -->
<div class="modal fade" id="create_coupon_id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">{{__('admin.Create Coupon')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ route('influencer.coupon.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{__('admin.Coupon Code')}} <span class="text-danger">*</span></label>
                            <input type="text" name="coupon_code" autocomplete="off" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">{{__('admin.Offer')}}(%) <span class="text-danger">*</span></label>
                            <input type="text" name="offer_percentage" autocomplete="off" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">{{__('admin.End time')}} <span class="text-danger">*</span></label>
                            <input type="text" name="expired_date" autocomplete="off" class="form-control datepicker">
                        </div>

                       <div class="form-group">
                            <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                            <select name="status" id="" class="form-control">
                                <option value="1">{{__('admin.Active')}}</option>
                                <option value="0">{{__('admin.Inactive')}}</option>
                            </select>
                       </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("influencer/coupon/") }}'+"/"+id)
    }

</script>
@endsection

