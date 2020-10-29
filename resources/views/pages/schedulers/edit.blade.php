@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.scheduler.edit'))

@section('vendor-style')
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

	{{-- datetime picker --}}
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/jquery.datetimepicker.css')) }}">
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
		<form action="{{ route('schedulers.update', $scheduler) }}" method="POST">
			@csrf
			@method('PUT')
			<fieldset class="form-group">
				<label for="title">@lang('locale.scheduler.scheduleTitle')</label>
				<input name="title" class="form-control" value="{{ $scheduler->title }}" />
				<span class="danger">{{ $errors->first('title') }}</span>
			</fieldset>
			
			<fieldset class="form-group">
				<label for="description">@lang('locale.scheduler.scheduleDescription')</label>
				<textarea name="description" class="form-control" rows="5">{{ $scheduler->description }}</textarea>
				<span class="danger">{{ $errors->first('description') }}</span>
			</fieldset>

			<fieldset class="form-group">
				<label for="schedule">@lang('locale.scheduler.schedule')</label>
				<input type="text" id="schedule-time" name="schedule" class="form-control" value="{{ $scheduler->schedule }}" />
				<span class="danger">{{ $errors->first('schedule') }}</span>
			</fieldset>

			<div class="text-right">
				<button class="btn btn-primary">@lang('locale.scheduler.update')</button>
			</div>
		</form>
	</div>
	</div>
  </div>

@endsection

@section('vendor-script')
	<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/tag/bootstrap-tagsinput.min.js')) }}"></script>
	
	{{-- datetime picker --}}
	<script src="{{ asset(mix('vendors/js/php-date-formatter.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/jquery.mousewheel.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/jquery.datetimepicker.js')) }}"></script>
@endsection

@section('page-script')
	<script>
		$('#schedule-time').datetimepicker({
			format: 'Y-m-d H:i:s'
		});
	</script>
@endsection