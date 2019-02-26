<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$id = $_POST['id'];

TemplateService::delete($id);

$_SESSION['status'] = "deleted";

header("Location: template.php");

?>