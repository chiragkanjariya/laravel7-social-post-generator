@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.role.edit'))

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')

@endsection

@section('content')
  @if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">There were some problems with your input</h4>
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
        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Name:</strong>
              {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
          </div>
{{--          <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--              <strong>Permission:</strong>--}}
{{--              <br/>--}}
{{--              @foreach($permission as $value)--}}
{{--                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}--}}
{{--                  {{ $value->name }}</label>--}}
{{--                <br/>--}}
{{--              @endforeach--}}
{{--            </div>--}}
{{--          </div>--}}
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Permission:</strong>
              {!! Form::select('permission[]', $permission, $rolePermissions, array('class' => 'form-control select2','multiple')) !!}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{ trans('locale.role.save') }}</button>
          </div>
        </div>
        {!! Form::close() !!}
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
