@extends('influencer.master_layout')
@section('title')
<title>{{__('admin.Support Ticket')}}</title>
@endsection
@section('influencer-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Support Ticket')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body ticket-message">
                            <div class="list-group">
                                @foreach ($messages as $message)
                                    @if ($message->admin_id == 0)
                                        <div class="list-group-item list-group-item-action flex-column align-items-start author_message mb-2">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1"> {{ $ticket->user->name }} <small>({{__('admin.Author')}})</small></h6> <small>{{ $message->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1">{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                            @if ($message->documents)
                                                <div class="gallery">
                                                    @foreach ($message->documents as $document)
                                                        <a href="{{ route('download-file', $document->file_name) }}" class="upload_photo"><i class="fas fa-link"></i> {{ $document->file_name }}</a>
                                                    @endforeach
                                                </div>
                                            @endif

                                        </div>
                                    @else
                                        <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ $message->admin ? $message->admin->name : '' }} <small>({{__('admin.Administrator')}})</small></h6> <small>{{ $message->created_at->diffForHumans() }} </small>
                                            </div>
                                            <p class="mb-1">{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                            @if ($message->documents)
                                                <div class="gallery">
                                                    @foreach ($message->documents as $document)
                                                        <a href="{{ route('download-file', $document->file_name) }}" class="upload_photo"><i class="fas fa-link"></i> {{ $document->file_name }}</a>
                                                    @endforeach
                                                </div>
                                            @endif

                                        </div>

                                    @endif
                                @endforeach


                            </div>

                            @if ($ticket->status != 'closed')
                                <div class="message-box mt-4">
                                    <form action="{{ route('influencer.store-ticket-message') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <textarea required name="message" placeholder="{{__('admin.Type here')}}.." class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                                        </div>
                                        <input type="hidden" value="{{ $ticket->id }}" name="ticket_id">
                                        <input type="hidden" value="{{ $ticket->user->id }}" name="user_id">
                                        <div class="form-group">
                                            <input type="file" name="documents[]" multiple class="form-control">
                                            <span class="text-danger">{{__('admin.Maximum file size 2MB')}}</span>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{__('admin.Submit')}}</button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>{{__('admin.Ticket Information')}}</h6>
                            <hr>
                            <p>{{__('admin.Subject')}}: {{ html_decode($ticket->subject) }}</p>
                            <p>{{__('admin.Ticket Id')}}: {{ $ticket->ticket_id }}</p>
                            <p>{{__('admin.Created')}}: {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
                            <p>{{__('admin.Status')}}:
                                @if($ticket->status == 'pending')
                                <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                @elseif ($ticket->status == 'in_progress')
                                <span class="badge badge-success">{{__('admin.In Progress')}}</span>
                                @elseif ($ticket->status == 'closed')
                                <span class="badge badge-danger">{{__('admin.Closed')}}</span>
                                @endif
                            </p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
