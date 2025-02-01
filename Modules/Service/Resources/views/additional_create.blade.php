@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Additional Service')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Additional Service')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.additional-service', $id) }}" class="btn btn-primary"><i class="fas fa-backward"></i> {{__('admin.Go Back')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.additional-store', $id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">{{__('admin.Image')}}</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Price')}}</label>
                                <input type="text" name="price" class="form-control">
                            </div>

                            <div class="row" id="package_feature_box">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <label>{{__('admin.Feature')}}</label>
                                            <input type="text" class="form-control" name="features[]" autocomplete="off">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" type="button" id="addNewPackageFeature" class="btn btn-success btn_mt_33"><i class="fa fa-plus" aria-hidden="true"></i> {{__('admin.Add New')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary">{{__('admin.Save')}}</button>
                        </form>

                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>



 <script>
    (function($) {
        "use strict";
        $(document).ready(function () {

            // start package feature section
            $("#addNewPackageFeature").on("click", function(){
                let package_feature = `
                    <div class="col-12 pacakge_feature_row">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>{{__('admin.Feature')}}</label>
                                <input type="text" class="form-control" name="features[]" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn_mt_33 delete_package_feature"><i class="fa fa-trash" aria-hidden="true"></i> {{__('admin.Remove')}}</button>
                            </div>
                        </div>
                    </div>`;
                $("#package_feature_box").append(package_feature)
            });

            $(document).on('click', '.delete_package_feature', function () {
                $(this).closest('.pacakge_feature_row').remove();
            });

            // end package feature

        })
    })(jQuery);

</script>

@endsection
