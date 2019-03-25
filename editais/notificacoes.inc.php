<?php
$tituloPagina = "Notificações";
$siteNavegador = "<a href='/' class='navegador'>Home ></a> <a href='?siteAcao=Editais'>Editais </a>";
$siteTitulo = "Notificações";

$siteCorpo = '

    <html>

    </body>

    <link href="/common/css/bootstrap.min.css" rel="stylesheet">
    <link href="/common/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/library/modulos/editais/css/modal.css" rel="stylesheet" />
    
    <script src="/common/js/jquery-3.3.1.js"></script>
    <script src="/common/js/popper.min.js"></script>
    <script src="/common/js/bootstrap.min.js"></script>
    <script src="/common/js/jspdf.debug.js"></script>
    <script src="/common/js/html2canvas.js"></script>
    <script src="/library/modulos/editais/js/modal.js"></script>

    <iframe id="iframe-notificacoes" src="/library/modulos/editais/notificacoes.php" width="100%" ></iframe>

    <!-- Modal -->
    <div class="modal fade" id="modalNotification" tabindex="-1" role="dialog" >
    	<div class="modal-dialog modal-dialog-centered" role="document">
    		<div class="modal-content" >
    			<div class="modal-header">
                    <h5 class="modal-title" ></h5>
                    <div>
                        <i id="i-export_image" class="fa fa-file-image-o fa-lg" data-toggle="tooltip" title="Exportar para PNG"></i>
                        <i id="i-export_pdf" class="fa fa-file-pdf-o fa-lg" data-toggle="tooltip" title="Exportar para PDF"></i>
                        <i id="i-close_modal" class="fa fa-times fa-lg" data-toggle="tooltip" title="Fechar" data-dismiss="modal"></i>
                    </div>
    			</div>
    			<div class="modal-body">
                    <div class="row">
		  	  		   <div class="col">    						
		  	  		       <p>Data: <b id="p-data"></b></p>
		  	  		   </div>
		  	  		</div>							  		    						
		  	  		<div class="row">
		  	  		   <div class="col-9">
		  	  			  <p>Médico: <b id="p-notified"></b></p>    						  	  
		  	  	        </div>
    		  	  		<div class="col-3 text-right">
    		  	  		   <p>CRM: <b id="b-crm"></b></p>        						  
    		  	  		</div>
    		  	  	</div>
		  	  		<div id="div-notification" class="row">
		  	  		   <div class="col">
		  	  		       <p id="p-notification"></p>
		  	  		   </div>
		  	  		</div>
                </div>
    		</div>
    	</div>
    </div>

    </body>
    </html>

';

?>

