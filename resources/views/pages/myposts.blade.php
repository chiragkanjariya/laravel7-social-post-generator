@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.mypost.title'))

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
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
	<div class="row">
		@foreach($posts as $key => $post)
		<div class="col-lg-3 col-md-6 col-sm-12 mt-1">
			<div class="card">
				<div class="card-content">
          <div class="btn-group dropdown mb-1" style="position: absolute; right: 2px; top: 5px; z-index: 1;">
            <button type="button" class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Action
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:download({{ $post->id }})">Download Image</a>
              <a class="dropdown-item" href="javascript:copy({{ $post->id }})">Copy to clipboard</a>
            </div>
          </div>
          <canvas id="canvas-{{ $post->id }}" class="card-img-top img-fluid canvas-image" width="100%" post-id="{{ $post->id }}" img-path="/storage/{{ $post->post_image }}" is-overlay="{{ $post->isoverlay }}" profile-color="{{ $post->profile->favour_color }}" alt="Approved posts"></canvas>
					<div class="card-body">
						<h4 class="card-title">{{ $post->post_title }}</h4>
						<p class="card-text text-left" id="post-content-{{ $post->id }}">{{ $post->post_content }}</p>
						<div class="card-btns d-flex justify-content-between pull-right mb-2">
							<form id="deleteForm{{ $post->id }}" action="{{ route('myposts.destroy', $post->id) }}" method="POST" style="display: none;">
								@csrf
								@method('DELETE')
							</form>
							<button class="btn btn-sm btn-danger" onclick="deletePost({{ $post->id }})">{{ trans("locale.delete") }}</button>
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
  <script src="{{ asset('reimg.js') }}"></script>
@endsection
@section('page-script')
  <script>
    $( ".canvas-image" ).each(function( index ) {
      var postId = $(this).attr('post-id');
      var canvas = document.getElementById('canvas-'+postId);
      var context = canvas.getContext("2d");
      var color = $(this).attr("profile-color");
      var isoverlay = $(this).attr("is-overlay");

      const img = new Image()
      img.src = $(this).attr('img-path')
      img.onload = () => {
        canvas.width  = img.width;
        canvas.height = img.height;
        context.drawImage(img, 0, 0)

        if (parseInt(isoverlay) == 1) {
          context.fillStyle = color;
          context.globalAlpha = 0.5;
          context.fillRect(0, 0, canvas.width, canvas.height)
        }
      }
    });

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
		function download(postId) {
      var canvas  = document.getElementById("canvas-" + postId);

      ReImg.fromCanvas(canvas).downloadPng();
    }
		function copy(postId) {
      var text  = $("#post-content-" + postId).text();
      const el = document.createElement('textarea');
      el.value = text;
      el.setAttribute('readonly', '');
      el.style.position = 'absolute';
      el.style.left = '-9999px';
      document.body.appendChild(el);
      el.select();
      document.execCommand('copy');
      document.body.removeChild(el);
      toastr.info('The content copied to clipboard', 'Notification'
        , { "progressBar": true, "closeButton": true, timeOut: 2000 }
      );
    }
  </script>
@endsection
