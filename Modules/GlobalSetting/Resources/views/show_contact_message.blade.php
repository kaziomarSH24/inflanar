@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Contact Message')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Contact Message')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tr>
                                    <td>{{__('admin.Name')}}</td>
                                    <td>{{ html_decode($contact_message->name) }}</td>
                                </tr>

                                <tr>
                                    <td>{{__('admin.Email')}}</td>
                                    <td><a href="mailto:{{ html_decode($contact_message->email) }}">{{ html_decode($contact_message->email) }}</a></td>
                                </tr>

                                <tr>
                                    <td>{{__('admin.Phone')}}</td>
                                    <td><a href="tel:{{ html_decode($contact_message->phone) }}">{{ html_decode($contact_message->phone) }}</a></td>
                                </tr>

                                <tr>
                                    <td>{{__('admin.Creted at')}}</td>
                                    <td>{{ $contact_message->created_at->format('h:iA, d F Y') }}</td>
                                </tr>

                                <tr>
                                    <td>{{__('admin.Subject')}}</td>
                                    <td>{{ html_decode($contact_message->subject) }}</td>
                                </tr>

                                <tr>
                                    <td>{{__('admin.Subject')}}</td>
                                    <td>{{ html_decode($contact_message->message) }}</td>
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
