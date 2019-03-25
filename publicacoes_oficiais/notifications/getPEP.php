<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$pep = $_GET["pep"];
echo json_encode(PEPService::getPEP($pep));

?>


