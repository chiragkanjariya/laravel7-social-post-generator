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
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!',
		confirmButtonClass: 'btn btn-primary',
		cancelButtonClass: 'btn btn-danger ml-1',
		buttonsStyling: false,
	}).then(function (result) {
		if (result.value) {
			$('#deleteForm'+id).submit();
		}
	})
}