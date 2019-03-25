<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$initials = $_GET["initials"];
echo json_encode(DelegacyService::getDelegacyByInitials($initials));

?>


