$(function() {

	var table = $('#notifications-table')
			.DataTable(
					{
						"lengthMenu" : [ [ 1, 5, 10, 25, 50, -1 ],
								[ 1, 5, 10, 25, 50, "All" ] ],
						"pageLength": 5,
						"columnDefs" : [ {
							"targets" : 2,
							"orderable" : false
						} ],
						"order": [[ 0, "desc" ]],
						//"aaSorting": [],
						// Fixing filter and length aligment from datatable
						"dom" : "<'row'<'col-sm-6 col-md-6'f><'col-sm-6 col-md-6'l>>"
								+ "<'row'<'col-sm-12'tr>>"
								+ "<'row'<'col-sm-6 col-md-6'i><'col-sm-6 col-md-6'p>>",
					});

	// Centralizes the sort icon table
	table.columns().iterator('column', function(ctx, idx) {
		$(table.column(idx).header()).append('<span class="sort-icon"/>');
	});

	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

});