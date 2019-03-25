<?php
require_once "/var/www/cremesp.com/common/resources/init.php";
?>

<html>

<link href="/common/css/fonts_googleapis.css" rel="stylesheet" />
<link href="/common/css/icons_googleapis.css" rel="stylesheet" />

<link href="/common/css/bootstrap.min.css" rel="stylesheet">

<link href="/common/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

<link href="/common/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

<link href="/common/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="/common/css/dataTablesCustomized.css" rel="stylesheet" />

<link href="/common/bootstrap-datepicker/css/bootstrap-datepicker.standalone.css" />

<link href="/common/css/modalCustomized.css" rel="stylesheet" />

<link href="/common/css/globalCustomized.css" rel="stylesheet" />

<link href="/common/css/bootstrap4-toggle.min.css" rel="stylesheet">

<script src="/common/js/jquery-3.3.1.js"></script>
<script src="/common/js/popper.min.js"></script>
<script src="/common/js/bootstrap.min.js"></script>

<script src="/common/js/moment.js"></script>
<script src="/common/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="/common/js/bootstrap-notify.js"></script>
<script src="/common/js/bootstrap-notify.min.js"></script>

<script src="/common/js/jquery.dataTables.min.js"></script>
<script src="/common/js/dataTables.bootstrap4.min.js"></script>

<script src="/common/js/bootstrap4-toggle.min.js"></script>

<script src="/common/js/notify.js"></script>

<script src="/common/js/jquery.mask.js"></script>

<script src="/common/js/stringReplaceAll.js"></script>

<script src="/common/js/jspdf.debug.js"></script>
<script src="/common/js/html2canvas.js"></script>

<body>
	<header>This is the header</header>
	<div id="content">

		<table border="2" cellpadding="5" cellspacing="0" style="width: 500px">
			<tbody>
				<tr>
					<td>
						<p style="text-align: center">
							<img alt=""
								src="http://www.cremesp.net/library/modulos/editais/images/logo_cremesp_2019.png">
						</p>

						<p style="text-align: center">
							<span style="color: #7f8c8d"><small>Rua Frei Caneca, 1282 -
									Consolação - São Paulo/SP - CEP 01307-002</small></span>
						</p>

						<p style="text-align: center">
							<small><span style="color: #7f8c8d">Fone: (11) 4349-9900 -</span>
								<a href="http://www.cremesp.org.br">www.cremesp.org.br</a></small>
						</p>
					</td>
				</tr>
				<tr>
					<td style="background-color: #555555; text-align: center"><span
						style="line-height: 1"><span style="font-size: 14px"><span
								style="color: #ffffff"><strong>SUSPENSÃO DO EXERCÍCIO
										PROFISSIONAL</strong></span></span></span></td>
				</tr>
				<tr>
					<td style="text-align: justify">
						<p>
							<span style="line-height: 2"><span style="font-size: 12px">ROGER
									ABDELMASSIH, CRM/SP 14941, por infração aos artigos 2, 4, 9,
									55, 56, 63, 65 do Código de Ética Médica (Resolução CFM n.º <span
									style="color: #e74c3c">[RESOLUÇÃO]</span>), no Processo
									Ético-Profissional n.º 8.798-335/2009, que deverá ser cumprida
									no período de <span style="color: #e74c3c">[DATA INÍCIO]</span>
									a <span style="color: #e74c3c">[DATA FIM]</span>, publicada no
									DOE, edição de 20/03/2019.
							</span></span>
						</p>
					</td>
				</tr>
			</tbody>
		</table>


	</div>
	<button id="print">Download Pdf</button>
	<footer>This is the footer</footer>
</body>

<script>

$(function () {

  $('#print').click(function() {

	  var w = document.getElementById("content").offsetWidth;
	  var h = document.getElementById("content").offsetHeight;

	  html2canvas(document.getElementById("content"), {
		    dpi: 1000, 
		    scale: 15 }).then(function (canvas) {
		      var img = canvas.toDataURL("image/jpeg", 1);
		      var doc = new jsPDF('L', 'px', [w, h]);
		      doc.addImage(img, 'JPEG', 0, 0, w, h);
		      doc.save('sample-file.pdf');
		    });	  
	});

});	
	
  </script>

</html>