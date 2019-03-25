<?php require_once "resources/templates/header.php"; ?>

<?php if (isset($_SESSION['status'])):?>
	<script> 
		notify('&nbsp;The notification has been <?php echo $_SESSION['status']; ?>!');
    </script>
	<?php unset($_SESSION['status']);?>    
<?php endif; ?>

<?php $departmentID = isset($_SESSION['id_depto'])? $_SESSION['id_depto']: ""; ?>

<div class="container-fluid">

	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>
						Manage <b>Notifications</b>
					</h2>
				</div>
				<div class="col-sm-6">
					<a href="#editAddNotificationModal" class="btn btn-success" data-toggle="modal" data-modal-type="Add Notification"> 
						<i class="material-icons">add</i> 
						<span>New Notification</span>
					</a>
				</div>
			</div>
		</div>
		<table id="notifications-table" class="table table-striped table-hover">
			<thead>
				<tr>
					<th style="text-align:center;width: 30%;">Description</th>
					<th style="text-align:center;width: 60%;">Notification</th>
					<th style="text-align:center;width: 10%;">Actions</th>
				</tr>
			</thead>
			<tbody>
       			<?php foreach (NotificationService::listNotificationsByDepartment($departmentID) as $notification): ?>
                <tr>
					<td>
						<center>
							<em>
        						<p>
        							<small><b>ID:</b></small>  
        							<?php echo sprintf("%06d", $notification['id']); ?>
        						</p>
        						<?php if(!($departmentID == SSI_DEPARTMENT_ID && !$notification['published'])) : ?>
            						<p>
            							<small><b>Publication Date:</b></small><br> 
            							<?php echo $notification['date']; ?>
            						</p>
            					<?php endif; ?>
        						<p>
        							<small><b>CRM: </b></small> 
        							<?php echo $notification['crm']; ?>
        						</p>        						
        						<p>
        							<small><b>Doctor Notified</b></small><br> 
        							<?php echo $notification['notified']; ?>
        						</p>
        						<p>
        							<small><b>Notification Type</b></small><br>
       					    		<?php echo $notification['template_name']; ?>
       					    	</p>
        						<p>
        							<small><b>Status </b></small><br>
            						<?php if($notification['published']==1) : ?>
                                    	<b class="text-success">Published</b>
                                    	<?php if($notification['revoked']==1) : ?>
          	                            	and <b class="text-danger">Revoked</b> by notification <?php echo sprintf("%06d", $notification['revoked_notification_id']); ?>
                                    	<?php endif; ?>
                                    <?php else : ?>
                                   		<b class="text-danger">Not published</b>
                                    <?php endif; ?>
        						</p>
    						</em>					    	
						</center>
					</td>
					<td id="td-notification">
						<?php echo $notification['notification'] ?>
					</td>
					<td>
						<?php if(!($notification['published'] && $departmentID == SSI_DEPARTMENT_ID)) : ?>
    						<a href="#editAddNotificationModal" class="edit"
    						   data-toggle="modal" 
            				   data-modal-type="Edit Notification"
            				   data-department_id="<?php echo $departmentID; ?>"
            			       data-id="<?php echo $notification['id']; ?>"
            				   data-date="<?php echo $notification['date']; ?>"
            				   data-crm="<?php echo $notification['crm']; ?>"
            				   data-notified="<?php echo $notification['notified']; ?>"
            				   data-published="<?php echo $notification['published']; ?>"
            				   data-template_id="<?php echo $notification['template_id']; ?>"
            				   data-notification="<?php echo $notification['notification']; ?>" 
            				   data-revoked="<?php echo $notification['revoked']; ?>"
            				   data-revoked_notification_id="<?php echo $notification['revoked_notification_id']; ?>"
							   data-pep="<?php echo $notification['pep']; ?>"
            				   data-cfm_resolution="<?php echo $notification['cfm_resolution']; ?>"
            				   data-articles="<?php echo $notification['articles']; ?>"            				   
            				   data-unity="<?php echo $notification['unity']; ?>"
            				   data-unity_address="<?php echo $notification['unity_address']; ?>"> 
    							<i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit">edit</i>
    						</a>
    					<?php endif; ?>
						<?php if(!$notification['published'] || $departmentID == SSI_DEPARTMENT_ID) : ?> 
    						<a href="#deleteNotificationModal" class="delete"	data-toggle="modal" data-id="<?php echo $notification['id']; ?>"> 
    							<i class="material-icons" data-toggle="tooltip" title="" data-original-title="Delete">delete</i>
    						</a>
    					<?php endif; ?>
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

include 'notificationModal.php';
require_once "resources/templates/footer.php";

?>