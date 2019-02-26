$(function() {

	var editor = CKEDITOR.instances.editor;

	$('#editAddTemplateModal').on('show.bs.modal', function(e) {

		var target = $(e.relatedTarget);
		var modalType = target.data('modal-type');
		
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
		
		var target = $(e.relatedTarget);
		var id = target.data('id');
		
		$('#delete-input-id').val(id);
		
	});

	editor.on('required', function(e) {
		
		editor.showNotification('This field is required.', 'warning');
		e.cancel();
		
	});

});

function setValuesInTemplate(target, editor){
	
	var id = target.data('id');
	var department = target.data('department');
	var name = target.data('name');
	var template = target.data('template');
	
	$('#input-id').val(id);
	$('#select-department').val(department);
	$('#input-name').val(name);
	
	editor.setData(template);
	
}

function fixEditorHeight(editor) {
	
	setTimeout(function() {
		editor.focus();
		$('#select-department').focus();
	}, 200);

}