@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.freepost.create'))

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<h4 class="card-title">@lang('locale.freepost.title') @lang('locale.details')</h4>
	</div>
	<div class="card-content">
		<div class="card-body">
		<form id="saveForm" action="{{ route('freeposts.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<fieldset class="form-group">
				<div class="controls">
					<img src="{{ asset('images/pages/default-post.png') }}" id="create-post-image" class="rounded mr-75"
						alt="avatar" width="200" style="margin-left: calc(50% - 100px);" />
				<div style="margin-left: calc(49.5% - 70px); margin-top: 10px;">
					<label class="btn btn-sm btn-primary text-white cursor-pointer"
							for="create-image-upload" id="create_upload_new">Upload</label>
					<label class="btn btn-sm btn-danger text-white cursor-pointer" id="create_upload_remove">Remove</label>
					<input type="file" name="image" id="create-image-upload" ref="create_image_upload" hidden>
				</div>
				</div>
			</fieldset>

			<fieldset class="form-group">
				<label for="title"> {{ trans('locale.freepost.title') }}*</label>
				<input name="title" class="form-control @error('title') is-invalid @enderror">
				<span class="danger">{{ $errors->first('title') }}</span>
			</fieldset>

			<fieldset class="form-group">
				<div class="controls">
					<label for="content">Content*</label>
					<textarea name="content" class="form-control"rows="5"></textarea>
				 </div>
				<span class="danger">{{ $errors->first('content') }}</span>
			</fieldset>

			<div class="text-right">
				<button class="btn btn-primary">@lang('locale.freepost.save')</button>
			</div>
		</form>
		</div>
	</div>
</div>
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
	<script>
		$('#saveForm').submit(function(event){
			event.preventDefault();
			
			if ($('#create-image-upload').val() === '') {
				toastr.warning(
              '{{ trans("locale.error.postImageValidate") }}',
              '{{ trans("locale.warning") }}',
              {
                "progressBar": true,
                "closeButton": true,
                timeOut: 2000
              }
            );
			} else {
				this.submit();
			}
		});

		$('#create-image-upload').change(function(){
			var input = this;
			var url = $(this).val();
			var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
			if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
			{
			  var reader = new FileReader();
		
			  reader.onload = function (e) {
				 $('#create-post-image').attr('src', e.target.result);
			  }
			  reader.readAsDataURL(input.files[0]);
			}
			else
			{
			  $('#create-post-image').attr('src', '/images/avatar.png');
			}
		});
	
		$('#create_upload_remove').click(function(){
			$('#create-image-upload').val('');
			$('#create-post-image').attr('src', '/images/avatar.png');
		 });
	</script>
@endsection