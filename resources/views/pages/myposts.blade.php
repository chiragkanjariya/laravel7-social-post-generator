@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.mypost.title'))

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">

  {{-- datetime picker --}}
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/jquery.datetimepicker.css')) }}">
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
		@foreach($posts as $key => $post)
		<div class="col-lg-4 col-md-6 col-sm-12 mt-1">
			<div class="card">
				<div class="card-content">
          <div class="btn-group dropdown mb-1" style="position: absolute; right: 2px; top: 5px; z-index: 1;">
            <a class="btn btn-sm btn-success" href="javascript:download({{ $post->id }})">@lang('locale.mypost.download')</a>
            <a class="btn btn-sm btn-danger" href="javascript:copy({{ $post->id }})">@lang('locale.mypost.clipboard')</a>
            @if (\Carbon\Carbon::parse($post->schedule->schedule ?? '0000-00-00 00:00')->format('Y-m-d H:i') < \Carbon\Carbon::now()->format('Y-m-d H:i'))
              <button class="btn btn-sm btn-primary" onclick="addSchedule({{ $post }});">@lang('locale.mypost.add')</button>
            @else
              <button class="btn btn-sm btn-info" onclick="updateSchedule({{ $post }});">@lang('locale.mypost.update')</button>
            @endif
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
  
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="schedule" aria-hidden="true">
    <form id="schedule-form" action="">
      @csrf
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-title">@lang('locale.mypost.add')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <div class="controls">
                      <label for="schedule-title">{{ trans('locale.scheduler.scheduleTitle') }}</label>
                      <input type="text" id="schedule-title" name="title" class="form-control" placeholder="" required >
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="controls">
                      <label for="schedule-description">{{ trans('locale.scheduler.scheduleDescription') }}</label>
                      <textarea class="form-control" id="schedule-description" name="description" rows="5" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="controls">
                      <label for="schedule" id="timezone"></label>
                      <input type="text" id="schedule-time" name="schedule" class="form-control" required/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('locale.save')</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset('reimg.js') }}"></script>

  {{-- datetime picker --}}
	<script src="{{ asset(mix('vendors/js/php-date-formatter.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/jquery.mousewheel.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/jquery.datetimepicker.js')) }}"></script>
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
    function addSchedule(post) {
      $('#modal-title').text('{{ trans('locale.mypost.add') }}');
      $('#schedule-form').attr('method', 'POST');
      $('#schedule-form').attr('action', '/schedulers/'+ post['id'] +'/create');
      $('#schedule-title').val('');
      $('#schedule-description').val('');
      $('#schedule-time').val('');
      $('#timezone').text('{{ trans('locale.scheduler.schedule') }} : ' + '{!! auth()->user()->timezone !!}');
      $('#modal').modal({
        'backdrop': 'static'
      });
    }
    function updateSchedule(post) {
      $('#modal-title').text('{{ trans('locale.mypost.update') }}');
      $('#schedule-form').attr('method', 'POST');
      $('#schedule-form').attr('action', '/schedulers/'+ post['id'] +'/create');
      $('#schedule-title').val(post['schedule']['title']);
      $('#schedule-description').val(post['schedule']['description']);
      $('#schedule-time').val(post['schedule']['schedule']);
      $('#timezone').text('{{ trans('locale.scheduler.schedule') }} : ' + '{!! auth()->user()->timezone !!}');
      $('#modal').modal({
        'backdrop': 'static'
      });
    }

    $('#schedule-time').datetimepicker({
			format: 'Y-m-d H:i:s'
		});
  </script>
@endsection
