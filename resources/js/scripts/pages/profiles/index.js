$(document).ready(function() {
	$('#profileTable').DataTable({
		scrollCollapse: true,
		bInfo: false,
		language: {
			paginate: {
				previous: "<i class='mdi mdi-chevron-left'>",
				next: "<i class='mdi mdi-chevron-right'>"
			}
		},
		drawCallback: function() {
			$(".dataTables_paginate > .pagination").addClass("pagination-rounded");
			$('.dataTables_scrollBody').css('min-height', '400px');
		}
	});
 });

 function deleteProfile(id) {
	Swal.fire({
		title: "@lang('locale.swal.delConfirm.title')",
		text: "@lang('locale.swal.delConfirm.text')",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: "@lang('locale.swal.delConfirm.yes')",
		confirmButtonClass: 'btn btn-primary',
		cancelButtonClass: 'btn btn-danger ml-1',
		buttonsStyling: false,
	}).then(function (result) {
		if (result.value) {
			$('#deleteForm'+id).submit();
		}
	})
}