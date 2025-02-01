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
            <a class="btn btn-primary" href="{{ route('influencer.create-new-ticket') }}"> <i class="fa fa-plus" aria-hidden="true"></i> {{__('admin.Create Ticket')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped report_table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th >{{__('admin.Ticket Info')}}</th>
                                    <th >{{__('admin.Unread Message')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $index => $ticket)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            <p>{{__('admin.Subject')}}: {{ html_decode($ticket->subject) }}</p>
                                            <p>{{__('admin.Ticket Id')}}: {{ $ticket->ticket_id }}</p>

                                            <p>{{__('admin.Created')}}: {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
                                        </td>

                                        <td>
                                            <span class="badge badge-danger">{{ $ticket->unseen_for_user }}</span>

                                        </td>


                                        <td>
                                            @if($ticket->status == 'pending')
                                            <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                            @elseif ($ticket->status == 'in_progress')
                                            <span class="badge badge-success">{{__('admin.In Progress')}}</span>
                                            @elseif ($ticket->status == 'closed')
                                            <span class="badge badge-danger">{{__('admin.Closed')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('influencer.ticket-show',$ticket->ticket_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

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
        </section>
      </div>

@endsection
