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
	<section id="page-account-settings">
		<div class="row">
		  <!-- left menu section -->
		  <div class="col-md-3 mb-2 mb-md-0">
			 <ul class="nav nav-pills flex-column mt-md-0 mt-1">
				<li class="nav-item">
				  <a class="nav-link d-flex py-75 {{ old('type') != 'password' ? 'active' : '' }}" id="account-pill-general" data-toggle="pill"
					 href="#account-vertical-general" aria-expanded="true">
					 <i class="feather icon-globe mr-50 font-medium-3"></i>
					 @lang('locale.account.general')
				  </a>
				</li>
				<li class="nav-item">
				  <a class="nav-link d-flex py-75 {{ old('type') == 'password' ? 'active' : '' }}" id="account-pill-password" data-toggle="pill"
					 href="#account-vertical-password" aria-expanded="false">
					 <i class="feather icon-lock mr-50 font-medium-3"></i>
					 @lang('locale.account.changePassword')
				  </a>
				</li>
			 </ul>
		  </div>
		  <!-- right content section -->
		  <div class="col-md-9">
			 <div class="card">
				<div class="card-content">
				  <div class="card-body">
					 <div class="tab-content">
						<div role="tabpanel" class="tab-pane  {{ old('type') != 'password' ? 'active' : '' }}" id="account-vertical-general"
						  aria-labelledby="account-pill-general" aria-expanded="true">
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
									<input name="username" class="form-control @error('username') is-invalid @enderror" placeholder="@lang('locale.Username')" value="{{ $user->name }}">
									<span class="danger">{{ $errors->first('username') }}</span>
								</fieldset>
				
								<fieldset class="form-group">
									<label for="firstname"> {{ trans('locale.account.firstname') }}*</label>
									<input name="firstname" class="form-control @error('firstname') is-invalid @enderror" placeholder="@lang('locale.account.firstname')" value="{{ $user->firstname }}">
									<span class="danger">{{ $errors->first('firstname') }}</span>
								</fieldset>
				
								<fieldset class="form-group">
									<label for="lastname"> {{ trans('locale.account.lastname') }}*</label>
									<input name="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="@lang('locale.account.lastname')" value="{{ $user->lastname }}">
									<span class="danger">{{ $errors->first('lastname') }}</span>
								</fieldset>
				
								<div class="text-right">
									<button class="btn btn-primary">@lang('locale.account.save')</button>
								</div>
							</form>
						</div>
						<div class="tab-pane {{ old('type') == 'password' ? 'active' : 'fade' }}" id="account-vertical-password" role="tabpanel"
						  aria-labelledby="account-pill-password" aria-expanded="false">
						  <form action="{{ route('account.changepassword', $user) }}" method="POST">
							 @csrf
							 <input type="hidden" name="type" value="password">
							 <div class="row">
								<div class="col-12">
								  <div class="form-group">
									 <label for="email">@lang('locale.account.oldPassword')</label>
									 <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="{{ trans('locale.account.oldPassword') }}" value="{{ old('old_password') }}">
									 <span class="danger">{{ $errors->first('old_password') }}</span>
								  </div>
								</div>
								
								<div class="col-12">
								  <div class="form-group">
									 <label for="email">@lang('locale.account.newPassword')</label>
									 <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="{{ trans('locale.account.newPassword') }}" value="{{ old('new_password') }}">
									 <span class="danger">{{ $errors->first('new_password') }}</span>
								  </div>
								</div>
								
								<div class="col-12">
								  <div class="form-group">
									 <label for="email">@lang('locale.account.retypePassword')</label>
									 <input id="retype_password" type="password" class="form-control @error('retype_password') is-invalid @enderror" name="retype_password" placeholder="{{ trans('locale.account.retypePassword') }}" value="{{ old('retype_password') }}">
									 <span class="danger">{{ $errors->first('retype_password') }}</span>
								  </div>
								</div>
  
								<div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
								  <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
									 changes</button>
								  <button type="reset" class="btn btn-outline-warning">Cancel</button>
								</div>
							 </div>
						  </form>
						</div>
						</div>
					 </div>
				  </div>
				</div>
			 </div>
		  </div>
		</div>
  	</section>
@endsection

@section('vendor-script')
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/accounts/edit.js')) }}"></script>
@endsection
