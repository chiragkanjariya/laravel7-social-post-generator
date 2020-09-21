(function(window, document, $) {
  'use strict';

  $(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
  })

  $("#search").click(function () {
    $("#search").html('');
    $("#search").prop("disabled", true);
    $("#hashtag").prop("disabled", true);
    $("#search").html('<span class="spinner-border text-white" role="status" aria-hidden="true" style="position: absolute; top: 10px; left: 15px;"></span>');
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
          $("#search").html('Search');
          $("#search").removeAttr("disabled");
          $("#hashtag").removeAttr("disabled");
        }
      },
      error: function (result) {
        console.error(result);
      }
    });
  })

})(window, document, jQuery);
