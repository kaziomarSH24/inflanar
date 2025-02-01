@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Tawk Chat')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Tawk Chat')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-tawk-chat') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">{{__('admin.Allow Live Chat')}}</label>
                                    <select name="allow" id="tawk_allow" class="form-control">
                                        <option {{ $tawk_chat->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                        <option {{ $tawk_chat->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Tawk Chat Link')}}</label>
                                    <input type="text" class="form-control" name="chat_link" value="{{ $tawk_chat->chat_link }}">
                                </div>

                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
  </div>

@endsection
