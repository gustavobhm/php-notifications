$(function() {

	$.fn.dataTable.moment('DD/MM/YYYY');

	var table = $('#notifications-table')
			.on('order.dt', function() {})
			.on('search.dt', function() {})
			.on('page.dt', function() {})
			.DataTable(
					{
						"lengthMenu" : [ [ 10, 25, 50, 100, -1 ],
								[ 10, 25, 50, 100, "Todos" ] ],
						"pageLength" : 25,
						"order" : [ [ 0, "desc" ] ],
						"initComplete" : function() {
							setIframeHeight("iframe-notificacoes");
						},
						"language" : {
							"search" : "Procurar:",
							"decimal" : "",
							"emptyTable" : "Sem dados disponíveis na tabela",
							"info" : "Mostrando itens do _START_ ao _END_ de _TOTAL_",
							"infoEmpty" : "Mostrando itens do 0 ao 0 de 0",
							"infoFiltered" : "(Filtrado de _MAX_ registros no total)",
							"infoPostFix" : "",
							"thousands" : ",",
							"lengthMenu" : "Mostrar _MENU_ registros",
							"loadingRecords" : "Carregando...",
							"processing" : "Processando...",
							"search" : "Procurar:",
							"zeroRecords" : "Registro não encontrado",
							"paginate" : {
								"first" : "Primeiro",
								"last" : "Último",
								"next" : "Próximo",
								"previous" : "Anterior"
							}
						},
						// Fixing filter and length aligment from datatable
						"dom" : "<'row'<'col-sm-6 col-md-6'f><'col-sm-6 col-md-6'l>>"
								+ "<'row'<'col-sm-12'tr>>"
								+ "<'row'<'col-sm-6 col-md-6'i><'col-sm-6 col-md-6'p>>",
					});

	table.on('draw.dt', function() {
		setIframeHeight("iframe-notificacoes");
	});

	// Centralizes the sort icon table
	table.columns().iterator('column', function(ctx, idx) {
		$(table.column(idx).header()).append('<span class="sort-icon"/>');
	});

	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

});
