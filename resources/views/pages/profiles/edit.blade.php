@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.profile.edit'))

@section('vendor-style')
  	<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/tag/bootstrap-tagsinput.css')) }}">
@endsection
@section('page-style')
	<style>
		.favour-color {
			padding: 2px;
		}
		.bootstrap-tagsinput input {
			width: 350px !important;
		}
	</style>
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
		<h4 class="card-title">@lang('locale.profile.title') @lang('locale.details')</h4>
	</div>
	<div class="card-content">
	<div class="card-body card-dashboard">
		<form action="{{ route('profiles.update', $profile->id) }}" method="POST">
			@csrf
			@method('PUT')
			<fieldset class="form-group">
				<label for="niche">@lang('locale.profile.niche')</label>
				<input class="form-control" value="{{ $profile->niche }}" readonly/>
			</fieldset>

			<fieldset class="form-group">
				<label for="hashtag">@lang('locale.profile.hashtag')*</label>
				<br>
				<input name="hashtag" id="hashtag" type="text" value="{{ $profile->hashtag }}" data-role="tagsinput" placeholder="{{ trans('locale.profile.addTag') }}" />
				<span class="danger">{{ $errors->first('hashtag') }}</span>
			</fieldset>

			<fieldset class="form-group">
				<label for="favour_color">@lang('locale.profile.favourColor')*</label>
				<input name="favour_color" type="color" class="form-control favour-color" placeholder="@lang('locale.profile.favourColor')" value="{{ $profile->favour_color }}">
				<span class="danger">{{ $errors->first('favour_color') }}</span>
			</fieldset>

			<fieldset class="form-group">
				<label for="instagram">@lang('locale.profile.instagram')</label>
				<input name="instagram" class="form-control" value="{{ $profile->instagram }}" readonly>
				<span class="danger">{{ $errors->first('instagram') }}</span>
			</fieldset>

			<div class="text-right">
				<button class="btn btn-primary">@lang('locale.profile.update')</button>
			</div>
		</form>
	</div>
	</div>
  </div>

@endsection

@section('vendor-script')
	<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/tag/bootstrap-tagsinput.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/profiles/create.js')) }}"></script>
@endsection
