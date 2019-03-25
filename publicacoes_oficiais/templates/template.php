<?php require_once "resources/templates/header.php"; ?>

<?php if (isset($_SESSION['status'])):?>
    <script> 
		notify('&nbsp;The template has been <?php echo $_SESSION['status']; ?>!');
    </script>        
	<?php unset($_SESSION['status']); ?>    
<?php endif; ?>

<?php if (isset($_SESSION['errorMessage'])):?>
    <script> 
    notifyError('&nbsp;The template has NOT been deleted! <br><br> <?php echo $_SESSION['errorMessage']; ?> ');
    </script>        
	<?php unset($_SESSION['errorMessage']); ?>    
<?php endif; ?>

<?php $departmentID = isset($_SESSION['id_depto'])? $_SESSION['id_depto']: ""; ?>

<div class="container-fluid">

	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>
						Manage <b>Templates</b>
					</h2>
				</div>
				<div class="col-sm-6">
					<a href="#editAddTemplateModal" class="btn btn-success" data-toggle="modal" data-modal-type="Add Template"> 
						<i class="material-icons">add</i> 
						<span>New Template</span>
					</a>
				</div>
			</div>
		</div>
		<table id="templates-table" class="table table-striped table-hover">
			<thead>
				<tr>
					<th style="text-align:center;width: 30%;">Description</th>
					<th style="text-align:center;width: 60%;">Template</th>
					<th style="text-align:center;width: 10%;">Actions</th>
				</tr>
			</thead>
			<tbody>
       			<?php foreach (TemplateService::listTemplatesByDepartment($departmentID) as $template): ?>
				<tr>
					<td>
						<center>
							<em>
            					<p>
            						<small><b>ID:</b></small>  
            						<?php echo sprintf("%06d", $template['id']); ?>
            					</p>
            					<p>
            						<small><b>Template Name</b></small><br>
           				    		<?php echo $template['name']; ?>
           				    	</p>
    						</em>					    	
						</center>
					</td>
					<td id="td-template">
						<?php echo $template['template'] ?>
					</td>
					<td><a href="#editAddTemplateModal" class="edit"
						data-toggle="modal" data-modal-type="Edit Template"
						data-id="<?php echo $template['id']; ?>"
						data-department="<?php echo $template['department_id']; ?>"
						data-name='<?php echo $template['name']; ?>'
						data-template="<?php echo $template['template']; ?>"> 
							<i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit">edit</i>
						</a> 
						<a href="#deleteTemplateModal" class="delete" data-toggle="modal" data-id="<?php echo $template['id']; ?>"> 
							<i class="material-icons" data-toggle="tooltip" title="" data-original-title="Delete">delete</i>
						</a>
					</td>
				</tr>
                <?php endforeach; ?>				
			</tbody>
		</table>
	</div>

	<button id="btnHome" type="button" class="btn btn-custom bmd-btn-fab">
		<i class="material-icons" data-toggle="tooltip" title="" data-original-title="Back to home">home</i>
	</button>

</div>

<?php

include 'templateModal.php';
require_once "resources/templates/footer.php";

?>