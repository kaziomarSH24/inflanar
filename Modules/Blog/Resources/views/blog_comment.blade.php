@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Blog Comment')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Blog Comment')}}</h1>
          </div>

          <div class="section-body">

            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="5%">{{__('admin.SN')}}</th>
                                    <th width="15%">{{__('admin.Name')}}</th>
                                    <th width="15%">{{__('admin.Email')}}</th>
                                    <th width="10%">{{__('admin.Blog')}}</th>
                                    <th width="15%">{{__('admin.Status')}}</th>
                                    <th width="5%">{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($blog_comments as $index => $blog_comment)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ html_decode($blog_comment->name) }}</td>
                                        <td>{{ $blog_comment->email }}</td>
                                        <td> <a target="_blank" class="btn btn-success btn-sm" href="{{ route('blog', $blog_comment->blog->slug) }}
                                            ">{{__('admin.view')}}</a></td>
                                        <td>

                                            @if($blog_comment->status == 1)
                                            <a href="javascript:;" onclick="changeBlogCommentStatus({{ $blog_comment->id }})">
                                                <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>

                                            @else
                                            <a href="javascript:;" onclick="changeBlogCommentStatus({{ $blog_comment->id }})">
                                                <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>

                                            @endif
                                        </td>
                                        <td>

                                        <a href="{{ route('admin.show-comment', $blog_comment->id) }}"  class="btn btn-success btn-sm" ><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $blog_comment->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/delete-blog-comment/") }}'+"/"+id)
    }
    function changeBlogCommentStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/blog-comment-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
