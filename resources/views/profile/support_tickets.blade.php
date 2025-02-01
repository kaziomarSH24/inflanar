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

<!-- Support TIcket  -->
<div class="inflanar-preview__modal modal fade" id="open_ticket" tabindex="-1" aria-labelledby="OpenTicketmodal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered inflanar-preview__ticket">
        <div class="modal-content">
            <div class="modal-header inflanar__modal__header">
                <h4 class="modal-title inflanar-preview__modal-title" id="OpenTicketmodal">{{__('admin.Open New Ticket')}}</h4>
                <button type="button" class="inflanar-preview__modal--close btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-remove"></i></button>
            </div>
            <div class="modal-body inflanar-modal__body">
                <form action="{{ route('user.create-support-ticket') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-12 mg-top-20">
                            <div class="form-group inflanar-form-input">
                                <label>{{__('admin.Subject')}}*</label>
                                <input class="ecom-wc__form-input" type="text" name="subject" placeholder="{{__('admin.Your Subject')}}" >
                            </div>
                        </div>
                        <div class="col-12 mg-top-20">
                            <div class="form-group inflanar-form-input">
                                <label>{{__('admin.Message')}}*</label>
                                <div class="form-group inflanar-form-input">
                                    <textarea placeholder="{{__('admin.Write your message')}}" name="message" id="ckdesc1"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mg-top-20">
                            <button type="submit" class="inflanar-btn"><span>{{__('admin.Submit Now')}}</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Support TIcket  -->


<!-- Features -->
<section class="inflaner-inner-page pd-top-90 pd-btm-120">
    <div class="container">
        <div class="inflanar-personals">
            <div class="row">
                @include('profile.sidebar')

                <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content mg-top-30">
                    <div class="inflanar-supports">
                        <div class="inflanar-supports__head">
                            <h4>{{__('admin.Support Ticket List')}}</h4>
                            <div class="inflanar-supports__buttons">
                                <a href="#" class="inflanar-btn"  data-bs-toggle="modal" data-bs-target="#open_ticket">{{__('admin.Open Ticket')}}</a>
                            </div>
                        </div>
                        <div class="inflanar-table p-0">
                            <table id="inflanar-table__order" class="inflanar-table__main inflanar-table__main-v2">
                                <!-- sherah Table Head -->
                                <thead class="inflanar-table__head">
                                    <tr>
                                        <th class="inflanar-table__column-1 inflanar-table__h1">{{__('admin.SN')}}</th>
                                        <th class="inflanar-table__column-2 inflanar-table__h2">{{__('admin.Ticket Info')}}</th>
                                        <th class="inflanar-table__column-3 inflanar-table__h3">{{__('admin.Unread Message')}}</th>
                                        <th class="inflanar-table__column-4 inflanar-table__h4">{{__('admin.Status')}}</th>
                                        <th class="inflanar-table__column-5 inflanar-table__h5">{{__('admin.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="inflanar-table__body">
                                    @foreach ($tickets as $index => $ticket)
                                        <tr>
                                            <td class="inflanar-table__column-1 inflanar-table__data-1">
                                                <div class="inflanar-table__content">
                                                    <p class="inflanar-table__desc">{{ ++$index }}</p>
                                                </div>
                                            </td>
                                            <td class="inflanar-table__column-2 inflanar-table__data-2">
                                                <div class="inflanar-table__content">
                                                    <p class="inflanar-table__desc">{{__('admin.Subject')}}: {{ html_decode($ticket->subject) }}</p>
                                                    <p class="inflanar-table__desc">{{__('admin.Ticket Id')}}: {{ $ticket->ticket_id }}</p>
                                                    <p class="inflanar-table__desc"> {{__('admin.Created')}}: {{ $ticket->created_at->format('h:m A, d-F-Y') }}</p>
                                                </div>
                                            </td>
                                            <td class="inflanar-table__column-3 inflanar-table__data-3">
                                                <div class="inflanar-table__content">
                                                    <p class="inflanar-table__unread">{{ $ticket->unseen_for_user }}</p>
                                                </div>
                                            </td>
                                            <td class="inflanar-table__column-5 inflanar-table__data-5">
                                                <div class="inflanar-table__content">
                                                    @if ($ticket->status == 'pending')
                                                    <p class="inflanar-table__label inflanar-table__label--pending">{{__('admin.Pending')}}</p></p>
                                                    @elseif ($ticket->status == 'in_progress')
                                                    <p class="inflanar-table__label inflanar-table__label--active">{{__('admin.In Progress')}}</p>
                                                    @elseif ($ticket->status == 'closed')
                                                    <p class="inflanar-table__label inflanar-table__label--pending">{{__('admin.Closed')}}</p></p>
                                                    @endif

                                                </div>
                                            </td>



                                            <td class="inflanar-table__column-6 inflanar-table__data-6">
                                                <div class="inflanar-table__status__group">
                                                    <a href="{{ route('user.support-ticket',$ticket->ticket_id) }}" class="inflanar-table__action inflanar-table__action--view"><img src="{{ asset('frontend/img/in-table-eye-icon.svg') }}"></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="inflanar-supports__bgroup mg-top-40">
                        {{ $tickets->links('custom_pagination') }}
                    </div>
                    <!-- End Pagination -->
                </div>


            </div>
        </div>
    </div>
</section>
<!-- End Features -->

@endsection
