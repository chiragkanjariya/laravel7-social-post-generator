@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.scheduler.title'))

@section('vendor-style')
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
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
			{{-- <a href="{{ route('schedulers.create') }}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-plus"></i> @lang('locale.scheduler.create')</a> --}}
		</div>
		<div class="card-content">
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>@lang('locale.scheduler.post')</th>
								<th>@lang('locale.scheduler.scheduleTitle')</th>
								<th>@lang('locale.scheduler.scheduleDescription')</th>
								<th>@lang('locale.scheduler.schedule')</th>
								<th>@lang('locale.CreatedAt')</th>
								<th>@lang('locale.UpdatedAt')</th>
								<th>@lang('locale.Actions')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($schedulers as $key => $one)
							<tr>
								<td>{{ $one->id }}</td>
								<td>
									<img src="/storage/{{ $one->post->post_image }}" alt="Post Image" height="70px">
									{{ $one->post->post_title }}
								</td>
								<td>{{ $one->title }}</td>
								<td>{{ $one->description }}</td>
								<td>{{ $one->schedule }}</td>
								<td>{{ $one->created_at }}</td>
								<td>{{ $one->updated_at }}</td>
								<td>
									<form id="deleteForm{{ $one->id }}" action="{{ route('schedulers.destroy', $one) }}" method="POST" style="display: none;">
										@csrf
										@method('DELETE')
									</form>
									<a href="{{ route('schedulers.edit', $one) }}" class="btn btn-icon rounded-circle btn-flat-success waves-effect waves-light">
										<i class="feather icon-edit"></i>
									</a>
									 <a href="javascript:deleteData({{ $one->id }})" class="btn btn-icon rounded-circle btn-flat-danger waves-effect waves-light">
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

    function deleteData(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
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
