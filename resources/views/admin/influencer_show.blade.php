
@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Influencer Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Influencer Details')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.influencer-list') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Influencer List')}}</a>
            <div class="row mt-5">
                <div class="col-md-3">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>{{__('admin.Total Service Sold')}}</h4>
                      </div>
                      <div class="card-body">
                       {{ $total_sold_service }}
                      </div>
                    </div>
                  </div>
                </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.influencer-withdraw',['influencer_id' => $influencer->id]) }}">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{__('admin.Total Withdraw')}}</h4>
                                </div>
                                <div class="card-body">
                                    {{ currency($total_withdraw) }}

                                </div>
                                </div>
                            </div>
                        </a>
                    </div>



                <div class="col-md-3">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                      <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>{{__('admin.Total Balance')}}</h4>
                      </div>
                      <div class="card-body">
                        {{ currency($total_balance) }}

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.service.index', ['influencer' => $influencer->id]) }}">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>{{__('admin.Total Service')}}</h4>
                      </div>
                      <div class="card-body">
                        {{ $total_service }}
                      </div>
                    </div>
                  </div>
                </a>
                </div>
              </div>
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                  <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @if ($influencer->image)
                        <img alt="image" src="{{ asset($influencer->image) }}" class="rounded-circle profile-widget-picture">
                        @else
                        <img alt="image" src="{{ asset($setting->default_avatar) }}" class="rounded-circle profile-widget-picture">
                        @endif
                      <div class="profile-widget-items">
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Joined at')}}</div>
                          <div class="profile-widget-item-value">{{ $influencer->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Current Balance')}}</div>
                          <div class="profile-widget-item-value">

                            {{ currency($current_balance) }}

                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>{{__('admin.Name')}}</td>
                                    <td>{{ html_decode($influencer->name) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Email')}}</td>
                                    <td>{{ html_decode($influencer->email) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Phone')}}</td>
                                    <td>{{ html_decode($influencer->phone) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Account Status')}}</td>
                                    <td>
                                        @if($influencer->status == 'enable')
                                        <a href="javascript:;" onclick="manageCustomerStatus({{ $influencer->id }})">
                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                        </a>
                                        @else
                                        <a href="javascript:;" onclick="manageCustomerStatus({{ $influencer->id }})">
                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                        </a>
                                    @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                  </div>

                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h1>{{__('admin.Influencer Action')}}</h1>
                            </div>
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col-12">
                                        <a target="_blank" href="{{ route('influencer', $influencer->username) }}" class="btn btn-success btn-block btn-lg my-2">{{__('admin.Go to Influencer Front Page')}}</a>
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('admin.review-list', ['influencer_id' => $influencer->id]) }}" class="btn btn-primary btn-block btn-lg my-2">{{__('admin.Influencer Reviews')}}</a>
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('admin.send-email-to-influencer', $influencer->id) }}" class="btn btn-warning btn-block btn-lg my-2">{{__('admin.Send Email')}}</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate="" action="{{ route('admin.influencer-update',$influencer->id) }}">
                            @method('put')
                            @csrf
                            <div class="card-header">
                                <h4>{{__('admin.Edit Profile')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>{{__('admin.New Image')}}</label>
                                        <input type="file" class="form-control-file" name="image">
                                        </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $influencer->name }}" name="name">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Designation')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $influencer->designation }}" name="designation">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" value="{{ $influencer->email }}" name="email" readonly>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $influencer->phone }}" name="phone">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Total Follower')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $influencer->total_follower }}" name="total_follower">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Total Following')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $influencer->total_following }}" name="total_following">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Country')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $influencer->country }}" name="country">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $influencer->address }}" name="address">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Your Skill')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control tags" value="{{ $influencer->tags }}" name="tags">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.About Me')}} <span class="text-danger">*</span></label>
                                        <textarea name="about_me" class="form-control text-area-5" id="" cols="30" rows="10">{{ $influencer->about_me }}</textarea>

                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.School name')}}</label>
                                        <input type="text" class="form-control" value="{{ $influencer->school_name }}" name="school_name">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.School passing year')}}</label>
                                        <input type="text" class="form-control" value="{{ $influencer->school_year }}" name="school_year">
                                    </div>


                                    <div class="form-group col-12">
                                        <label>{{__('admin.University name')}}</label>
                                        <input type="text" class="form-control" value="{{ $influencer->varsity_name }}" name="varsity_name">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.University passing year')}}</label>
                                        <input type="text" class="form-control" value="{{ $influencer->varsity_year }}" name="varsity_year">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Facebook')}} </label>
                                        <input type="text" class="form-control" value="{{ $influencer->facebook }}" name="facebook">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Twitter')}} </label>
                                        <input type="text" class="form-control" value="{{ $influencer->twitter }}" name="twitter">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Instagram')}} </label>
                                        <input type="text" class="form-control" value="{{ $influencer->instagram }}" name="instagram">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Tiktok')}} </label>
                                        <input type="text" class="form-control" value="{{ $influencer->tiktok }}" name="tiktok">
                                    </div>

                                </div>
                                <button class="btn btn-primary" type="submit">{{__('admin.Save Changes')}}</button>
                            </div>

                        </form>
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
