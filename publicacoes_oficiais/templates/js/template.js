$(function() {
	$("#btnHome").click(
			function() {
				var url = window.location.protocol + "//"
						+ window.location.host
						+ "/restrito/v2005/index.php?payAnd=Principal";
				window.location = url;
			});
});