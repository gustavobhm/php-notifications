<?php require_once "resources/templates/header.php"; ?>

<div class="container-fluid">

	<table id="notifications-table" class="table table-striped table-hover">
		<thead>
			<tr>
				<th style="width:15%;" >Data</th>
				<th style="width:15%;" >CRM</th>
				<th style="width:30%;" >Médico</th>
				<th style="width:40%;" >Notificação</th>
			</tr>
		</thead>
		<tbody>
       		<?php foreach (NotificationService::listPublishedNotifications() as $notification): ?>
        	<tr>
				<td><?php echo $notification['date']; ?></td>
				<td><?php echo sprintf("%06d",$notification['crm']); ?></td>
				<td><?php echo $notification['notified'] ?></td>
				<td>
					<?php if($notification['revoked']) : ?>
						<?php $revokedNotification = NotificationService::getNotificationByID($notification['revoked_notification_id']); ?>
						<p data-toggle="tooltip" data-html="true"  data-original-title="Notificação revogada pela notificação abaixo: </br><small class='text-warning'><?php echo $revokedNotification['template_name']; ?></small>">
							<small>
								<i id="icon-error" class="material-icons" >error</i>
								<del class="text-danger"> <?php echo $notification['template_name']; ?></del>
							</small>
						<p>
					<?php endif; ?>
    				<a
    					id="<?php echo $notification['id']; ?>" 
    					class="link-modal" 
    					href="#bannerformmodal" 
    					data-toggle="modal"
    					data-target="#modalNotification"
    					data-title="Notificação"
    					data-id="<?php echo $notification['revoked']? $revokedNotification['id']: $notification['id']; ?>"
    				>
    					<?php echo $notification['revoked']? $revokedNotification['template_name']: $notification['template_name']; ?>
    				</a>					
				</td>
			</tr>
            <?php endforeach; ?>				
		</tbody>
	</table>

</div>

<?php require_once "resources/templates/footer.php"; ?>