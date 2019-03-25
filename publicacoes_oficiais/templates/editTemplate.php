<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$id = $_POST['id'];
$departmentID = $_SESSION['id_depto'];
$name = str_replace('\"', '"', $_POST['name']);
$editor = str_replace('\"', "'", $_POST['editor']);

$template = new Template($name, $editor, $departmentID, $id);

TemplateService::update($template);

$_SESSION['status'] = "edited";

header("Location: template.php");

?>