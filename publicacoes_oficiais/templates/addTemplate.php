<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$departmentID = $_POST['department'];
$name = $_POST['name'];
$editor = str_replace('\"', "'", $_POST['editor']);

$template = new Template($name, $editor, $departmentID);

TemplateService::save($template);

$_SESSION['status'] = "saved";

header("Location: template.php");

?>