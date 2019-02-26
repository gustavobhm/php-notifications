<?php
session_start();

print_r ($_SESSION['ncrm']);
?>

<link href="common/css/bootstrap.min.css" rel="stylesheet">
<link href="library/modulos/editais/css/modal.css" rel="stylesheet" />

<script src="common/js/jquery-3.3.1.js"></script>
<script src="common/js/popper.min.js"></script>
<script src="common/js/bootstrap.min.js"></script>

<input type="hidden" id="crm"  value="<?php echo $_SESSION['ncrm']; ?>"/>

<!-- Modal -->
<div class="modal fade" id="modalNotification" tabindex="-1"
	role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Notifications -->
			</div>
		</div>
	</div>
</div>

<script>

$(function() {

    //var crm = ' . $ncrm . ';
    alert($("#crm").val());
    
    var crm = $("#crm").val();
    


    $.getJSON("/library/modulos/editais/listNotificationsByCRM.php?crm=" + crm, (data) => {


        if (data.length == 0) {
            return;
        }

        var body = "";

        data.forEach(function(notification, key) {

            body = body.concat(
                "<div class=\"row\">" +
                	"<div class=\"col\">" +
                		"<p>Data: <b id=\"p-data\">" + notification.date + "</b></p>" +
                	"</div>" +
                "</div>" +
                /*"<div class=\"row\">" +
                   "<div class=\"col-9\">" +
                      "<p>Médico: <b id=\"p-notified\">" + notification.notified + "</b></p>" +
                   "</div>" +
                   "<div class=\"col-3 text-right\">" +
                      "<p>CRM: <b id=\"b-crm\">" + notification.crm + "</b></p>" +
                   "</div>" +
                "</div>" +*/
                "<div id=\"div-notification\" class=\"row\">" +
                	"<div class=\"col\">" +
                		"<p id=\"p-notification\">" + notification.notification + "</p>" +
                	"</div>" +
                "</div>" +
                "<div class=\"row\">" +
                	"<div class=\"form-check col\">" +
                		"<input class=\"form-check-input\" type=\"checkbox\" value=\"" + notification.id + "\" id=\"checkViewNotification\">" +
                		"<label class=\"form-check-label\" for=\"checkViewNotification\">" +
                			"Não mostrar essa notificação novamente." +
                		"</label>" +
                	"</div>" +
                "</div><hr>"
            );

        });

        var title = "Notificação";
        if (data.length > 1) {
            title = "Notificações";
        }

        $(".modal-title").html(title);
        $(".modal-body").html(body);

        $("#modalNotification").modal("show");

        $(".form-check-input").change(function() {

            var values = {
                "id": $(this).val(),
                "showNotification": $(this).prop("checked") ? 0 : 1
            };

            $.ajax({
                url: "/library/modulos/am/updateNotificationView.php",
                type: "POST",
                data: values,
                success: function(response) {
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });

    });

});

</script>