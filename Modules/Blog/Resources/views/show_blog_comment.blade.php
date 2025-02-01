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
                        <table class="table table-bordered">
                            <tr>
                                <td>{{__('admin.Name')}}</td>
                                <td>{{ html_decode($blog_comment->name) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Email')}}</td>
                                <td><a href="mailto:{{ html_decode($blog_comment->email) }}">{{ html_decode($blog_comment->email) }}</a></td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Creted at')}}</td>
                                <td>{{ $blog_comment->created_at->format('h:iA, d F Y') }}</td>
                            </tr>


                            <tr>
                                <td>{{__('admin.Comment')}}</td>
                                <td>{{ html_decode($blog_comment->comment) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Go to Blog')}}</td>
                                <td> <a target="_blank" class="btn btn-success btn-sm" href="{{ route('blog', $blog_comment->blog->slug) }}
                                    ">{{__('admin.view')}}</a></td>
                            </tr>
                            <tr>
                                <td>{{__('admin.Status')}}</td>
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
                            </tr>

                        </table>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    "use strict"
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
