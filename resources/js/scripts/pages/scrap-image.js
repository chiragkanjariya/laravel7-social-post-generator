(function(window, document, $) {
  'use strict';

  $(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
  })

  $("#search").click(function () {
    $('.card-image').html('');
    $.ajax({
      method: "POST",
      url: "scrap-image",
      data: {
        _token: $("#_token").val(),
        hashtag: $("#hashtag").val()
      },
      success: function (result) {
        for (let row in result)
        {
          let cards =
            '<div class="col-lg-4 col-md-6 col-sm-12">\n' +
            '  <div class="card text-white text-center">\n' +
            '    <div class="card-content">\n' +
            '      <div class="card-body">\n' +
            '        <img src=" ' + result[row] + '" alt="element 02" width="150"\n' +
            '          height="150" class="mb-1">\n' +
            '      </div>\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>'
          $(".card-image").append(cards);
        }
      },
      error: function (result) {
        console.error(result);
      }
    });
  })

})(window, document, jQuery);
