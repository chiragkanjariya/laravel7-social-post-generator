@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.profile.title'))

@section('vendor-style')
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
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
		<div class="card-header">
			<a href="{{ route('profiles.create') }}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-plus"></i> @lang('locale.profile.create')</a>
		</div>
		<div class="card-content">
			<div class="card-body">
				<div class="table-responsive">
					<table id="profileTable" class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>@lang('locale.profile.niche')</th>
								<th>@lang('locale.profile.hashtag')</th>
								<th>@lang('locale.profile.favourColor')</th>
								<th>@lang('locale.CreatedAt')</th>
								<th>@lang('locale.UpdatedAt')</th>
								<th>@lang('locale.Actions')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($profiles as $key => $profile)
							<tr>
								<td>{{ $key }}</td>
								<td>{{ $profile->niche }}</td>
								<td>{{ $profile->hashtag }}</td>
								<td>{{ $profile->favour_color }}</td>
								<td>{{ $profile->created_at }}</td>
								<td>{{ $profile->updated_at }}</td>
								<td></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('vendor-script')
	<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/profiles/index.js')) }}"></script>
@endsection
