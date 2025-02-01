@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Review Details')}}</title>
@endsection
@section('influencer-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Review Details')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('influencer.review-list') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Review List')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped table-bordered">
                           <tr>
                               <td>{{__('admin.Client')}}</td>
                               <td>{{ $review->user->name }}</td>
                           </tr>

                           <tr>
                               <td>{{__('admin.Service')}}</td>
                               <td><a href="{{ route('influencer.service.edit', ['service' => $review->service_id, 'lang_code' => front_lang()]) }}">{{ $review->service->translate->title }}</a></td>
                           </tr>

                           <tr>
                               <td>{{__('admin.Rating')}}</td>
                               <td>{{ $review->rating }}</td>
                           </tr>
                           <tr>
                               <td>{{__('admin.Review')}}</td>
                               <td>{{ html_decode($review->comment) }}</td>
                           </tr>
                           <tr>
                               <td>{{__('admin.Created At')}}</td>
                               <td>{{ $review->created_at->format('H:i A, d-m-Y') }}</td>
                           </tr>
                           <tr>
                               <td>{{__('admin.Status')}}</td>
                               <td>
                                    @if ($review->status==1)
                                        <span class="badge badge-success">{{__('admin.Active')}}</span>
                                    @else
                                        <span class="badge badge-danger">{{__('admin.Inactive')}}</span>
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

@endsection
