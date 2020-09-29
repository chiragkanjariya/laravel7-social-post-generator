@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.mypost.title'))

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection
@section('page-style')
  <style>
    .post-overlay {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      width: 100%;
      opacity: 0.5;
      transition: .7s ease;
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
					<img class="card-img-top img-fluid" id="post-img-{{ $post->id }}" src="/storage/{{ $post->post_image }}" width="100%" alt="Approved posts" />
					<div class="post-overlay" id="post-overlay-{{ $post->id }}" profile-color="{{ $post->profile->favour_color }}" is-overlay="{{ $post->isoverlay }}"></div>
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
      var image  = document.getElementById("post-img-" + postId);
      var canvas = document.createElement("canvas");
      // document.body.appendChild(canvas);
      canvas.width  = image.width;
      canvas.height = image.height;
      canvas.style.setProperty('margin-left', '500px');
      var context = canvas.getContext("2d");
      let color = $("#post-overlay-" + postId).attr("profile-color");
      let isoverlay = $("#post-overlay-" + postId).attr("is-overlay");
      context.drawImage(image, 0, 0, image.width, image.height);
      if (parseInt(isoverlay) == 1) {
        context.fillStyle = color;
        context.globalAlpha = 0.5;
        context.fillRect(0, 0, image.width, image.height)
      }

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
		$(document).ready(function () {
      $(".post-overlay").each(function () {
        let color = $(this).attr("profile-color")
        let isoverlay = $(this).attr("is-overlay")
        let height = $(this).parent().find('img')[0].clientHeight + 'px';
        if (parseInt(isoverlay) == 1)
        {
          $(this).css("background-color", color).css("height", height)
        }
      })
    })
  </script>
@endsection
