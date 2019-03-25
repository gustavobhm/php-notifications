const CONVOCATION_NOTIFICATION_ID = 1;
const REDRESS_NOTIFICATION_ID = 2;
const CENSORSHIP_NOTIFICATION_ID = 3;
const SUSPENSION_NOTIFICATION_ID = 4;
const CASSAGE_NOTIFICATION_ID = 5;
const INTEREST_NOTIFICATION_ID = 6;
const CITAÇÃO_NOTIFICATION_ID = 7;
const INTIMATION_NOTIFICATION_ID = 8;
const SUSPENSION_CENSORSHIP_NOTIFICATION_ID = 9;
const SUB_JUDICE_NOTIFICATION_ID = 10;

const SSI_DEPARTMENT_ID = 13;
const SPEP_DEPARTMENT_ID = 33;

$(function () {

	let editor = CKEDITOR.instances.editor;

	$("#input-revokedby").mask('000000');
	$("#input-crm").mask('000000');

	$('#editAddNotificationModal').on('show.bs.modal', function (e) {

		let target = $(e.relatedTarget);
		let modalType = target.data('modal-type');
		let action = "";
		
		$("#h4-title").text(modalType);

		if (modalType == "Edit Notification") {
			setValuesInTheModal(target, editor);
			action = "editNotification.php";
		} else {
			resetModal(editor);
			action = "addNotification.php";
		}
		
		$('#form-notification').attr("action", action);

		fixEditorHeight(editor);
	});

	$('#deleteNotificationModal').on('show.bs.modal', function (e) {
		let target = $(e.relatedTarget);
		let id = target.data('id');
		
		$('#delete-input-id').val(id);
	});

	$("#select-template").change(function () {
		let notified = $('#input-notified').val();
		let templateID = $(this).val();
		let departmentID = $("#input-department_id").val();
		
		showOrHidePEP(notified, templateID, departmentID);
		showOrHideUnity(templateID);
		loadTemplate(templateID, editor);
	});
	
	$("#select-unity").change(function () {
		let unity = $(this).val();
		
		loadUnityAddress(unity);
	});
	
	$("#select-pep").change(function () {
		let templateID = $("#select-template").val();
		let pep = $(this).val();
		
		loadPEPParams(pep, templateID);
	});	

	$('#toggle-published').bootstrapToggle();
	$('#toggle-published').bootstrapToggle('off');

	$('#toggle-published').change(function () {
		$(this).prop('checked') ? showDivRevoked(): hideDivRevoked();  
	});

	$('#toggle-revoked').bootstrapToggle();
	$('#toggle-revoked').bootstrapToggle('off');

	$('#toggle-revoked').change(function () {
		$(this).prop('checked')? showDivRevokedBy() : hideDivRevokedBy();
	});

	editor.on('required', function (e) {
		editor.showNotification('Notification is required.', 'warning', 5000);
		e.cancel();
	});

	$('#input-notified').keydown(function (event) {
		event.preventDefault();
	});
	
	$('#input-cfmResolution').keydown(function (event) {
		event.preventDefault();
	});
	
	$('#input-articles').keydown(function (event) {
		event.preventDefault();
	});	
	
	$('#input-address').keydown(function (event) {
		event.preventDefault();
	});	

	$("#input-crm").keyup(function () {
		let crm = $(this).val();
		let templateID = $('#select-template').val();
		let pep = $('#select-pep').val();
		
		loadNotifiedByCRM(crm, templateID);
		loadPEPsForCRMAndSelect(crm, pep);
	});

	$("#input-revokedby").keyup(function () {
		let revokedby = $(this).val();
		let id = $("#input-id").val();
		let departmentID = $("#input-department_id").val();
		
		loadNotificationsForRevokedby(revokedby, id, departmentID);
	});

	$("#i-updateNotification").click(function (event) {
		let templateID = $("#select-template").val();
		
		updateTemplate(templateID, editor);
	});
	
});

function loadTemplate(templateID, editor){
	$.getJSON("getTemplateByID.php?id=" + templateID, (data) => {
		editor.setData(data.template);
	});
}

function updateTemplate(templateID, editor){
	$.getJSON("getTemplateByID.php?id=" + templateID, (data) => {
		let template = data.template;
		replaceParametersInNotification(editor, template);
	});
}

function loadUnityAddress(initials){
	if (isValid(initials)) {
		$.getJSON("getDelegacyByInitials.php?initials=" + initials, (data) => {
			if (data.COMPLETE_ADDRESS) {
				$('#input-address').val(data.COMPLETE_ADDRESS);
				showDivUnityAddress();					
			} else {
				hideDivUnityAddress();
			}
		});
	}
}

function loadPEPParams(pep,templateID){
	
	$('#input-cfmResolution').val("");
	$('#input-articles').val("");
	
	if (isValid(pep) && isValid(templateID)) {
		$.getJSON("getPEP.php?pep=" + pep, (data) => {
			data.RESOLUTION ? $('#input-cfmResolution').val(data.RESOLUTION): $('#input-cfmResolution').val("");
			
			if (data.FINAL_INSTANCE){
				$('#input-articles').val(data.FINAL_INSTANCE);
			} else if (data.SECOND_INSTANCE){
				$('#input-articles').val(data.SECOND_INSTANCE);
			} else if (data.FIRST_INSTANCE){
				$('#input-articles').val(data.FIRST_INSTANCE);
			} else {
				$('#input-articles').val("");
			}
		});
	}
}

function loadNotifiedByCRM(crm, templateID, departmentID){
	$.getJSON("getDoctorByCRM.php?crm=" + crm, (data) => {
		data.name ? $('#input-notified').val(data.name): $('#input-notified').val("");
		
		let notified = data.name;
		
		showOrHidePEP(notified, templateID, departmentID);
	});
}

function loadNotificationsForRevokedby(revokedby, id, departmentID){

	$("#revokedbyDatalist").empty();

	if (isValid(revokedby)) {
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

function loadPEPsForCRMAndSelect(crm, selectedPep){

	if (isValid(crm)) {
		$.getJSON("listPEPsByCRM.php?crm=" + crm, (data) => {
			
			$("#select-pep").empty();
			$("#select-pep").append("<option value='' disabled selected hidden>Choose PEP number...</option>");
			$('#select-pep').val("");
			
			$.each(data, (k, v) => {
				$("#select-pep").append("<option value=" + v.PEP + ">" + 
												  v.PEP +
											   "</option>");
			});
			
				$("#select-pep").val(selectedPep).change();
			
		});
	}
}

function showOrHideUnity(templateID){
	if (templateID == CONVOCATION_NOTIFICATION_ID){
		showDivUnity();
	} else {
		hideDivUnity();
		hideDivUnityAddress();
	}
}

function showOrHidePEP(notified, templateID, departmentID){
	if (isValid(notified) && isToShowDivPEPAndDate(departmentID) && isToShowDivResolutionAndArticle(templateID)){
		showDivPEP();
		showDivDate();
		showDivCFMResolution();
		showDivArticles();
	} else if (isValid(notified) && isToShowDivPEPAndDate(departmentID)) {
		showDivPEP();45
		showDivDate();
		hideDivCFMResolution();
		hideDivArticles();		
	} else {
		hideDivPEP();
		hideDivDate();
		hideDivCFMResolution();
		hideDivArticles();
	}
}

function isToShowDivPEPAndDate(departmentID){
	return  departmentID == SPEP_DEPARTMENT_ID ? true : false ;
}

/*function isToShowDivPEPAndDate(templateID){
	if (   templateID == CENSORSHIP_NOTIFICATION_ID
		|| templateID == SUSPENSION_NOTIFICATION_ID
		|| templateID == CASSAGE_NOTIFICATION_ID
		|| templateID == INTEREST_NOTIFICATION_ID
		|| templateID == CITAÇÃO_NOTIFICATION_ID
		|| templateID == INTIMATION_NOTIFICATION_ID
		|| templateID == SUSPENSION_CENSORSHIP_NOTIFICATION_ID
		|| templateID == SUB_JUDICE_NOTIFICATION_ID){
		return true;
	}
	return false;
}*/

function isToShowDivResolutionAndArticle(templateID){
	if (   templateID == CENSORSHIP_NOTIFICATION_ID
		|| templateID == SUSPENSION_NOTIFICATION_ID
		|| templateID == CASSAGE_NOTIFICATION_ID
		|| templateID == SUB_JUDICE_NOTIFICATION_ID	){
		return true;
	}
	return false;
}

function showDivPEP(){
	$('#div-pep').addClass('d-block');
	$('#div-pep').removeClass('d-none');
	$('#select-pep').attr('required', 'required');
}

function hideDivPEP(){
	$('#div-pep').addClass('d-none');
	$('#div-pep').removeClass('d-block');
	$('#select-pep').removeAttr('required');
	$("#select-pep").empty();
	$("#select-pep").append("<option value='' disabled selected hidden>Choose PEP number...</option>");
	$('#select-pep').val("");	
}

function showDivDate(){
	$('#div-date').addClass('d-block');
	$('#div-date').removeClass('d-none');
	$('#input-date').attr('required', 'required');
}

function hideDivDate(){
	$('#div-date').addClass('d-none');
	$('#div-date').removeClass('d-block');
	$('#input-date').removeAttr('required');
	
	resetInputDate();
}

function showDivCFMResolution(){
	$('#div-cfmResolution').addClass('d-block');
	$('#div-cfmResolution').removeClass('d-none');
}

function hideDivCFMResolution(){
	$('#div-cfmResolution').addClass('d-none');
	$('#div-cfmResolution').removeClass('d-block');
	$('#input-cfmResolution').val("");
}

function showDivArticles(){
	$('#div-articles').addClass('d-block');
	$('#div-articles').removeClass('d-none');
}

function hideDivArticles(){
	$('#div-articles').addClass('d-none');
	$('#div-articles').removeClass('d-block');
	$('#input-articles').val("");
}

function showDivUnity(){
	$('#div-unity').addClass('d-block');
	$('#div-unity').removeClass('d-none');
	$('#select-unity').attr('required', 'required');
}

function hideDivUnity(){
	$('#div-unity').addClass('d-none');
	$('#div-unity').removeClass('d-block');
	$('#select-unity').removeAttr('required');
	$('#select-unity').val("");
}

function showDivUnityAddress(){
	$('#div-unityAddress').addClass('d-block');
	$('#div-unityAddress').removeClass('d-none');
}

function hideDivUnityAddress(){
	$('#div-unityAddress').addClass('d-none');
	$('#div-unityAddress').removeClass('d-block');
	$('#input-address').val("");
}

function showDivRevoked(){
	$('#div-revoked').addClass('d-block');
	$('#div-revoked').removeClass('d-none');
}

function hideDivRevoked(){
	$('#div-revoked').addClass('d-none');
	$('#div-revoked').removeClass('d-block');
	$('#toggle-revoked').bootstrapToggle('off');
}

function showDivRevokedBy(){
	$('#div-revokedby').addClass('d-block');
	$('#div-revokedby').removeClass('d-none');
	$('#input-revokedby').attr('required', 'required');
}

function hideDivRevokedBy(){
	$('#div-revokedby').addClass('d-none');
	$('#div-revokedby').removeClass('d-block');
	$('#input-revokedby').removeAttr('required');
	$('#input-revokedby').val("");
}

function setValueToInputDate(date){
	
	let departmentID = $("#input-department_id").val();
	let newDate = moment().format('DD/MM/YYYY');
	
	departmentID == SSI_DEPARTMENT_ID ?	$('#input-date').val(newDate) : $('#input-date').val(date);
}

function resetInputDate(){
	
	let departmentID = $("#input-department_id").val();
	let newDate = moment().format('DD/MM/YYYY');
	
	departmentID == SSI_DEPARTMENT_ID ?	$('#input-date').val(newDate) : $('#input-date').val("");
}

function resetModal(editor){
	
	editor.setData("");
	
	$('#form-notification').trigger('reset');
	
	$('#toggle-published').bootstrapToggle('off');
	$('#toggle-revoked').bootstrapToggle('off');
	
	hideDivPEP();
	hideDivDate();
	hideDivCFMResolution();
	hideDivArticles();
	
	hideDivUnity();
	hideDivUnityAddress();
	
}

function setValuesInTheModal(target, editor) {
	
	let departmentID = $("#input-department_id").val();

	let id = target.data('id');
	let date = target.data('date');
	let crm = target.data('crm');
	let notified = target.data('notified');
	let templateID = target.data('template_id');
	let notification = target.data('notification');
	let published = target.data('published');
	let revoked = target.data('revoked');
	let revokedNotificationID = target.data('revoked_notification_id');
	let pep = target.data('pep');
	let cfmResolution = target.data('cfm_resolution');
	let articles = target.data('articles');
	let unity = target.data('unity');
	let unityAddress = target.data('unity_address');


	$('#input-id').val(id);

	$('#input-crm').val(crm);
	loadNotifiedByCRM(crm, templateID, departmentID);
	
	setValueToInputDate(date);
	
	let toogleStatus = published == 1 ? 'on' : 'off';
	$('#toggle-published').bootstrapToggle(toogleStatus);

	let toogleRevoked = revoked == 1 ? 'on' : 'off';
	$('#toggle-revoked').bootstrapToggle(toogleRevoked);

	$('#input-revokedby').val(revokedNotificationID);

	$("#select-template").val(templateID);

	showOrHidePEP(notified, templateID, departmentID);
	loadPEPsForCRMAndSelect(crm, pep);
	
	showOrHideUnity(templateID);
	$("#select-unity").val(unity).change();
	
	editor.setData(notification);
}

function isValid(param){
	return (param != null && param != "" && param != "undefined"); 
}

function fixEditorHeight(editor) {

	setTimeout(function () {
		editor.focus();
		$('#input-crm').focus();
	}, 200);

}