$(function () {

	var editor = CKEDITOR.instances.editor;

	$("#input-revokedby").mask('000000');
	$("#input-crm").mask('000000');

	$('#editAddNotificationModal').on('show.bs.modal', function (e) {

		var target = $(e.relatedTarget);
		var modalType = target.data('modal-type');
		
		$("#h4-title").text(modalType);

		if (modalType == "Edit Notification") {
			setValuesInTheModal(target, editor);
			$('#form-notification').attr("action", "editNotification.php");
		} else {
			$('#form-notification').attr("action", "addNotification.php");
		}

		fixEditorHeight(editor);
	});

	$('#editAddNotificationModal').on('hidden.bs.modal', function (e) {

		editor.setData("");
		$('#form-notification').trigger('reset');
		$('#toggle-published').bootstrapToggle('off');
		$('#toggle-revoked').bootstrapToggle('off');

	});

	$('#deleteNotificationModal').on('show.bs.modal', function (e) {

		var target = $(e.relatedTarget);
		var id = target.data('id');
		$('#delete-input-id').val(id);

	});

	$("#select-template").change(function () {

		var templateID = $('#select-template').val();
		
		$.getJSON("getTemplateByID.php?id=" + templateID, (data) => {
			editor.setData(data.template);
		});		

	});


	$('#toggle-published').bootstrapToggle();
	$('#toggle-published').bootstrapToggle('off');

	$('#toggle-published').change(function () {
		if ($(this).prop('checked')) {
			$('#div-revoked').addClass('d-block');
			$('#div-revoked').removeClass('d-none');
		} else {
			$('#div-revoked').addClass('d-none');
			$('#div-revoked').removeClass('d-block');
			$('#toggle-revoked').bootstrapToggle('off');
		}
	});

	$('#toggle-revoked').bootstrapToggle();
	$('#toggle-revoked').bootstrapToggle('off');

	$('#toggle-revoked').change(function () {
		if ($(this).prop('checked')) {
			$('#div-revokedby').addClass('d-block');
			$('#div-revokedby').removeClass('d-none');
			$('#input-revokedby').attr('required', 'required');
		} else {
			$('#div-revokedby').addClass('d-none');
			$('#div-revokedby').removeClass('d-block');
			$('#input-revokedby').removeAttr('required');
			$('#input-revokedby').val("");
		}
	});

	editor.on('required', function (e) {
		editor.showNotification('This field is required.', 'warning');
		e.cancel();
	});

	$('#input-notified').keydown(function (event) {
		event.preventDefault();
	});

	$("#input-crm").keyup(function () {
		loadNotifiedByCRM(this.value);
	});

	$("#input-revokedby").keyup(function () {
		loadNotificationsForRevokedby(this.value);
	});

	$("#div-addNotified").click(function (event) {
		replaceNotifiedAndCRM(editor);
	});

});

function loadNotifiedByCRM(crm){
	
	if (crm != "") {
		$.getJSON("getNameByCRM.php?search=" + crm, (data) => {
			if (data.name) {
				$('#input-notified').val(data.name);
			} else {
				$('#input-notified').val("");
			}
		});
	}

}

function loadNotificationsForRevokedby(revokedby){
	
	let id = $("#input-id").val();
	let departmentID = $("#input-template_id").val();;

	$("#revokedbyDatalist").empty();

	if (revokedby != "") {
		$.getJSON("listNotificationByNotID.php?id=" + id + "&search=" + revokedby+ "&departmentID=" + departmentID, (data) => {
			$.each(data, (k, v) => {
				$("#revokedbyDatalist").append("<option value=" + v.id + ">" + 
												  v.notified + "[" + 
												  ("000000" + v.crm).slice(-6) + "] - " +  
											      v.template_name +
											   "</option>");
			});
		});
	}
	
}

function replaceNotifiedAndCRM(editor) {
	
	let crm = $("#input-crm").val();
	let doctor = $("#input-notified").val();

	notification = editor.getData();
	notificationBase = notification;

	notification = notification.replace("[NOME DO M&Eacute;DICO/A]",doctor);
	notification = notification.replace("[N&Uacute;MERO DO CRM]",crm);

	if (notificationBase != notification) {
		editor.setData(notification);
		notifySuccess('CRM and NOTIFIED updated.');
	} else {
		notifyWarning('CRM and NOTIFIED were not updated because they were not found!');
	}
	
}

function setValuesInTheModal(target, editor) {

	var id = target.data('id');
	var date = target.data('date');
	var crm = target.data('crm');
	var notified = target.data('notified');
	var templateID = target.data('template_id');
	var notification = target.data('notification');
	var published = target.data('published');
	var revoked = target.data('revoked');
	var revokedNotificationID = target.data('revoked_notification_id');

	$('#input-id').val(id);
	$('#input-date').val(date);
	$('#input-crm').val(crm);
	$('#input-notified').val(notified);

	var toogleStatus = published == 1 ? 'on' : 'off';
	$('#toggle-published').bootstrapToggle(toogleStatus);

	var toogleRevoked = revoked == 1 ? 'on' : 'off';
	$('#toggle-revoked').bootstrapToggle(toogleRevoked);

	$('#input-revokedby').val(revokedNotificationID);

	$("#select-template").val(templateID);

	editor.setData(notification);
}

function fixEditorHeight(editor) {

	setTimeout(function () {
		editor.focus();
		$('#input-crm').focus();
	}, 200);

}