@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.instagram.title'))

@section('vendor-style')
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
@endsection
@section('page-style')

@endsection

@section('content')
	@if (session()->get('message'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
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
				<div class="table-responsive">
					<table id="dataTable" class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>@lang('locale.instagram.title')</th>
								<th>@lang('locale.instagram.followers')</th>
								<th>@lang('locale.instagram.bestHashtags')</th>
								<th>@lang('locale.instagram.posts')</th>
								<th>@lang('locale.instagram.advices')</th>
								<th>@lang('locale.UpdatedAt')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($profiles as $key => $profile)
							<tr>
								<td>{{ $profile->id }}</td>
								<td>
									<a href="{{ $profile->instagram }}" target="_blank">{{ $profile->instagram }}</a>
								</td>
								<td>{{ $profile->analysistInstagram->followers ?? '' }}</td>
								<td>
									@php
									$hashtags = explode(',', $profile->analysistInstagram->best_hashtags ?? '');
									@endphp
									@foreach ($hashtags as $hashtag)
									<span class="badge badge-pill badge-md badge-glow badge-primary">{{ $hashtag }}</span>
									@endforeach
								</td>
								<td>{{ $profile->analysistInstagram->posts ?? '' }}</td>
								<td>{{ $profile->analysistInstagram->advices ?? '' }}</td>
								<td>{{ $profile->analysistInstagram->updated_at ?? '' }}</td>
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
  	<script>
		$('#dataTable').DataTable({
			scrollCollapse: true,
			bInfo: false,
			language: {
			paginate: {
				previous: "<i class='mdi mdi-chevron-left'>",
				next: "<i class='mdi mdi-chevron-right'>"
			}
			},
			drawCallback: function() {
			$(".dataTables_paginate > .pagination").addClass("pagination-rounded");
			$('.dataTables_scrollBody').css('min-height', '400px');
			}
		});
  	</script>
@endsection
