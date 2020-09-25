@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.post-view.title'))

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
  <style>
    .overlay {
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
@section('page-style')
@endsection

@include('pages/post-manage-sidebar')
@section('content')
  <input type="hidden" id="_token" value="{{ @csrf_token() }}">
  <section class="bootstrap-select">
    <div class="card">
      <div class="card-header">
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-12">
              <div class="form-group">
                <select class="select2 form-control" id="profile">
                  @php $index = 0;  @endphp
                  @foreach($profiles as $profile)
                    <option value="{{ $profile->id }}" {{ ++$index == 1 ? "selected" : "" }}
                        profile-color="{{ $profile->favour_color }}"
                        profile-hashtag="{{ $profile->hashtag }}">{{ $profile->niche->name }} Profile</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row card-post">

    </div>
  </section>
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/post-view.js')) }}"></script>
@endsection
