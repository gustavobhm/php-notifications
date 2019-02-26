<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$search = $_GET["search"];
echo json_encode(DoctorService::getNameByCRM($search));

?>


