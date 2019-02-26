<?php
header('Content-Type: application/json');

$arquivo = $_FILES['upload']['name'];

$arquivo_tmp = $_FILES['upload']['tmp_name'];

$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
$host = $_SERVER['HTTP_HOST'];

$move_to = '/var/www/cremesp.com/library/modulos/editais/images/' . $arquivo;
$destino = $protocol . $host  . '/library/modulos/editais/images/' . $arquivo;

$file_saved = move_uploaded_file($arquivo_tmp, $move_to);

if ($file_saved) {
    echo '{
            "uploaded": 1,
            "fileName": "' . $arquivo . '",
            "url": "' . $destino . '"
           }';
} else {
    
    echo '{
            "uploaded": 0,
            "error": {
                         "message": "The file could not be saved."
                     }
           }';
}

?>