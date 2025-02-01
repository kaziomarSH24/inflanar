@extends('admin.master_layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ $title }}</h1>

          </div>

          <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    {{-- <label for="">{{__('admin.Influencers')}}</label> --}}
                                    <label for="">{{__('admin.Businesses')}}</label>
                                    <select name="influencer" id="" class="form-control select2">
                                        <option value="">{{__('admin.Select')}}</option>
                                        @if (request()->has('influencer'))
                                            @foreach ($influencers as $influencer)
                                                <option {{ request()->get('influencer') == $influencer->id ? 'selected' : ''}} value="{{ $influencer->id }}">{{ $influencer->name. " - ". $influencer->email }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($influencers as $influencer)
                                                <option value="{{ $influencer->id }}">{{ $influencer->name. " - ". $influencer->email }}</option>
                                            @endforeach
                                        @endif


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-primary plus_btn">{{__('admin.Search')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.service.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.New Service')}}</a>
            <div class="row mt-4">
                @if($services->count() > 0)
                @foreach ($services as $service)
                    <div class="col-12">
                        <div class="card service_card">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <img class="service_image" src="{{ asset($service->thumbnail_image) }}" alt="">
                                <div class="service_detail">
                                    <h4>{{ $service->translate->title }}</h4>
                                    <h6>{{__('admin.Price')}} :

                                        {{ currency($service->price) }}

                                    </h6>
                                    <p>{{__('admin.Category')}} : {{ $service->category->translate->name }}</p>
                                    @if ($service->is_featured == 'enable')
                                        <p>{{__('admin.Highlight')}} :
                                            {{__('admin.Featured')}}
                                        </p>
                                    @endif
                                    <p>{{__('admin.Status')}} :

                                        @if ($service->is_banned == 'enable')
                                            <span class="badge badge-danger">{{__('admin.Banned')}}</span>
                                        @elseif ($service->approve_by_admin == 'disable')
                                            <span class="badge badge-danger">{{__('admin.Awaiting for approval')}}</span>
                                        @else
                                            @if ($service->status == 'active')
                                                <span class="badge badge-success">{{__('admin.Active')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('admin.Inactive')}}</span>
                                            @endif
                                        @endif

                                    </p>

                                    <p>{{__('admin.Influencer')}}: <a href="{{ route('admin.influencer-show',$service->influencer_id) }}">{{ $service->influencer ? $service->influencer->name : '' }}</a></p>

                                    <a href="{{ route('admin.service.edit', ['service' => $service->id, 'lang_code' => admin_lang()] ) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> {{__('admin.Edit')}}</a>

                                    @if ($service->totalOrder == 0)
                                    <a onclick="deleteData({{ $service->id }})" href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> {{__('admin.Remove')}}</a>
                                    @else

                                    <a href="javascript:;" data-toggle="modal" data-target="#canNotDeleteModal" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash" aria-hidden="true"></i> {{__('admin.Remove')}}</a>
                                    @endif

                                    <a target="_blank" href="{{ route('service', $service->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> {{__('admin.View')}}</a>


                                    <a href="{{ route('admin.additional-service', $service->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> {{__('admin.Extra')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-12">
                    {{ $services->links() }}
                </div>

                @else
                    <div class="col-12 text-center text-danger">
                        <h4>{{__('admin.Service not found!')}}</h4>
                    </div>
                @endif
          </div>
        </section>
      </div>


    </div>

<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/service/") }}'+"/"+id)
    }
</script>
@endsection
