<?php
require_once 'logica/Session.php';
require_once 'logica/metodos_generales.php';

$paquetes = $_SESSION['ses_paquetes'];
$datos_usuario = filtrar_datos_post($_POST);
var_dump($paquetes);
var_dump($datos_usuario);
