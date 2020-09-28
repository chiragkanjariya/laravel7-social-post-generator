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
  <script>
    $(".select2").select2({
      dropdownAutoWidth: true,
      width: '100%'
    }).change(function () {
      let profile_id = $(this).val();
      let profile_hashtag = $(this).children("option:selected").attr("profile-hashtag");
      let profile_color = $(this).children("option:selected").attr("profile-color");
      $(".card-post").html('')
      $.ajax({
        method: "POST",
        url: "post-get",
        data: {
          _token: $("#_token").val(),
          profile_id: profile_id
        },
        success: function (result) {
          for (let row in result)
          {
            let cards =
              '<div class="col-lg-4 col-md-6 col-sm-12 mt-1 card-post-' + result[row].id + '">\n' +
              '  <div class="card" style="max-width: 300px; margin: auto">\n' +
              '    <div class="card-content">\n' +
              '      <img class="card-img-top img-fluid" src="/storage/' + result[row].post_image + '" width="150" height="150" alt="Card image cap" />\n' +
              '      <div class="overlay"></div>\n' +
              '      <div class="card-body">\n' +
              '        <h4 class="card-title">' + result[row].post_title + '</h4>\n' +
              '        <p class="card-text text-left">' + result[row].post_content + '</p>\n' +
              '        <div class="card-btns d-flex justify-content-between pull-right mb-2">\n' +
              '          <a href="#" class="btn btn-sm btn-danger" onclick="approvePost(' + result[row].id + ')">{{ trans("locale.approve") }}</a>\n' +
              '        </div>\n' +
              '      </div>\n' +
              '    </div>\n' +
              '  </div>\n' +
              '</div>'
            $(".card-post").append(cards)
            if (parseInt(result[row].isoverlay) == 1) {
              setTimeout(function () {
                let card_post = $('.card-post-' + result[row].id);
                card_post.find('.overlay').css('height', card_post.find('img')[0].clientHeight + 'px').css('background-color', profile_color);
              }, 10)
            } else {
              $('.card-post-' + result[row].id).find('.overlay').css('height', '0px');
            }
          }
        },
        error: function (result) {
        }
      })
    })
    $('.select2').trigger('change');

    function approvePost(postId) {
      $.ajax({
        method: "POST",
        url: "post-approve",
        data: {
          _token: $("#_token").val(),
          post_id: postId
        },
        success: function (data, textStatus, jqXHR) {
          if (jqXHR.status === 204) {
            toastr.success(
              'New post is approved successfully.',
              'Congratulation',
              {
                "progressBar": true,
                "closeButton": true,
                timeOut: 2000
              }
            );

            $('.select2').trigger('change');
          }
        }
      });
    }
  </script>
@endsection
