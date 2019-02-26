<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$id = $_GET["id"];
$something = $_GET["search"];
$departmentID = $_GET["departmentID"];
echo json_encode(NotificationService::listNotificationByNotID($id, $something, $departmentID));

?>


