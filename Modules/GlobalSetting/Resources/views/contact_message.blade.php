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
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-body">
                            <form action="{{ route('admin.contact-message-setting') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="">{{__('admin.Contact message reciever mail')}}</label>
                                    <input type="email" name="contact_message_mail" class="form-control" value="{{ $setting->contact_message_mail }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Message save to database?')}}</label>
                                    <select name="save_contact_message" id="" class="form-control">
                                        <option {{ $setting->save_contact_message == 'enable' ? 'selected' : '' }} value="enable">{{__('admin.Enable')}}</option>
                                        <option {{ $setting->save_contact_message == 'disable' ? 'selected' : '' }} value="disable">{{__('admin.Disable')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Message send to mail?')}}</label>
                                    <select name="send_contact_message" id="" class="form-control">
                                        <option {{ $setting->send_contact_message == 'enable' ? 'selected' : '' }} value="enable">{{__('admin.Enable')}}</option>
                                        <option {{ $setting->send_contact_message == 'disable' ? 'selected' : '' }} value="disable">{{__('admin.Disable')}}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th width="5%">{{__('admin.SN')}}</th>
                                            <th width="10%">{{__('admin.Name')}}</th>
                                            <th width="15%">{{__('admin.Email')}}</th>
                                            <th width="10%">{{__('admin.Phone')}}</th>
                                            <th width="20%">{{__('admin.Subject')}}</th>
                                            <th width="20%">{{__('admin.Created at')}}</th>
                                            <th width="5%">{{__('admin.Action')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contact_messages as $index => $contact_message)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ html_decode($contact_message->name) }}</td>
                                                <td><a href="mailto:{{ html_decode($contact_message->email) }}">{{ html_decode($contact_message->email) }}</a></td>
                                                <td><a href="tel:{{ html_decode($contact_message->phone) }}">{{ html_decode($contact_message->phone) }}</a></td>
                                                <td>{{ html_decode($contact_message->subject) }}</td>
                                                <td>{{ $contact_message->created_at->format('h:iA, d F Y') }}</td>

                                                <td>

                                                    <a href="{{ route('admin.show-message', $contact_message->id) }}"  class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>


                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $contact_message->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
        </div>
    </section>
  </div>

    <script>
        "use strict";
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-contact-message/") }}'+"/"+id)
        }
    </script>

@endsection
