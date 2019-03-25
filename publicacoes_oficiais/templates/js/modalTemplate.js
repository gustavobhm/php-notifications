$(function() {

	var editor = CKEDITOR.instances.editor;

	$('#editAddTemplateModal').on('show.bs.modal', function(e) {

		let target = $(e.relatedTarget);
		let modalType = target.data('modal-type');
		
		$("#h4-title").text(modalType);

		if (modalType == "Edit Template") {
			setValuesInTemplate(target, editor);
			$('#form-template').attr("action", "editTemplate.php");
		} else {
			$('#form-template').attr("action", "addTemplate.php");
		}
		
		fixEditorHeight(editor);

	});

	$('#editAddTemplateModal').on('hidden.bs.modal', function(e) {
		
		$('#form-template').trigger('reset');
		editor.setData("");
		
	});

	$('#deleteTemplateModal').on('show.bs.modal', function(e) {
		
		let target = $(e.relatedTarget);
		let id = target.data('id');
		
		$('#delete-input-id').val(id);
		
	});

	editor.on('required', function(e) {
		
		editor.showNotification('This field is required.', 'warning');
		e.cancel();
		
	});

});

function setValuesInTemplate(target, editor){
	
	let id = target.data('id');
	let name = target.data('name');
	let template = target.data('template');
	
	$('#input-id').val(id);
	$('#input-name').val(name);
	
	editor.setData(template);
	
}

function fixEditorHeight(editor) {
	
	setTimeout(function() {
		editor.focus();
		$('#input-name').focus();
	}, 200);

}