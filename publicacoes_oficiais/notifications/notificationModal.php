<!-- Add and Edit Modal HTML -->
<div id="editAddNotificationModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form-notification" action="" method="post">
				<input id="input-id" name="id" type="hidden">
				<input id="input-template" name="template" type="hidden">
				<input id="input-template_id" name="templateID" type="hidden" value=<?php echo $departmentID; ?> >			
				<div class="modal-header">
					<h4 id="h4-title" name="title" class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">x</button>
				</div>
				<div class="modal-body">
				
					<div class="row">
	   					<div class="form-group col-sm-4">
    						<label>CRM</label>                    
                			<div class="input-group search ">
                				<input id="input-crm" name="crm" type="number" class="form-control border-right-0" placeholder="Search..."  required autofocus autocomplete="off" list="crmDatalist">
								<datalist id="crmDatalist"></datalist>
                				<div class="input-group-prepend bg-white">
                			    	<span class="input-group-text border-left-0 rounded-right bg-white">
                			    		<i class="fa fa-search"></i>
                			    	</span>
                			  	</div>
                			</div>                            
                     	</div>
    					<div class="form-group notified col-sm-8">
    						<label>Notified</label>  
                            <div class="input-group notified" data-target-input="nearest">
                            	<input id="input-notified" name="notified" type="text" class="form-control" placeholder="Name of doctor to be notified..." tabindex="-1" autocomplete="off" autofocus="" required>
                                <div id="div-addNotified" class="input-group-append bg-white" >
                                    <div class="input-group-text border-left-0 rounded-right bg-white">
                                    	<i class="fa fa-refresh" data-html="true" data-toggle="tooltip" data-original-title="Update notification with CRM and NOFIFIED. <br/><small class='text-warning'>Note: You must have already chosen a notification."></small></i>
                                    </div>
                                </div>
                            </div>        						
    					</div>                     	
                    </div>                     	
                     	
    				<div class="row">
    					<div class="form-group col-sm-12">
							<label>Date</label>    					
                            <div class="input-group date" id="datepicker" data-target-input="nearest">
                                <input id="input-date" name="date" type="text" class="form-control datetimepicker-input" data-target="#datepicker" placeholder="Date of notification's publication..." tabindex="-1" autocomplete="off" autofocus="" required/>
                                <div class="input-group-append bg-white" data-target="#datepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text border-left-0 rounded-right bg-white">
                                    	<i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>    				
    				                    
					<div class="row">
						<div class="form-group col-sm-12">
							<label>Notification</label>     				            
                        	<select id="select-template" name="template" class="form-control" placeholder="Name of doctor to be notified..." required autofocus>
								<option value="" disabled selected hidden>Choose a template notification...</option>                        	
            					<?php foreach (TemplateService::listTemplatesByDepartment($departmentID) as $template): ?>
                    				<option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
                				<?php endforeach; ?>                        	
                          	</select>
						</div>
                    </div>
                    
                    <div class="row">    
    					<div class="form-group col-sm-12">
    						<textarea name="editor" id="editor" rows="10" cols="80" required></textarea>
    					</div>
    				</div>
    				
					<div class="row">
                        <div class="form-group col-sm-2">
                        	<label>Published</label>
                     		<input id="toggle-published" name="published" class="form-control" type="checkbox" checked data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-size="normal" data-width="70"   >
                        </div>										
                        <div id="div-revoked" class="form-group col-sm-2 d-none">
                        	<label>Revoked</label>
                     		<input id="toggle-revoked" name="revoked" class="form-control" type="checkbox" checked data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-size="normal" data-width="70"   >
                        </div>
    					<div id="div-revokedby" class="form-group col-sm-8 d-none">
    						<label>by notification</label>                    
                			<div class="input-group search ">
                				<input id="input-revokedby" name="revokedNotificationID"  class="form-control" placeholder="Type the notification number..."  autofocus autocomplete="off" list="revokedbyDatalist">
								<datalist id="revokedbyDatalist"></datalist>
                			</div>                            
                     	</div>
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
<div id="deleteNotificationModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="deleteNotification.php" method="post">
				<input id="delete-input-id" name="id" type="hidden">
				<div class="modal-header">
					<h4 class="modal-title">Delete Notification</h4>
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