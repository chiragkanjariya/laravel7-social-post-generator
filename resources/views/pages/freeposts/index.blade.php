@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.freepost.title'))

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
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
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-primary" href="{{ route('freeposts.create') }}">{{ trans('locale.freepost.create') }}</a>
    </div>
  </div>
	<div class="row">
		@foreach($freeposts as $key => $freepost)
		<div class="col-lg-3 col-md-6 col-sm-12 mt-1">
			<div class="card">
				<div class="card-content">
					<img class="card-img-top img-fluid" src="/storage/{{ $freepost->image }}" width="100%" alt="Approved posts" />
					<div class="overlay"></div>
					<div class="card-body">
						<h4 class="card-title">{{ $freepost->title }}</h4>
						<p class="card-text text-left">{{ $freepost->content }}</p>
						<div class="card-btns d-flex justify-content-between pull-right mb-2">
							<form id="deleteForm{{ $freepost->id }}" action="{{ route('freeposts.destroy', $freepost->id) }}" method="POST" style="display: none;">
								@csrf
								@method('DELETE')
							</form>
							<button class="btn btn-sm btn-danger" onclick="deletePost({{ $freepost->id }})">{{ trans("locale.delete") }}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection
@section('page-script')
  <script>
		function deletePost(postId) {
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
					$('#deleteForm' + postId).submit();
				}
			 })
		}
  </script>
@endsection
