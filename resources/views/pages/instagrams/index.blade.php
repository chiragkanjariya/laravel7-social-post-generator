@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.instagram.title'))

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

	@foreach($profiles as $key => $profile)
	<a href="{{ $profile->instagram }}" target="_blank">{{ $profile->instagram }}</a>
	<div class="row">
		<div class="col-lg-2 col-md-6 col-12">
			<div class="card">
				 <div class="card-header d-flex flex-column align-items-start">
					  <div class="avatar bg-rgba-primary p-50 m-0">
							<div class="avatar-content">
								 <i class="feather icon-users text-primary font-medium-5"></i>
							</div>
					  </div>
					  <h2 class="text-bold-700 mt-1 mb-25">{{ $profile->analysistInstagram->followers ?? 0 }}</h2>
					  <p>{{ trans('locale.instagram.followers') }}</p>
				 </div>
			</div>
		</div>
	
		<div class="col-lg-2 col-md-6 col-12">
			<div class="card">
				 <div class="card-header d-flex flex-column align-items-start">
					  <div class="avatar bg-rgba-primary p-50 m-0">
							<div class="avatar-content">
								<i class="feather icon-octagon text-primary font-medium-5"></i>
							</div>
					  </div>
					  <h2 class="text-bold-700 mt-1 mb-25">{{ $profile->analysistInstagram->posts ?? 0 }}</h2>
					  <p>{{ trans('locale.instagram.posts') }}</p>
				 </div>
			</div>
		</div>

		<div class="col-lg-3 col-md-6 col-12">
			<div class="card">
				<div class="card-header d-flex flex-column align-items-start">
					<div class="avatar bg-rgba-primary p-50 m-0">
						<div class="avatar-content">
							<i class="feather icon-award text-primary font-medium-5"></i>
						</div>
					</div>
					@php
						$hashtags = explode(',', $profile->analysistInstagram->best_hashtags ?? '');
					@endphp
					<div class="row text-bold-700 mt-1 mb-25">
					@foreach ($hashtags as $hashtag)
						<span class="text-bold-700 mt-1 ml-1 mb-0 badge badge-sm badge-primary">{{ $hashtag ?? '' }}</span>
					@endforeach
					</div>
					<p>{{ trans('locale.instagram.bestHashtags') }}</p>
				</div>
			</div>
		</div>

		<div class="col-lg-5 col-md-6 col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">{{ trans('locale.instagram.advices') }}</h4>
				</div>
				<div class="card-content">
					<div class="card-body">
						{!! $profile->analysistInstagram->advices ?? '' !!}
				 	</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@endsection
