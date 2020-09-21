@extends('layouts/contentLayoutMaster')

@section('title', 'Scrapping Image')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')

@endsection

@section('content')
  <input type="hidden" id="_token" value="{{ @csrf_token() }}">
  <section class="bootstrap-select">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Bootstrap Select</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-12">
              <div class="form-group">
                <select class="select2 form-control" id="hashtag" multiple="multiple">
                  <option value="laravel" selected>Laravel</option>
                  <option value="codeigniter">CodeIgniter</option>
                  <option value="rubyonrails">Ruby on Rails</option>
                  <option value="django" selected>Django</option>
                  <option value="reactjs">ReactJs</option>
                  <option value="vuejs">VueJs</option>
                  <option value="angularjs">AngularJs</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-12">
              <button type="button" id="search" class="btn bg-gradient-primary mr-1 mb-1" style="height: 44px;">
                Search
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row card-image">
    </div>
  </section>
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/pages/scrap-image.js')) }}"></script>
@endsection
