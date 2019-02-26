function notifySuccess(message, placementFrom, placementAlign) {
	$.notify({
		icon : 'fa fa-check',
		message : message
	}, {
		type : 'success',
		delay : 2000,
		z_index : 2000,
		placement : {
			from : "top",
			align : "center"
		},
	});
}

function notifyWarning(message, placementFrom, placementAlign) {
	$.notify({
		icon : 'fa fa-exclamation',
		message : message
	}, {
		type : 'warning',
		delay : 2000,
		z_index : 2000,
		placement : {
			from : "top",
			align : "center"
		},
	});
}

function notify(message) {
	$.notify({
		icon : 'fa fa-check',
		message : message
	}, {
		type : 'success',
		delay : 1000,
	});
}
