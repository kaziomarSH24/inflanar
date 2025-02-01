@extends('layout')
@section('title')
    <title>{{__('admin.Support Ticket')}}</title>
@endsection
@section('frontend-content')

<!-- Breadcrumbs -->
<section class="inflanar-breadcrumb" style="background-image: url({{ asset($breadcrumb) }});">
    <div class="container">
        <div class="row">
            <!-- Breadcrumb-Content -->
            <div class="col-12">
                <div class="inflanar-breadcrumb__inner">
                    <div class="inflanar-breadcrumb__content">
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Support Ticket')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.Support Ticket')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<!-- Features -->
<section class="inflaner-inner-page pd-top-90 pd-btm-120">
    <div class="container">
        <div class="inflanar-personals">
            <div class="row">
                @include('profile.sidebar')

                <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content mg-top-30">
                    <div class="inflanar-supports">
                        <div class="inflanar-supports__detail">
                           <div class="row">
                                <div class="col-lg-8 col-12">
                                    <div class="inflanar-supports__single">
                                        <div class="inflanar-supports__head">
                                            <div class="inflanar-supports__buttons">
                                                <a href="{{ route('user.support-tickets') }}" class="inflanar-btn"><i class="fa-solid fa-left-long"></i> {{__('admin.Go Back')}}</a>
                                            </div>
                                        </div>

                                        @foreach ($messages as $message)
                                        @if ($message->admin_id == 0)
                                        <div class="inflanar-supports__single-reply mg-top-20">
                                            <div class="inflanar-supports__notice inflanar-supports__notice--v2">
                                                <div class="inflanar-supports__notice--head">
                                                    <div class="inflanar-supports__notice--hcontent">
                                                        <h4 class="inflanar-supports__ntitle">{{ $ticket->user->name }} <span>({{__('admin.Me')}})</span> </h4>
                                                    </div>
                                                    <div class="inflanar-supports__ntime"><span>{{ $message->created_at->diffForHumans() }}</span></div>
                                                </div>
                                                <div class="inflanar-supports__nmain">
                                                    <p class="inflanar-supports__nfield">
                                                        {!! html_decode(clean(nl2br($message->message))) !!}
                                                    </p>

                                                    @if ($message->documents)
                                                        <div class="gallery">
                                                            @foreach ($message->documents as $document)
                                                                <a href="{{ route('download-file', $document->file_name) }}" class="upload_photo"><i class="fas fa-link"></i> {{ $document->file_name }}</a>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Reply -->
                                        @else
                                        <div class="inflanar-supports__notice inflanar-supports__notice--v2 mg-top-20">
                                            <div class="inflanar-supports__notice--head">
                                                <div class="inflanar-supports__notice--hcontent">
                                                    <h4 class="inflanar-supports__ntitle">{{ $message->admin ? $message->admin->name : '' }} <span>({{__('admin.Administrator')}})</span></h4>

                                                </div>
                                                <div class="inflanar-supports__ntime"><span>{{ $message->created_at->diffForHumans() }}</span></div>
                                            </div>
                                            <div class="inflanar-supports__nmain">
                                                <p class="inflanar-supports__nfield">{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                                @if ($message->documents)
                                                    <div class="gallery">
                                                        @foreach ($message->documents as $document)
                                                            <a href="{{ route('download-file', $document->file_name) }}" class="upload_photo"><i class="fas fa-link"></i> {{ $document->file_name }}</a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif


                                        @endforeach
                                    </div>

                                    @if ($ticket->status != 'closed')
                                        <div class="inflanar-supports__single mg-top-30">
                                            <div class="inflanar-supports__form">
                                                <form action="{{ route('user.send-ticket-message') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                    <div class="form-group">
                                                        <textarea class="ecom-wc__form-input" name="message" placeholder="{{__('admin.Write your message')}}"></textarea>
                                                    </div>
                                                    <div class="form-group  mg-top-30">
                                                        <div class="inflanar-form-file">
                                                            <input class="d-none" id="support-file-input" type="file" name="documents[]" multiple>
                                                            <label for="support-file-input">{{__('admin.Choose file')}}</label>
                                                            <span>{{__('admin.Maximum file size 2MB')}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mg-top-30">
                                                        <button type="submit" class="inflanar-btn"><span>{{__('admin.Submit Now')}}</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif


                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="inflanar-supports__tickets">
                                        <h4 class="inflanar-supports__info">{{__('admin.Ticket Information')}}</h4>
                                        <div class="inflanar-table__content">
                                            <p class="inflanar-table__desc">{{__('admin.Subject')}}: {{ html_decode($ticket->subject) }}</p>
                                            <p class="inflanar-table__desc">{{__('admin.Ticket Id')}}: {{ $ticket->ticket_id }}</p>
                                            <p class="inflanar-table__desc"> {{__('admin.Created')}}: {{ $ticket->created_at->format('h:m A, d-F-Y') }}</p>
                                        </div>
                                        <div class="inflanar-supports__status">
                                            <h4 class="inflanar-supports__status--title">{{__('admin.Status')}}</h4>
                                            @if ($ticket->status == 'pending')
                                            <p class="inflanar-table__label inflanar-table__label--pending">{{__('admin.Pending')}}</p></p>
                                            @elseif ($ticket->status == 'in_progress')
                                            <p class="inflanar-table__label inflanar-table__label--active">{{__('admin.In Progress')}}</p>
                                            @elseif ($ticket->status == 'closed')
                                            <p class="inflanar-table__label inflanar-table__label--pending">{{__('admin.Closed')}}</p></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<!-- End Features -->

@endsection
