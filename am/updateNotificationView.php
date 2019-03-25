<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$id = $_POST['id'];
$showNotification = $_POST['showNotification'];

echo json_encode(NotificationService::updateShowNotification($id, $showNotification));

?>