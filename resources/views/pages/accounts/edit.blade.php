@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.account.title'))

@section('vendor-style')
@endsection
@section('page-style')

@endsection

@section('content')
	@if (session()->get('message'))
	<div class="alert alert-primary alert-dismissible fade show" role="alert">
		<p class="mb-0">
			{{ session()->get('message') }}
		</p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<form action="{{ route('account.update', $user) }}" method="POST" enctype="multipart/form-data">
					@csrf
					<fieldset class="form-group">
						<div class="controls">
							@if($user->photo === null)
							<img src="{{ asset('images/avatar.png') }}" id="create-post-image" class="rounded mr-75"
								  alt="avatar" height="200" width="200" style="margin-left: calc(50% - 100px);" />
							@else
							<img src="{{ asset('storage') . '/' . $user->photo }}" id="create-post-image" class="rounded mr-75"
								  alt="avatar" height="200" width="200" style="margin-left: calc(50% - 100px);" />
							@endif
						  <input type="hidden" name="create_image_status" id="create-image-status" value="false"/>
						  <div style="margin-left: calc(49.5% - 70px); margin-top: 10px;">
							 <label class="btn btn-sm btn-primary text-white cursor-pointer"
									  for="create-image-upload" id="create_upload_new">Upload</label>
							 <label class="btn btn-sm btn-danger text-white cursor-pointer" id="create_upload_remove">Remove</label>
							 <input type="file" name="photo" id="create-image-upload" ref="create_image_upload" hidden>
						  </div>
						</div>
					</fieldset>
	
					<fieldset class="form-group">
						<label for="username"> {{ trans('locale.Username') }}*</label>
						<input name="username" class="form-control" placeholder="@lang('locale.Username')" value="{{ $user->name }}">
						<span class="danger">{{ $errors->first('username') }}</span>
					</fieldset>
	
					<fieldset class="form-group">
						<label for="firstname"> {{ trans('locale.account.firstname') }}*</label>
						<input name="firstname" class="form-control" placeholder="@lang('locale.account.firstname')" value="{{ $user->firstname }}">
						<span class="danger">{{ $errors->first('firstname') }}</span>
					</fieldset>
	
					<fieldset class="form-group">
						<label for="lastname"> {{ trans('locale.account.lastname') }}*</label>
						<input name="lastname" class="form-control" placeholder="@lang('locale.account.lastname')" value="{{ $user->lastname }}">
						<span class="danger">{{ $errors->first('lastname') }}</span>
					</fieldset>
	
					<div class="text-right">
						<button class="btn btn-primary">@lang('locale.account.save')</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('vendor-script')
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/accounts/edit.js')) }}"></script>
@endsection
