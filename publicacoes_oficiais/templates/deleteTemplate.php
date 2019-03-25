<?php
require_once "/var/www/cremesp.com/common/resources/init.php";

$id = $_POST['id'];

try {
    TemplateService::delete($id);
    $_SESSION['status'] = "deleted";
} catch (Exception $e) {
    if ($e->getCode() == 23000) {
        $_SESSION['errorMessage'] = "There are notifications created with this template. <br><br> Delete them before deleting the template.";
    } else {
        $_SESSION['errorMessage'] = $e->getMessage();
    }
}

header("Location: template.php");

?>