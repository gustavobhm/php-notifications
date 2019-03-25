<!-- Add and Edit Modal HTML -->
<div id="editAddTemplateModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form-template" action="" method="post">
				<div class="modal-header">
					<h4 id="h4-title" name="title" class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				</div>
				<div class="modal-body">
					<input id="input-id" name="id" type="hidden">
					<div class="form-group">
						<label>Name</label> 
						<input id="input-name" name="name" type="text" class="form-control" placeholder="Type the template name..."  required autofocus>
					</div>
					<div class="form-group">
						<label>Template</label>
						<textarea name="editor" id="editor" rows="10" cols="80" required></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"> 
					<input type="submit" class="btn btn-success" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete Modal HTML -->
<div id="deleteTemplateModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form  action="deleteTemplate.php" method="post">
				<input id="delete-input-id" name="id" type="hidden">
				<div class="modal-header">
					<h4 class="modal-title">Delete Template</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this record?</p>
					<p class="text-warning">
						<small>This action cannot be undone.</small>
					</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"> 
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>