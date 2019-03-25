<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$crm = $_GET["crm"];
echo json_encode(NotificationService::listNotificationsByCRM($crm));

?>


