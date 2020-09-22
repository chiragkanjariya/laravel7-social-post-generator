(function($) {
  "use strict";

  // if it is not touch device
  if (!$.app.menu.is_touch_device()){
    // Chat user list
    if($('.chat-application .chat-user-list').length > 0){
      var chat_user_list = new PerfectScrollbar(".chat-user-list");
    }

    // Chat user profile
    if($('.chat-application .profile-sidebar-area .scroll-area').length > 0){
      var chat_user_list = new PerfectScrollbar(".profile-sidebar-area .scroll-area");
    }

    // Chat area
    if($('.user-chats').length > 0){
      var chat_user = new PerfectScrollbar(".user-chats", {
        wheelPropagation: false
      });
    }
  }

  // if it is a touch device
  else {
    $(".chat-user-list").css("overflow", "scroll");
    $(".profile-sidebar-area .scroll-area").css("overflow", "scroll");
    $(".user-chats").css("overflow", "scroll");
    $(".user-profile-sidebar-area").css("overflow", "scroll");
  }


  // Chat Profile sidebar toggle
  $('.chat-application .sidebar-profile-toggle').on('click',function(){
    $('.chat-profile-sidebar').addClass('show');
    $('.chat-overlay').addClass('show');
  });

  // Chat Profile sidebar toggle
  $('.chat-application .user-profile-toggle').on('click',function(){
    $('.chat-profile-sidebar').addClass('show');
    $('.chat-overlay').addClass('show');
  });

  // On Profile close click
  $(".chat-application .close-icon").on('click',function(){
    $('.chat-profile-sidebar').removeClass('show');
    if(!$(".sidebar-content").hasClass("show")){
      $('.chat-overlay').removeClass('show');
    }
  });

  // On sidebar close click
  $(".chat-application .sidebar-close-icon").on('click',function(){
    $('.sidebar-content').removeClass('show');
    $('.chat-overlay').removeClass('show');
  });

  // On overlay click
  $(".chat-application .chat-overlay").on('click',function(){
    $('.app-content .sidebar-content').removeClass('show');
    $('.chat-application .chat-overlay').removeClass('show');
    $('.chat-profile-sidebar').removeClass('show');
  });

  // Add class active on click of Chat users list
  $(".chat-application .chat-user-list ul li").on('click', function(){
    if($('.chat-user-list ul li').hasClass('active')){
      $('.chat-user-list ul li').removeClass('active');
    }
    $(this).addClass("active");
    if($('.chat-user-list ul li').hasClass('active')){
      $('.start-chat-area').addClass('d-none');
      $('.active-chat').removeClass('d-none');
    }
    else{
      $('.start-chat-area').removeClass('d-none');
      $('.active-chat').addClass('d-none');
    }
  });

  // autoscroll to bottom of Chat area
  var chatContainer = $(".user-chats");
  $(".chat-users-list-wrapper li").on("click", function () {
    let profile = JSON.parse($(this).attr('data-profile'));
    $('.profile-title').text(profile.user.name + " : " + profile.niche + " Profile")
    $('.avatar > p').css('background-color', profile.color)

    $('.chat-user-name').text(profile.user.name)
    $('#user-email').text(profile.user.email)
    $('#user-role').text(profile.role)
    if (profile.user.status == 'activated')
    {
      $('#user-status').removeClass('badge-warning').addClass('badge-success')
      $('#user-status').text("Activated")
    } else {
      $('#user-status').removeClass('badge-success').addClass('badge-warning')
      $('#user-status').text("Deactivated")
    }

    /////////////////////////////////////////////////////////////////////////////////////
    $(".card-post").html('')
    $.ajax({
      method: "POST",
      url: "post-get",
      data: {
        _token: $("#_token").val(),
        profile_id: profile.id
      },
      success: function (result) {
        for (let row in result)
        {
          let cards = '' +
            '<div class="col-lg-4 col-md-6 col-sm-12 mt-1 card-post-' + result[row].id + '">\n' +
            '  <div class="card" style="max-width: 300px; margin: auto">\n' +
            '    <div class="card-content">\n' +
            '      <img class="card-img-top img-fluid" src="/storage/' + result[row].post_image + '" width="150" height="150" alt="Card image cap" />\n' +
            '      <div class="card-body">\n' +
            '        <h4 class="card-title">' + result[row].post_title + '</h4>\n' +
            '        <p class="card-text text-left">' + result[row].post_content + '</p>\n' +
            '        <div class="card-btns d-flex justify-content-between pull-right mb-2">\n' +
            '          <a href="#" class="btn btn-sm btn-danger" onclick="delete_post(' + result[row].id + ')">Delete</a>\n' +
            '        </div>'
            '      </div>\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>'
          $(".card-post").append(cards)
        }
      },
      error: function (result) {
      }
    })
    chatContainer.animate({ scrollTop: 0 }, 400)
    // chatContainer.animate({ scrollTop: chatContainer[0].scrollHeight }, 400)
  });

  // Chat sidebar toggle
  if ($(window).width() < 992) {
    $('.chat-application .sidebar-toggle').on('click',function(){
      $('.app-content .sidebar-content').addClass('show');
      $('.chat-application .chat-overlay').addClass('show');
    });
  }

  // For chat sidebar on small screen
  if ($(window).width() > 992) {
    if($('.chat-application .chat-overlay').hasClass('show')){
      $('.chat-application .chat-overlay').removeClass('show');
    }
  }

  // Scroll Chat area
  $(".user-chats").scrollTop($(".user-chats > .chats").height());

  // Filter
  $(".chat-application #chat-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    if(value!=""){
      $(".chat-user-list .chat-users-list-wrapper li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    }
    else{
      // If filter box is empty
      $(".chat-user-list .chat-users-list-wrapper li").show();
    }
  });

  //create-post modal validation
  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

  $('#create-image-upload').change(function(){
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
    {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#create-post-image').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
      $('#create-image-status').val('true');
      $('#create_upload_new').css('display', 'none');
      $('#create_upload_remove').css('display', '');
    }
    else
    {
      $('#create_upload_new').css('display', '');
      $('#create_upload_remove').css('display', 'none');
      $('#create-post-image').attr('src', '/images/pages/default-post.png');
    }
  });
  $('#create_upload_remove').click(function(){
    $('#create-image-upload').val('');
    $('#create_upload_new').css('display', '');
    $('#create_upload_remove').css('display', 'none');
    $('#create-post-image').attr('src', '/images/pages/default-post.png');
  });

  $('#create-post-form').submit(function (e) {
    e.preventDefault();
    let profile = JSON.parse($($(".chat-users-list-wrapper li.active")[0]).attr('data-profile'));
    console.log(profile);
    let formData = new FormData()
    formData.append('_token', $("#_token").val())
    formData.append('title', $('#create-modal-title').val())
    formData.append('content', $('#create-modal-content').val())
    formData.append('profile_id', profile.id)
    let image = document.querySelector('#create-image-upload').files[0]
    formData.append('image', image)
    if (!image)
    {
      alert('The image should be uploaded.')
      return false;
    }
    $.ajax({
      url         : '/post-save',
      data        : formData,
      cache       : false,
      contentType : false,
      processData : false,
      type        : 'POST',
      success     : function(data, textStatus, jqXHR){
        let cards = '' +
          '<div class="col-lg-4 col-md-6 col-sm-12 mt-1 card-post-' + data.id + '">\n' +
          '  <div class="card" style="max-width: 300px; margin: auto">\n' +
          '    <div class="card-content">\n' +
          '      <img class="card-img-top img-fluid" src="/storage/' + data.post_image + '" width="150" height="150" alt="Card image cap" />\n' +
          '      <div class="card-body">\n' +
          '        <h4 class="card-title">' + data.post_title + '</h4>\n' +
          '        <p class="card-text text-left">' + data.post_content + '</p>\n' +
          '        <div class="card-btns d-flex justify-content-between pull-right mb-2">\n' +
          '          <a href="#" class="btn btn-sm btn-danger" onclick="delete_post( + data.id + \')" >Delete</a>\n' +
          '        </div>'
        '      </div>\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>'
        $(".card-post").append(cards)
        $('#create-post').modal('hide');
      }
    })
  })
})(jQuery);

$(window).on("resize", function() {
  // remove show classes from sidebar and overlay if size is > 992
  if ($(window).width() > 992) {
    if($('.chat-application .chat-overlay').hasClass('show')){
      $('.app-content .sidebar-left').removeClass('show');
      $('.chat-application .chat-overlay').removeClass('show');
    }
  }

  // Chat sidebar toggle
  if ($(window).width() < 992) {
    if($('.chat-application .chat-profile-sidebar').hasClass('show')){
      $('.chat-profile-sidebar').removeClass('show');
    }
    $('.chat-application .sidebar-toggle').on('click',function(){
      $('.app-content .sidebar-content').addClass('show');
      $('.chat-application .chat-overlay').addClass('show');
    });
  }

});

// Add message to chat
function create() {
  $('#create-image-upload').val('');
  $('#create_upload_new').css('display', '');
  $('#create_upload_remove').css('display', 'none');
  $('#create-post-image').attr('src', '/images/pages/default-post.png');
  $('#create-modal-title').val('');
  $('#create-modal-content').val('');
  $('#create-post').modal({
    'backdrop': 'static'
  });
}

function delete_post(id) {
  if (!confirm("Are you really?")) return;
  $.ajax({
    method: "POST",
    url: "post-delete",
    data: {
      _token: $("#_token").val(),
      id: id
    },
    success: function (result) {
      $('.card-post-'+id).remove();
    },
    error: function (result) {
    }
  })
}
