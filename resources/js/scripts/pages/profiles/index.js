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
		},
		"order": [[ 1, "asc" ]]
	});
 });