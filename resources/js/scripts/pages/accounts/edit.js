(function($) {
	"use strict";

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
		}
		else
		{
		  $('#create-post-image').attr('src', '/images/avatar.png');
		}
	});

	$('#create_upload_remove').click(function(){
		$('#create-image-upload').val('');
		$('#create-post-image').attr('src', '/images/avatar.png');
	 });
})(jQuery);