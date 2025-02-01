@extends('influencer.master_layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('influencer-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ $title }}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('influencer.service.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                @if($services->count() > 0)
                @foreach ($services as $service)
                    <div class="col-12">
                        <div class="card service_card">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <img class="service_image" src="{{ asset($service->thumbnail_image) }}" alt="">
                                <div class="service_detail">
                                    <h4>{{ $service->title }}</h4>
                                    <h6>{{__('admin.Price')}} :
                                        {{ currency($service->price) }}
                                    </h6>
                                    <p>{{__('admin.Category')}} : {{ $service->category->name }}</p>
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
                                    <a href="{{ route('influencer.service.edit', ['service' => $service->id, 'lang_code' => front_lang()]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> {{__('admin.Edit')}}</a>

                                    <a onclick="deleteData({{ $service->id }})" href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> {{__('admin.Remove')}}</a>

                                    <a target="_blank" href="{{ route('service', $service->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> {{__('admin.View')}}</a>

                                    <a href="{{ route('influencer.additional-service', $service->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> {{__('admin.Extra')}}</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @else
                    <div class="col-12 text-center text-danger">
                        <h4>{{__('admin.Service not found!')}}</h4>
                    </div>
                @endif


                <div class="col-12">
                    {{ $services->links() }}
                </div>
          </div>
        </section>
      </div>


<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("influencer/service/") }}'+"/"+id)
    }
</script>
@endsection
