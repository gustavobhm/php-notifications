<?php
session_start();
// TODO: Return This Part
if (empty($_SESSION["status_id"])) {
    session_destroy();
    header("Location: https://www.cremesp.org.br/?siteAcao=AreaDoMedico");
    echo "<meta http-equiv='refresh' content='0;URL=https://www.cremesp.org.br/?siteAcao=AreaDoMedico'>";
    exit();
} else {

    // if($_SERVER['REMOTE_ADDR'] == '172.20.1.14' ){//teste de novos servi�os Binda
    if (date("Ymd") < "20141027") { // # Denys - N�o h� mais justificativa ap�s o dia 27/10/2014
        $linkArea .= "<li><a href='?siteAcao=AreaDoMedicoJustificativa'>Justificativa Eleitoral</a></li>";
    }
    // }

    // # testes Genu
    if ($ncrm == '25123') { // || $ip_valido == '172.21.0.36'(Silmar) teste de novos servi�os com o CRM 100029 - Genu
        $linkArea = "
	<li><a href='?siteAcao=AreaDoMedicoNecEspeciais&md=1'>Necessidades Especiais</a></li>
	<li><a href='?siteAcao=AreaDoMedicoDocumentos&op=doc'>Emiss�o de Documentos</a></li>
	<li><a href='?siteAcao=AreaDoMedicoDocumentos&op=esp'>Registro de Especialidade</a></li>
	<li><a href='?siteAcao=AreaDoMedicoDocumentos&op=can'>Cancelamento de Inscri��o</a></li>
	<li><a href='?siteAcao=AreaDoMedicoDocumentos&op=trn'>Inscri��o para outro Estado</a></li>";
    }

    // ###############

    // #########################################################################################3
    // 4/2/2019 a 31/03/2019

    if (date("Ymd") == "20181008") {
        $linkArea = "	<li><a href='/?siteAcao=AreaDoMedicoJustificativa'>Justificativa Eleitoral 2018</a></li>";
    }

    // #########################################################################################3

    $popupNotification = getHTMLPopupNotifications($ncrm);

    $siteCorpo = "<div style='float:left; width:250px;' id='menu_am'>
	<div id='foto' style=\"width:85px; margin-left:40px; height:111px; background:url('/foto_guia/" . $ncrm . "W.jpg') center top no-repeat; border:#CCC 4px solid; clear:both;\"></div>
	<ul id='menu_am'>
	<li><a href='?siteAcao=AreaDoMedicoEndereco'>Altera��o de Endere�o</a></li>
	<li><a href='?siteAcao=AreaDoMedicoBoletos'>Boletos</a></li>
	<li><a href='?siteAcao=AreaDoMedicoDsv'>Isen��o do Rod�zio</a></li>
	<li><a href='?siteAcao=AreaDoMedicoCertificadoRegularidade'>Transfer�ncia ou Secund�ria</a></li>
	<li><a href='?siteAcao=AreaDoMedicoQuitacao'>Certid�o de Quita��o</a></li>
	<li><a href='?siteAcao=AreaDoMedicoProfissional'>Certid�o �tico-Profissional</a></li>
	<li><a href='?siteAcao=AreaDoMedicoComprovante'>Comprovante de Vota��o</a></li>
	" . $linkArea . "
	<li><a href='/?siteAcao=AreaDoMedicoJornalCremesp'>Revista Ser M�dico</a></li>
	<li><a href='?siteAcao=AreaDoMedicoNecEspeciais&md=1'>Necessidades Especiais</a></li>
	<li><a href='/?siteAcao=AreaDoMedicoParcelamentoPF'>Solicita��o de Parcelamento</a></li>
	<li><a href='?siteAcao=AreaDoMedicoSair'>Sair</a></li>
	</ul>
	</div><div style='float:left; width:660px;'>" . $corpo . $popupNotification . "</div>" . $mDef;
}

function getHTMLPopupNotifications($ncrm)
{

    if (isset($_SESSION['isNotified'])) {
        return "";
    } else {
        $_SESSION['isNotified'] = true;
    }

    return '<link href="common/css/bootstrap.min.css" rel="stylesheet">
            <link href="library/modulos/editais/css/modal.css" rel="stylesheet" />
    
            <script src="common/js/jquery-3.3.1.js"></script>
            <script src="common/js/popper.min.js"></script>
            <script src="common/js/bootstrap.min.js"></script>
            <script src="library/modulos/am/js/notification.js"></script>
    
            <input type="hidden" id="crm"  value="' . $ncrm . '"/>
                            
            <!-- Modal -->
            <div class="modal fade" id="modalNotification" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                         <div class="modal-body">
                            <!-- Notifications -->
                         </div>
                    </div>
                </div>
            </div>';
}

?>