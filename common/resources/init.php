<?php

require_once 'config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: text/html; charset=" . HTML_CHARSET);
ini_set("default_charset", HTML_CHARSET);
ini_set('session.gc_probability', 0);

if(session_id() == ''){
    session_start();
}

//print_r($_SESSION);

spl_autoload_register("carregaClasse");

function carregaClasse($nomeDaClasse)
{
    require_once ('/var/www/cremesp.com/common/class/' . $nomeDaClasse . '.php');
}

?>