$(function() {

	$('#datepicker').datetimepicker({
		format : 'DD/MM/YYYY'
	});
	
	$('#datepicker').keydown(function (event) {
	    event.preventDefault();
	})

});