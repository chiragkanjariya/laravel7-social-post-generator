@extends('layouts/contentLayoutMaster')

@section('title', trans('locale.role.title'))

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
@endsection
@section('page-style')

@endsection

@section('content')
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
  @endif
  <section id="horizontal-vertical">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pull-right">
            <a class="btn btn-success" href="{{ route('roles.create') }}">{{ trans('locale.role.create') }}</a>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <div class="table-responsive">
                <table class="table nowrap scroll-horizontal-vertical" width="100%">
                  <thead>
                  <tr>
                    <th width="20%">No</th>
                    <th width="30%">Name</th>
                    <th width="30%">Permission</th>
                    <th width="20%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($roles as $key => $role)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                        @foreach($role->permissions()->pluck('name') as $permission)
                          <span class="badge badge-success">{{ $permission }}</span>
                        @endforeach
                      </td>
                      <td>
                        @can('Admin')
                          <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">{{ trans('locale.role.edit') }}</a>
                          {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                          {!! Form::submit(trans('locale.role.delete'), ['class' => 'btn btn-danger btn-sm']) !!}
                          {!! Form::close() !!}
                        @endcan
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/roles/index.js')) }}"></script>
@endsection
