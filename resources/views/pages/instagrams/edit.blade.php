@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.instagram.edit'))

@section('vendor-style')
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/tag/bootstrap-tagsinput.css')) }}">
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
	<div class="card-header">
		<h4 class="card-title">@lang('locale.instagram.title') @lang('locale.details')</h4>
	</div>
	<div class="card-content">
	<div class="card-body card-dashboard">
		<form action="{{ route('instagrams.store', $profile->id) }}" method="POST">
			@csrf
			<fieldset class="form-group">
				<label for="followers">@lang('locale.instagram.followers')*</label>
				<input type="number" name="followers" class="form-control" value="{{ $profile->analysistInstagram->followers ?? '' }}"/>
				<span class="danger">{{ $errors->first('followers') }}</span>
			</fieldset>

			<fieldset class="form-group">
				<label for="best_hashtags">@lang('locale.instagram.bestHashtags')*</label>
				<br>
				<input name="best_hashtags" id="best_hashtags" type="text" value="{{ $profile->analysistInstagram->best_hashtags ?? '' }}" data-role="tagsinput"/>
				<span class="danger">{{ $errors->first('best_hashtags') }}</span>
			</fieldset>

			<fieldset class="form-group">
				<label for="posts">@lang('locale.instagram.posts')*</label>
				<input type="number" name="posts" class="form-control" value="{{ $profile->analysistInstagram->posts ?? '' }}"/>
				<span class="danger">{{ $errors->first('posts') }}</span>
			</fieldset>

			<fieldset class="form-group">
				<label for="advices">@lang('locale.instagram.advices')*</label>
				<input name="advices" class="form-control" value="{{ $profile->analysistInstagram->advices ?? '' }}">
				<span class="danger">{{ $errors->first('advices') }}</span>
			</fieldset>

			<div class="text-right">
				<button class="btn btn-primary">@lang('locale.instagram.save')</button>
			</div>
		</form>
	</div>
	</div>
  </div>

@endsection

@section('vendor-script')
	<script src="{{ asset(mix('vendors/js/tag/bootstrap-tagsinput.min.js')) }}"></script>
@endsection
@section('page-script')
  <script>
		$(document).keypress(
			function(event){
				if (event.which == '13') {
					event.preventDefault();
				}
		});
  </script>
@endsection
