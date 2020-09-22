@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.post-manage.title'))

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/validation/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/post-manage.css')) }}">
@endsection

@include('pages/post-manage-sidebar')
@section('content')
  <input type="hidden" id="_token" value="{{ @csrf_token() }}">
  <div class="chat-overlay"></div>
  <section class="chat-app-window">
    <div class="start-chat-area">
      <h4 class="py-50 px-1 sidebar-toggle start-chat-text">View Profile</h4>
    </div>
    <div class="active-chat d-none">
      <div class="chat_navbar">
        <header class="chat_header d-flex justify-content-between align-items-center p-1">
          <div class="vs-con-items d-flex align-items-center">
            <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
            <div class="avatar user-profile-toggle m-0 m-0 mr-1">
{{--              <img src="{{ asset('images/portrait/small/avatar-s-1.jpg') }}" alt="" height="40" width="40" />--}}
              <p class="mb-0" style="height: 40px; width: 40px; border-radius: 50%;"></p>
            </div>
            <h6 class="mb-0 profile-title">Felecia Rower</h6>
          </div>
        </header>
      </div>
      <div class="user-chats">
        <div class="chats">
          <div class="row card-post">

          </div>
        </div>
      </div>
      <div class="chat-app-form text-right">
        <button type="button" class="btn btn-primary mr-2" onclick="create();">Create post</button>
      </div>
    </div>
  </section>
  <div class="modal fade" id="create-post" tabindex="-1" role="dialog" aria-labelledby="create-post" aria-hidden="true">
    <form novalidate id="create-post-form">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Create new post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <div class="controls">
                      <img src="{{ asset('images/pages/default-post.png') }}" id="create-post-image" class="rounded mr-75"
                           alt="post image" height="200" width="200" style="margin-left: calc(50% - 100px);" />
                      <input type="hidden" name="create_image_status" id="create-image-status" value="false"/>
                      <div style="margin-left: calc(50% - 70px); margin-top: 10px;">
                        <label class="btn btn-sm btn-primary text-white cursor-pointer"
                               for="create-image-upload" id="create_upload_new">Upload new image</label>
                        <label class="btn btn-sm btn-danger text-white cursor-pointer" id="create_upload_remove" style="display: none">Remove image</label>
                        <input type="file" id="create-image-upload" ref="create_image_upload" hidden>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="controls">
                      <label for="create-modal-title">Title</label>
                      <input type="text" id="create-modal-title" class="form-control" placeholder="" required data-validation-required-message="This Title field is required" >
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="controls">
                      <label for="create-modal-content">Content</label>
                      <textarea class="form-control" id="create-modal-content" rows="5" required
                                data-validation-required-message="This Content field is required"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/post-manage.js')) }}"></script>
@endsection
