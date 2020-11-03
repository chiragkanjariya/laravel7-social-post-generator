@extends('layouts/contentLayoutMaster')

@section('title', 'Show user')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')

@endsection

@section('content')
  @if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
      @foreach ($errors->all() as $error)
        <i class="feather icon-info ml-2 align-middle"></i>
        <span class="mb-0 text-white-50">
          {{ $error }}
        </span>
        <p></p>
      @endforeach
    </div>
  @endif

  <div class="card">
    <div class="card-content">
      <div class="card-body card-dashboard">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>@lang('locale.user.field.name'):</strong>
              {{ $user->name }}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>@lang('locale.user.field.email'):</strong>
              {{ $user->email }}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>@lang('locale.user.field.role'):</strong>
              @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                  <label class="badge badge-success">{{ $v }}</label>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/scrap-image.js')) }}"></script>
@endsection
