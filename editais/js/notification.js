$(function() {

	$("#notifications-table").on("click", ".link-modal", function() {
		
	    var title = $(this).data('title');
	    var id = $(this).data('id');
	    
		$.getJSON("getNotificationByID.php?id=" + id, (data) => {
			
			window.parent.$(".modal-title").html(title);
			window.parent.$("#p-data").html(data.date);
			window.parent.$("#p-notified").html( data.notified);
			window.parent.$("#b-crm").html(("000000" + data.crm).slice(-6));
			window.parent.$("#p-notification").html(data.notification);
			
		    window.parent.$('#modalNotification').modal('show');
		});
	    
	});
	
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

});