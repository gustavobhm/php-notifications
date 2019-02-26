<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$id = $_POST['id'];
$templateID = $_POST['template'];
$editor = str_replace('\"', "'", $_POST['editor']);
$date = $_POST['date'];
$crm = $_POST['crm'];
$notified = $_POST['notified'];
$published = isset($_POST['published']) ? 1 : 0;
$revoked = isset($_POST['revoked']) ? 1 : 0;
$revokedNotificationID = !empty($_POST['revokedNotificationID']) ? $_POST['revokedNotificationID'] : NULL;

$notification = new Notification($date, $crm, $notified, $published, $revoked, $revokedNotificationID, $templateID, $editor, "1" , $id);

NotificationService::update($notification);

$_SESSION['status'] = "edited";

header("Location: notification.php");

?>