$(function() {
	
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