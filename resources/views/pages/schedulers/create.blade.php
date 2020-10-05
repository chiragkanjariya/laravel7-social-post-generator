@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.scheduler.create'))

@section('vendor-style')
  	<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
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
		<h4 class="card-title">@lang('locale.scheduler.title') @lang('locale.details')</h4>
	</div>
	<div class="card-content">
	<div class="card-body card-dashboard">
		<form action="{{ route('schedulers.store') }}" method="POST">
			@csrf
			<fieldset class="form-group">
				<label for="title">@lang('locale.scheduler.scheduleTitle')</label>
				<input name="title" class="form-control" value="{{ old('title') }}" />
				<span class="danger">{{ $errors->first('title') }}</span>
			</fieldset>
			
			<fieldset class="form-group">
				<label for="description">@lang('locale.scheduler.scheduleDescription')</label>
				<textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
				<span class="danger">{{ $errors->first('description') }}</span>
			</fieldset>

			<fieldset class="form-group">
				<label for="schedule">@lang('locale.scheduler.schedule')</label>
			<input type='datetime-local' name="schedule" class="form-control" value="{{ old('schedule') }}" />
				<span class="danger">{{ $errors->first('schedule') }}</span>
			</fieldset>

			<div class="text-right">
				<button class="btn btn-primary">@lang('locale.scheduler.save')</button>
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