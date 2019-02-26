<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$id = $_GET["id"];
echo json_encode(TemplateService::getTemplateByID($id));

?>


