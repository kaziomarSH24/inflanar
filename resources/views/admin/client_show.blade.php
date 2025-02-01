
@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Client Detail')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Client Detail')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.client-list') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Client List')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>{{__('admin.Image')}}</td>
                                <td>
                                    @if ($client->image)
                                    <img src="{{ asset($client->image) }}" class="rounded-circle" alt="" width="80px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{__('admin.Name')}}</td>
                                <td>{{ html_decode($client->name) }}</td>
                            </tr>
                            <tr>
                                <td>{{__('admin.Email')}}</td>
                                <td>{{ html_decode($client->email) }}</td>
                            </tr>
                            <tr>
                                <td>{{__('admin.Phone')}}</td>
                                <td>{{ html_decode($client->phone) }}</td>
                            </tr>
                            <tr>
                                <td>{{__('admin.Address')}}</td>
                                <td>{{ html_decode($client->address) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Status')}}</td>
                                <td>
                                    @if($client->status == 'enable')
                                        <a href="javascript:;" onclick="manageCustomerStatus({{ $client->id }})">
                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                        </a>
                                        @else
                                        <a href="javascript:;" onclick="manageCustomerStatus({{ $client->id }})">
                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    "use strict";
    function manageCustomerStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/influencer-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
