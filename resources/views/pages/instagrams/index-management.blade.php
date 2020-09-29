@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.instagram.title'))

@section('vendor-style')
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
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
								<th>@lang('locale.Username')</th>
								<th>@lang('locale.Email')</th>
								<th>@lang('locale.instagram.title')</th>
								<th>@lang('locale.instagram.followers')</th>
								<th>@lang('locale.instagram.bestHashtags')</th>
								<th>@lang('locale.instagram.posts')</th>
								<th>@lang('locale.instagram.advices')</th>
								<th>@lang('locale.UpdatedAt')</th>
								<th>@lang('locale.Actions')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($profiles as $key => $profile)
							<tr>
								<td>{{ $profile->id }}</td>
								<td>{{ $profile->user->name }}</td>
								<td>{{ $profile->user->email }}</td>
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
								<td>
									<form id="deleteForm{{ $profile->id }}" action="{{ route('instagrams.destroy', $profile->id) }}" method="POST" style="display: none;">
										@csrf
										@method('DELETE')
									</form>
									<a href="{{ route('instagrams.edit', $profile->id) }}" class="btn btn-icon rounded-circle btn-flat-success waves-effect waves-light">
										<i class="feather icon-edit"></i>
									</a>
									<a href="javascript:deleteInstagram({{ $profile->id }})" class="btn btn-icon rounded-circle btn-flat-danger waves-effect waves-light">
										<i class="feather icon-trash-2"></i>
									</a>
								</td>
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
	<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
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
	 
		function deleteInstagram(id) {
			Swal.fire({
				title: "{{ trans('locale.swal.delConfirm.title') }}",
				text: "{{ trans('locale.swal.delConfirm.text') }}",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!',
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-danger ml-1',
				buttonsStyling: false,
			}).then(function (result) {
				if (result.value) {
					$('#deleteForm'+id).submit();
				}
			})
		}
  	</script>
@endsection
