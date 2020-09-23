(function(window, document, $) {
  'use strict';

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
            // '          <a href="#" class="btn btn-sm btn-danger" onclick="delete_post(' + result[row].id + ')">Delete</a>\n' +
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

})(window, document, jQuery);
