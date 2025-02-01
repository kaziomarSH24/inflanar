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
            <a href="{{ route('influencer.portfolio-create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                @if($portfolios->count() > 0)
                    @foreach ($portfolios as $portfolio)
                        <div class="col-12">
                            <div class="card service_card">
                                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                    <img class="service_image" src="{{ asset($portfolio->image) }}" alt="">
                                    <div class="service_detail">
                                        <h4>{{ $portfolio->name }}</h4>
                                        <p>{{__('admin.Status')}} :
                                        @if ($portfolio->status == '1')
                                            <span class="badge badge-success">{{__('admin.Active')}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('admin.Inactive')}}</span>
                                        @endif

                                        </p>
                                        <a href="{{ route('influencer.portfolio-edit',$portfolio->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> {{__('admin.Edit')}}</a>

                                        <a onclick="deleteData({{ $portfolio->id }})" href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> {{__('admin.Remove')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="col-12 text-center text-danger">
                        <h4>{{__('admin.Portfolio not found!')}}</h4>
                    </div>
                @endif


                <div class="col-12">
                    {{ $portfolios->links() }}
                </div>
          </div>
        </section>
      </div>


<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("influencer/portfolio-destory/") }}'+"/"+id)
    }
</script>
@endsection
